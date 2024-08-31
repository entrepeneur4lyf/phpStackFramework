<?php

namespace Tests\Unit\Core;

use phpStack\Core\Container;
use PHPUnit\Framework\TestCase;

class ContainerTest extends TestCase
{
    public function testBindAndResolve()
    {
        $container = new Container();
        $container->bind('key', 'value');
        $this->assertEquals('value', $container->get('key'));
    }

    public function testSingleton()
    {
        $container = new Container();
        $container->singleton('random', function () {
            return rand();
        });
        $value1 = $container->get('random');
        $value2 = $container->get('random');
        $this->assertEquals($value1, $value2);
    }

    public function testAutowiring()
    {
        $container = new Container();
        $instance = $container->get(Container::class);
        $this->assertInstanceOf(Container::class, $instance);
    }
}
