<?php

namespace Model;

use PDO;
use Override;

class PostTags extends BaseRepository
{
    #[Override]
    public function __construct(PDO $conn)
    {
        parent::__construct($conn);
        $this->table = "post_tags";
    }
}