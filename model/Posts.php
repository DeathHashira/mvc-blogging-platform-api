<?php

namespace Model;

use PDO;
use Override;

class Posts extends BaseRepository
{
    #[Override]
    public function __construct(PDO $conn)
    {
        parent::__construct($conn);
        $this->table = "posts";
    }

    public function getLastId(): int
    {
        return $this->conn->lastInsertId();
    }
}