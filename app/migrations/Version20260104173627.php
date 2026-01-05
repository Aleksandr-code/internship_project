<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260104173627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id SERIAL NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE inventory (id SERIAL NOT NULL, category_id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, image_url VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B12D4A3612469DE2 ON inventory (category_id)');
        $this->addSql('COMMENT ON COLUMN inventory.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE inventory_tag (inventory_id INT NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(inventory_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_7AE3D8E79EEA759 ON inventory_tag (inventory_id)');
        $this->addSql('CREATE INDEX IDX_7AE3D8E7BAD26311 ON inventory_tag (tag_id)');
        $this->addSql('CREATE TABLE tag (id SERIAL NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A3612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE inventory_tag ADD CONSTRAINT FK_7AE3D8E79EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE inventory_tag ADD CONSTRAINT FK_7AE3D8E7BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE inventory DROP CONSTRAINT FK_B12D4A3612469DE2');
        $this->addSql('ALTER TABLE inventory_tag DROP CONSTRAINT FK_7AE3D8E79EEA759');
        $this->addSql('ALTER TABLE inventory_tag DROP CONSTRAINT FK_7AE3D8E7BAD26311');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE inventory');
        $this->addSql('DROP TABLE inventory_tag');
        $this->addSql('DROP TABLE tag');
    }
}
