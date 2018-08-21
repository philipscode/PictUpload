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

    private function processDates($fields)
    {
        foreach ($fields as $key => $value) {
            if ($value instanceof \DateTime) {
                $fields[$key] = $value->format('Y-m-d');
            }
        }
        return $fields;
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

    public function find($field, $value)
    {
        $sql = 'SELECT * FROM `' . $this->table . '` WHERE `' . $field . '` = :' . $field;

        $parameters = [
            $field => $value
        ];

        $query = $this->query($sql, $parameters);

        return $query->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->constructorArgs);
    }

    public function insert($fields)
    {
        $sql = 'INSERT INTO `' . $this->table . '` SET ';

        foreach ($fields as $key => $value) {
            $sql .= '`' . $key . '`' . ' = :' . $key . ', ';
        }

        $sql = rtrim($sql, ', ');

        $fields = $this->processDates($fields);

        $this->query($sql, $fields);

        return $this->pdo->lastInsertId();
    }

    public function save($record)
    {
        $entity = new $this->className(...$this->constructorArgs);

        if (!isset($record['id'])) {
            $record['id'] = null;
        }
        $entity->id = $this->insert($record);

        foreach ($record as $key => $value) {
            if (!empty($value)) {
                $entity->$key = $value;
            }
        }

        return $entity;
    }
}