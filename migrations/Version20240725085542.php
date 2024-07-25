<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240725085542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, icon VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE century (id INT AUTO_INCREMENT NOT NULL, century VARCHAR(64) NOT NULL, period VARCHAR(64) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, place_id INT DEFAULT NULL, name VARCHAR(64) NOT NULL, picture_legend VARCHAR(128) NOT NULL, cdn_url VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_main TINYINT(1) NOT NULL, INDEX IDX_16DB4F89DA6A219 (place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(128) NOT NULL, subtitle VARCHAR(128) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, postcode VARCHAR(64) NOT NULL, city VARCHAR(64) NOT NULL, country VARCHAR(64) NOT NULL, phone VARCHAR(64) DEFAULT NULL, description LONGTEXT NOT NULL, price LONGTEXT DEFAULT NULL, opening_hours LONGTEXT DEFAULT NULL, rating DOUBLE PRECISION DEFAULT NULL, accessibility TINYINT(1) DEFAULT NULL, guided_tour TINYINT(1) DEFAULT NULL, is_valid TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', slug VARCHAR(128) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, website VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place_category (place_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_2C17FE42DA6A219 (place_id), INDEX IDX_2C17FE4212469DE2 (category_id), PRIMARY KEY(place_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place_century (place_id INT NOT NULL, century_id INT NOT NULL, INDEX IDX_EF7286A4DA6A219 (place_id), INDEX IDX_EF7286A4452289B6 (century_id), PRIMARY KEY(place_id, century_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place_tag (place_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_C3BD172DA6A219 (place_id), INDEX IDX_C3BD172BAD26311 (tag_id), PRIMARY KEY(place_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89DA6A219 FOREIGN KEY (place_id) REFERENCES place (id)');
        $this->addSql('ALTER TABLE place_category ADD CONSTRAINT FK_2C17FE42DA6A219 FOREIGN KEY (place_id) REFERENCES place (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE place_category ADD CONSTRAINT FK_2C17FE4212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE place_century ADD CONSTRAINT FK_EF7286A4DA6A219 FOREIGN KEY (place_id) REFERENCES place (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE place_century ADD CONSTRAINT FK_EF7286A4452289B6 FOREIGN KEY (century_id) REFERENCES century (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE place_tag ADD CONSTRAINT FK_C3BD172DA6A219 FOREIGN KEY (place_id) REFERENCES place (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE place_tag ADD CONSTRAINT FK_C3BD172BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89DA6A219');
        $this->addSql('ALTER TABLE place_category DROP FOREIGN KEY FK_2C17FE42DA6A219');
        $this->addSql('ALTER TABLE place_category DROP FOREIGN KEY FK_2C17FE4212469DE2');
        $this->addSql('ALTER TABLE place_century DROP FOREIGN KEY FK_EF7286A4DA6A219');
        $this->addSql('ALTER TABLE place_century DROP FOREIGN KEY FK_EF7286A4452289B6');
        $this->addSql('ALTER TABLE place_tag DROP FOREIGN KEY FK_C3BD172DA6A219');
        $this->addSql('ALTER TABLE place_tag DROP FOREIGN KEY FK_C3BD172BAD26311');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE century');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE place_category');
        $this->addSql('DROP TABLE place_century');
        $this->addSql('DROP TABLE place_tag');
        $this->addSql('DROP TABLE tag');
    }
}
