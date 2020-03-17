<?php

namespace Domain;

class Database
{
    private \mysqli $connection;

    public function __construct()
    {
        $mysql = new \mysqli('database', 'codetest', 'codetest', 'codetest');

        if ($mysql->connect_errno) {
            throw new \RuntimeException('could not connect to mysql');
        }

        $this->connection = $mysql;
    }

    public function fetch(string $query, string $resultType = MYSQLI_ASSOC)
    {
        $result = $this->connection->query($this->connection->escape_string($query));
        if (!$result) {
            throw new \RuntimeException();
        }

        return $result->fetch_all($resultType);
    }

    public function fetchOne(string $query, string $resultType = MYSQLI_ASSOC)
    {
        $result = $this->connection->query($this->connection->escape_string($query));
        if (!$result) {
            throw new \RuntimeException();
        }

        return $result->fetch_array($resultType);
    }
}
