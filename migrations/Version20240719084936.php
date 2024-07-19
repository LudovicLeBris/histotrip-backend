<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240719084936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE place ADD COLUMN website VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__place AS SELECT id, name, subtitle, address, postcode, city, country, phone, description, price, opening_hours, rating, accessibility, guided_tour, is_valid, created_at, updated_at, slug, latitude, longitude FROM place');
        $this->addSql('DROP TABLE place');
        $this->addSql('CREATE TABLE place (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(128) NOT NULL, subtitle VARCHAR(128) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, postcode VARCHAR(64) NOT NULL, city VARCHAR(64) NOT NULL, country VARCHAR(64) NOT NULL, phone VARCHAR(64) DEFAULT NULL, description CLOB NOT NULL, price CLOB DEFAULT NULL, opening_hours CLOB DEFAULT NULL, rating DOUBLE PRECISION DEFAULT NULL, accessibility BOOLEAN DEFAULT NULL, guided_tour BOOLEAN DEFAULT NULL, is_valid BOOLEAN NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , slug VARCHAR(128) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL)');
        $this->addSql('INSERT INTO place (id, name, subtitle, address, postcode, city, country, phone, description, price, opening_hours, rating, accessibility, guided_tour, is_valid, created_at, updated_at, slug, latitude, longitude) SELECT id, name, subtitle, address, postcode, city, country, phone, description, price, opening_hours, rating, accessibility, guided_tour, is_valid, created_at, updated_at, slug, latitude, longitude FROM __temp__place');
        $this->addSql('DROP TABLE __temp__place');
    }
}
