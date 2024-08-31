<?php

if (!function_exists('env')) {
    function env($key, $default = null) {
        $value = getenv($key);
        if ($value === false) {
            return $default;
        }
        return $value;
    }
}

return [
    'host' => env('DB_HOST', 'localhost'),
    'database' => env('DB_DATABASE', 'your_database'),
    'username' => env('DB_USERNAME', 'your_username'),
    'password' => env('DB_PASSWORD', 'your_password'),
    'migrations_path' => __DIR__ . '/../database/migrations',
];
