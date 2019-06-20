<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190619155215 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE movies (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, year INT NOT NULL, rated VARCHAR(255) NOT NULL, released DATETIME NOT NULL, runtime VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, director VARCHAR(255) NOT NULL, writer VARCHAR(255) NOT NULL, actors LONGTEXT NOT NULL, plot LONGTEXT NOT NULL, language LONGTEXT NOT NULL, country VARCHAR(255) NOT NULL, awards LONGTEXT NOT NULL, poster LONGTEXT NOT NULL, ratings LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, dvd VARCHAR(255) NOT NULL, box_office VARCHAR(255) NOT NULL, production VARCHAR(255) NOT NULL, website VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE movies');
    }
}
