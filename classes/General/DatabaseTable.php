<?php

namespace General;


class DatabaseTable
{
    private $pdo;
    private $table;
    private $className;
    private $constructorArgs;

    public function __construct(\PDO $pdo, string $table, string $className = '\stdClass', array $constructorArgs = [])
    {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->className = $className;
        $this->constructorArgs = $constructorArgs;
    }

    private function query($sql, $parameters = [])
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

    public function findAll()
    {
        $sql = 'SELECT * FROM `' . $this->table . '`';

        $query = $this->query($sql);

        return $query->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->constructorArgs);
    }

    public function findById($value)
    {
        $sql = 'SELECT * FROM `' . $this->table . '` WHERE `id` = :value';

        $parameters = [
            'value' => $value
        ];

        $query = $this->query($sql, $parameters);

        return $query->fetchObject($this->className, $this->constructorArgs);
    }
}