<?php

namespace phpStack\Database;

class Connection
{
    protected string $host;
    protected string $database;
    protected string $username;
    protected string $password;

    public function __construct(string $host, string $database, string $username, string $password)
    {
        $this->host = $host;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
    }

    // Add methods for database operations here
}
