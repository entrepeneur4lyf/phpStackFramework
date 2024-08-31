<?php

namespace phpStack\Core;

use Closure;
use ReflectionClass;
use ReflectionParameter;
use Exception;

    /** @var array<string, array{concrete: callable, shared: bool}> */
    protected $bindings = [];

    /** @var array<string, mixed> */
    protected $instances = [];

    public function bind(string $abstract, $concrete = null, bool $shared = false): void
    {
        if (is_null($concrete)) {
            $concrete = $abstract;
        }

        if (!$concrete instanceof Closure) {
            $concrete = $this->getClosure($abstract, $concrete);
        }

        $this->bindings[$abstract] = compact('concrete', 'shared');
    }

    public function singleton(string $abstract, callable $concrete = null): void
    {
        $this->bind($abstract, $concrete, true);
    }

    /**
     * @param array<string, mixed> $parameters
     * @return mixed
     */
    public function make(string $abstract, array $parameters = [])
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        $concrete = $this->getConcrete($abstract);

        if ($this->isBuildable($concrete, $abstract)) {
            $object = $this->build($concrete, $parameters);
        } else {
            $object = $this->make($concrete, $parameters);
        }

        if ($this->isShared($abstract)) {
            $this->instances[$abstract] = $object;
        }

        return $object;
    }

    /**
     * @return mixed
     */
    public function get(string $abstract)
    {
        return $this->make($abstract);
    }

    /**
     * @return callable|string|null
     */
    protected function getConcrete(string $abstract)
    {
        if (!isset($this->bindings[$abstract])) {
            return $abstract;
        }

        return $this->bindings[$abstract]['concrete'];
    }

    protected function isBuildable($concrete, string $abstract): bool
    {
        return $concrete === $abstract || $concrete instanceof Closure;
    }

    /**
     * @param callable|string $concrete
     * @param array<string, mixed> $parameters
     * @return mixed
     */
    protected function build($concrete, array $parameters = [])
    {
        if ($concrete instanceof Closure) {
            return $concrete($this, $parameters);
        }

        $reflector = new ReflectionClass($concrete);

        if (!$reflector->isInstantiable()) {
            throw new Exception("Class {$concrete} is not instantiable");
        }

        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            return new $concrete;
        }

        $dependencies = $constructor->getParameters();
        $instances = $this->resolveDependencies($dependencies);

        return $reflector->newInstanceArgs($instances);
    }

    /**
     * @param ReflectionParameter[] $dependencies
     * @return array<mixed>
     */
    protected function resolveDependencies(array $dependencies): array
    {
        $results = [];

        foreach ($dependencies as $dependency) {
            $results[] = is_null($dependency->getClass())
                ? $this->resolvePrimitive($dependency)
                : $this->resolveClass($dependency);
        }

        return $results;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    protected function resolvePrimitive(ReflectionParameter $parameter)
    {
        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }

        throw new Exception("Unresolvable dependency resolving [$parameter]");
    }

    /**
     * @return mixed
     * @throws Exception
     */
    protected function resolveClass(ReflectionParameter $parameter)
    {
        try {
            return $this->make($parameter->getClass()->getName());
        } catch (Exception $e) {
            if ($parameter->isOptional()) {
                return $parameter->getDefaultValue();
            }

            throw $e;
        }
    }

    /**
     * @param string $abstract
     * @param callable|string $concrete
     * @return Closure
     */
    protected function getClosure($abstract, $concrete): Closure
    {
        return function ($container, $parameters = []) use ($abstract, $concrete) {
            if ($abstract == $concrete) {
                return $container->build($concrete);
            }

            return $container->make($concrete);
        };
    }

    protected function isShared(string $abstract): bool
    {
        return isset($this->bindings[$abstract]['shared']) &&
               $this->bindings[$abstract]['shared'] === true;
    }
}

use Psr\Container\ContainerInterface;
use Psr\Container\ContainerInterface as PsrContainerInterface;

class Container implements PsrContainerInterface
{
    protected array $bindings = [];
    protected array $instances = [];

    public function get(string $id)
    {
        if ($this->has($id)) {
            if (isset($this->instances[$id])) {
                return $this->instances[$id];
            }

            $concrete = $this->bindings[$id];
            return $this->instances[$id] = $this->resolve($concrete);
        }

        throw new \Exception("No binding found for $id");
    }

    public function has(string $id): bool
    {
        return isset($this->bindings[$id]) || isset($this->instances[$id]);
    }

    public function bind(string $abstract, $concrete = null, bool $shared = false): void
    {
        if (is_null($concrete)) {
            $concrete = $abstract;
        }

        $this->bindings[$abstract] = compact('concrete', 'shared');
    }

    public function singleton(string $abstract, $concrete = null): void
    {
        $this->bind($abstract, $concrete, true);
    }

    protected function resolve($concrete)
    {
        if ($concrete instanceof \Closure) {
            return $concrete($this);
        }

        if (is_string($concrete)) {
            return $this->build($concrete);
        }

        return $concrete;
    }

    protected function build(string $concrete)
    {
        $reflector = new \ReflectionClass($concrete);

        if (!$reflector->isInstantiable()) {
            throw new Exception("Class $concrete is not instantiable");
        }

        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            return new $concrete;
        }

        $dependencies = $constructor->getParameters();
        $instances = $this->resolveDependencies($dependencies);

        return $reflector->newInstanceArgs($instances);
    }

    protected function resolveDependencies(array $dependencies)
    {
        $results = [];

        foreach ($dependencies as $dependency) {
            $type = $dependency->getType();
            if (!$type || $type->isBuiltin()) {
                throw new Exception("Unresolvable dependency: {$dependency->name}");
            }

            $results[] = $this->get($type->getName());
        }

        return $results;
    }
}
