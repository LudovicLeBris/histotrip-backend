<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240716092754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE place_category (place_id INTEGER NOT NULL, category_id INTEGER NOT NULL, PRIMARY KEY(place_id, category_id), CONSTRAINT FK_2C17FE42DA6A219 FOREIGN KEY (place_id) REFERENCES place (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2C17FE4212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_2C17FE42DA6A219 ON place_category (place_id)');
        $this->addSql('CREATE INDEX IDX_2C17FE4212469DE2 ON place_category (category_id)');
        $this->addSql('CREATE TABLE place_century (place_id INTEGER NOT NULL, century_id INTEGER NOT NULL, PRIMARY KEY(place_id, century_id), CONSTRAINT FK_EF7286A4DA6A219 FOREIGN KEY (place_id) REFERENCES place (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_EF7286A4452289B6 FOREIGN KEY (century_id) REFERENCES century (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_EF7286A4DA6A219 ON place_century (place_id)');
        $this->addSql('CREATE INDEX IDX_EF7286A4452289B6 ON place_century (century_id)');
        $this->addSql('CREATE TABLE place_tag (place_id INTEGER NOT NULL, tag_id INTEGER NOT NULL, PRIMARY KEY(place_id, tag_id), CONSTRAINT FK_C3BD172DA6A219 FOREIGN KEY (place_id) REFERENCES place (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_C3BD172BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_C3BD172DA6A219 ON place_tag (place_id)');
        $this->addSql('CREATE INDEX IDX_C3BD172BAD26311 ON place_tag (tag_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__picture AS SELECT id, name, picture_legend, cdn_url, created_at, updated_at, is_main FROM picture');
        $this->addSql('DROP TABLE picture');
        $this->addSql('CREATE TABLE picture (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, place_id INTEGER DEFAULT NULL, name VARCHAR(64) NOT NULL, picture_legend VARCHAR(128) NOT NULL, cdn_url VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , is_main BOOLEAN NOT NULL, CONSTRAINT FK_16DB4F89DA6A219 FOREIGN KEY (place_id) REFERENCES place (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO picture (id, name, picture_legend, cdn_url, created_at, updated_at, is_main) SELECT id, name, picture_legend, cdn_url, created_at, updated_at, is_main FROM __temp__picture');
        $this->addSql('DROP TABLE __temp__picture');
        $this->addSql('CREATE INDEX IDX_16DB4F89DA6A219 ON picture (place_id)');
        $this->addSql('ALTER TABLE place ADD COLUMN slug VARCHAR(128) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE place_category');
        $this->addSql('DROP TABLE place_century');
        $this->addSql('DROP TABLE place_tag');
        $this->addSql('CREATE TEMPORARY TABLE __temp__picture AS SELECT id, name, picture_legend, cdn_url, created_at, updated_at, is_main FROM picture');
        $this->addSql('DROP TABLE picture');
        $this->addSql('CREATE TABLE picture (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(64) NOT NULL, picture_legend VARCHAR(128) NOT NULL, cdn_url VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , is_main BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO picture (id, name, picture_legend, cdn_url, created_at, updated_at, is_main) SELECT id, name, picture_legend, cdn_url, created_at, updated_at, is_main FROM __temp__picture');
        $this->addSql('DROP TABLE __temp__picture');
        $this->addSql('CREATE TEMPORARY TABLE __temp__place AS SELECT id, name, subtitle, address, postcode, city, country, phone, description, price, opening_hours, rating, accessibility, guided_tour, is_valid, created_at, updated_at FROM place');
        $this->addSql('DROP TABLE place');
        $this->addSql('CREATE TABLE place (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(128) NOT NULL, subtitle VARCHAR(128) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, postcode VARCHAR(64) NOT NULL, city VARCHAR(64) NOT NULL, country VARCHAR(64) NOT NULL, phone VARCHAR(64) DEFAULT NULL, description CLOB NOT NULL, price CLOB DEFAULT NULL, opening_hours CLOB DEFAULT NULL, rating DOUBLE PRECISION DEFAULT NULL, accessibility BOOLEAN DEFAULT NULL, guided_tour BOOLEAN DEFAULT NULL, is_valid BOOLEAN NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO place (id, name, subtitle, address, postcode, city, country, phone, description, price, opening_hours, rating, accessibility, guided_tour, is_valid, created_at, updated_at) SELECT id, name, subtitle, address, postcode, city, country, phone, description, price, opening_hours, rating, accessibility, guided_tour, is_valid, created_at, updated_at FROM __temp__place');
        $this->addSql('DROP TABLE __temp__place');
    }
}
