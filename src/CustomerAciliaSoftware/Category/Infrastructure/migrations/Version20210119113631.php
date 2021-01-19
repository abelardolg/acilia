<?php

declare(strict_types=1);

namespace App\CustomerAciliaSoftware\Category\Infrastructure\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210119113631 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Creates a `Category` table';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql('
        CREATE TABLE `category` (
                id CHAR(36) NOT NULL PRIMARY KEY,
                name VARCHAR(20) NOT NULL,
                description VARCHAR(30) NOT NULL,
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
            )   
       ');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE `category`');
    }
}
