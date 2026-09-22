<?php

namespace Model;

use PDO;
use Override;

class Tags extends BaseRepository
{
    #[Override]
    public function __construct(PDO $conn)
    {
        parent::__construct($conn);
        $this->table = "tags";
    }
}