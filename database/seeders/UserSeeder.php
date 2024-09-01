<?php

namespace Database\Seeders;

use phpStack\Database\Seeder\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'John Doe', 'email' => 'john@example.com', 'password' => password_hash('password', PASSWORD_DEFAULT)],
            ['name' => 'Jane Doe', 'email' => 'jane@example.com', 'password' => password_hash('password', PASSWORD_DEFAULT)],
        ];

        foreach ($users as $user) {
            $this->connection->query("INSERT INTO users (name, email, password) VALUES (?, ?, ?)", [
                $user['name'],
                $user['email'],
                $user['password']
            ]);
        }
    }
}