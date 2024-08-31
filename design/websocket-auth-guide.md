# WebSocket Authentication and Authorization Guide

## Overview

In this guide, we'll implement a secure WebSocket connection system that ensures only authenticated and authorized users can receive updates. We'll use JWT (JSON Web Tokens) for authentication and implement role-based authorization.

## Key Components

1. **AuthenticationManager**: Handles user authentication and JWT generation.
2. **AuthorizationManager**: Manages user roles and permissions.
3. **SecureWebSocketManager**: Extends our existing WebSocketManager with authentication and authorization checks.
4. **Middleware**: For authenticating HTTP requests and WebSocket connections.

## Implementation

### 1. AuthenticationManager

File: `src/Auth/AuthenticationManager.php`

```php
<?php

namespace YourFramework\Auth;

use Firebase\JWT\JWT;

class AuthenticationManager
{
    private string $secretKey;

    public function __construct(string $secretKey)
    {
        $this->secretKey = $secretKey;
    }

    public function generateToken(array $userData): string
    {
        $payload = [
            'user_id' => $userData['id'],
            'email' => $userData['email'],
            'roles' => $userData['roles'],
            'exp' => time() + 3600 // Token expires in 1 hour
        ];

        return JWT::encode($payload, $this->secretKey, 'HS256');
    }

    public function validateToken(string $token): ?array
    {
        try {
            $decoded = JWT::decode($token, $this->secretKey, ['HS256']);
            return (array) $decoded;
        } catch (\Exception $e) {
            return null;
        }
    }
}
```

### 2. AuthorizationManager

File: `src/Auth/AuthorizationManager.php`

```php
<?php

namespace YourFramework\Auth;

class AuthorizationManager
{
    private array $rolePermissions;

    public function __construct(array $rolePermissions)
    {
        $this->rolePermissions = $rolePermissions;
    }

    public function userHasPermission(array $userRoles, string $permission): bool
    {
        foreach ($userRoles as $role) {
            if (isset($this->rolePermissions[$role]) && in_array($permission, $this->rolePermissions[$role])) {
                return true;
            }
        }
        return false;
    }
}
```

### 3. SecureWebSocketManager

File: `src/Templating/SecureWebSocketManager.php`

```php
<?php

namespace YourFramework\Templating;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use YourFramework\Auth\AuthenticationManager;
use YourFramework\Auth\AuthorizationManager;

class SecureWebSocketManager implements MessageComponentInterface
{
    protected $clients;
    protected AuthenticationManager $authManager;
    protected AuthorizationManager $authzManager;

    public function __construct(AuthenticationManager $authManager, AuthorizationManager $authzManager)
    {
        $this->clients = new \SplObjectStorage;
        $this->authManager = $authManager;
        $this->authzManager = $authzManager;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // The WebSocket handshake is already complete. The JWT should be sent
        // as a query parameter in the WebSocket URL.
        $token = $conn->httpRequest->getUri()->getQuery();
        $tokenData = $this->authManager->validateToken($token);

        if ($tokenData) {
            $conn->userData = $tokenData;
            $this->clients->attach($conn);
        } else {
            $conn->close();
        }
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        // Handle incoming messages if needed
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->close();
    }

    public function sendUpdate(string $componentId, string $renderedHtml, string $requiredPermission): void
    {
        $update = json_encode([
            'componentId' => $componentId,
            'html' => $renderedHtml
        ]);

        foreach ($this->clients as $client) {
            if ($this->authzManager->userHasPermission($client->userData['roles'], $requiredPermission)) {
                $client->send($update);
            }
        }
    }
}
```

### 4. Authentication Middleware

File: `src/Http/Middleware/AuthenticationMiddleware.php`

