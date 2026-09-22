<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260921082449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'This migration is for creating relation table between tags and posts';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE post_tags (
        tag_id INT,
        post_id INT NOT NULL,
        FOREIGN KEY (post_id) REFERENCES posts(id),
        FOREIGN KEY (tag_id) REFERENCES tags(id)
        )");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE IF EXISTS post_tags");
    }
}
