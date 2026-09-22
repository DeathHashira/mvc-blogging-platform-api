<?php

namespace Model;

use PDO;
use PDOStatement;

class BaseRepository
{
    public string $table;

    public function __construct(
        public PDO $conn
    ) {
        $this->table='';
    }

    public function create(array $data): bool
    {
        $columns = implode(", ", array_keys($data));
        $values = implode(", ", array_map(function($key) {return ":" . $key; }, array_keys($data)));

        $statement = $this->conn->prepare("INSERT INTO {$this->table} ($columns) VALUES ($values)");
        $this->bindValues($statement, $data);
        
        return $statement->execute();
    }

    public function deleteById(int $id): bool
    {
        $statement = $this->conn->prepare("DELETE FROM {$this->table} WHERE id=:id");
        $statement->bindValue(":id", $id);

        return $statement->execute();
    }

    public function update(int $id, array $data): bool
    {
        $set = $this->set($data);

        $statement = $this->conn->prepare("UPDATE {$this->table} SET $set WHERE id=:id");
        $statement->bindValue(":id", $id);

        $this->bindValues($statement, $data);
        return $statement->execute();
    }

    public function readById(int $id): array
    {
        $statement = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id=:id");
        $statement->bindValue(":id", $id);
        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public function readAll(): array
    {
        $statement = $this->conn->prepare("SELECT * FROM {$this->table}");
        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public function readByCondition(array $condition)
    {
        // will be completed later
    }

    public function bindValues(PDOStatement $statement, array $data): void
    {
        foreach ($data as $key => $value) {
            $statement->bindValue(":".$key, $value);
        }
    }

    public function set(array $data): string
    {
        $set = [];

        foreach ($data as $key => $value) {
            $set[] = "$key=:$key";
        }

        return implode(", ", $set);
    }

    public function search(string $word, array $columns): array
    {
        $columnsString = implode(" OR ", $columns);
        $statement = $this->conn->prepare("SELECT * FROM {$this->table} WHERE $columnsString LIKE :word");
        $statement->bindValue(":word", "%$word%");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}