```php
<?php

namespace YourFramework\Http\Middleware;

use YourFramework\Auth\AuthenticationManager;

class AuthenticationMiddleware
{
    private AuthenticationManager $authManager;

    public function __construct(AuthenticationManager $authManager)
    {
        $this->authManager = $authManager;
    }

    public function handle($request, \Closure $next)
    {
        $token = $request->getHeader('Authorization');
        if (!$token) {
            return new Response('Unauthorized', 401);
        }

        $token = str_replace('Bearer ', '', $token);
        $userData = $this->authManager->validateToken($token);

        if (!$userData) {
            return new Response('Invalid token', 401);
        }

        $request->setUserData($userData);
        return $next($request);
    }
}
```

### 5. Update Client-Side Script

File: `public/js/secure-websocket-updater.js`

```javascript
class SecureWebSocketUpdater {
    constructor(baseUrl) {
        this.baseUrl = baseUrl;
        this.socket = null;
        this.connect();
    }

    connect() {
        const token = this.getAuthToken(); // Implement this method to retrieve the token from storage
        this.socket = new WebSocket(`${this.baseUrl}?${token}`);
        this.socket.onmessage = this.handleMessage.bind(this);
        this.socket.onclose = () => {
            // Attempt to reconnect after a delay
            setTimeout(() => this.connect(), 5000);
        };
    }

    handleMessage(event) {
        const update = JSON.parse(event.data);
        const component = document.getElementById(update.componentId);
        if (component) {
            component.innerHTML = update.html;
        }
    }

    getAuthToken() {
        // Retrieve the JWT from localStorage or another secure storage method
        return localStorage.getItem('authToken');
    }
}

// Usage
const wsUpdater = new SecureWebSocketUpdater('ws://localhost:8080');
```

### 6. Update Route for Counter Increment

Update your `/increment-counter` route to include authentication and authorization:

```php
$router->post('/increment-counter', [AuthenticationMiddleware::class, function (Request $request) use ($app) {
    $updateDispatcher = $app->container->make(UpdateDispatcher::class);
    $registry = $app->container->make(ComponentRegistry::class);
    $authzManager = $app->container->make(AuthorizationManager::class);
    
    $userData = $request->getUserData();
    if (!$authzManager->userHasPermission($userData['roles'], 'increment_counter')) {
        return new Response('Forbidden', 403);
    }

    $counter = $registry->get('counter');
    $currentCount = $counter->data['count'] ?? 0;
    $newCount = $currentCount + 1;
    
    $updateDispatcher->dispatchUpdate('counter', ['count' => $newCount], 'view_counter');

    return new Response('Counter incremented');
}]);
```

## How It Works

1. When a user logs in, they receive a JWT containing their user ID, email, and roles.
2. The client stores this JWT securely (e.g., in localStorage).
3. When establishing a WebSocket connection, the client includes the JWT in the connection URL.
4. The `SecureWebSocketManager` validates the JWT on connection and stores the user data.
5. For each update, the `SecureWebSocketManager` checks if the user has the required permission before sending the update.
6. HTTP routes are protected by the `AuthenticationMiddleware`, which validates the JWT for each request.
7. The client-side script handles reconnection if the WebSocket connection is lost.

## Security Considerations

1. Always use HTTPS for your main site and WSS (WebSocket Secure) for WebSocket connections.
2. Store JWTs securely on the client-side, preferably in memory for short-lived sessions.
3. Implement token refresh mechanisms to issue new tokens before they expire.
4. Consider using a separate, short-lived token for WebSocket connections.
5. Implement rate limiting on both HTTP routes and WebSocket connections to prevent abuse.

## Testing

1. Implement a login system that generates and returns a JWT.
2. Store the JWT on the client-side after login.
3. Attempt to connect to the WebSocket with and without a valid token.
4. Try to increment the counter with different user roles to test authorization.
5. Test reconnection logic by intentionally closing the WebSocket connection.

This authentication and authorization system ensures that only authenticated users can connect to the WebSocket, and only authorized users receive specific updates. It adds a layer of security to your real-time, server-side rendering system.
