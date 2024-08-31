<?php

namespace phpStack\Database;

class Connection
{
    protected $host;
    protected $database;
    protected $username;
    protected $password;

    public function __construct(string $host, string $database, string $username, string $password)
    {
        $this->host = $host;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
    }

    // Add methods for database operations here
}
