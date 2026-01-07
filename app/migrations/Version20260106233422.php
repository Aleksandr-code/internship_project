<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260106233422 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inventory_item (id SERIAL NOT NULL, inventory_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, string1_value VARCHAR(255) DEFAULT NULL, string2_value VARCHAR(255) NOT NULL, string3_value VARCHAR(255) NOT NULL, text1_value TEXT DEFAULT NULL, text2_value TEXT DEFAULT NULL, text3_value TEXT DEFAULT NULL, int1_value INT DEFAULT NULL, int2_value INT DEFAULT NULL, int3_value INT DEFAULT NULL, file1_value VARCHAR(255) DEFAULT NULL, file2_value VARCHAR(255) DEFAULT NULL, file3_value VARCHAR(255) DEFAULT NULL, bool1_value BOOLEAN DEFAULT NULL, bool2_value BOOLEAN DEFAULT NULL, bool3_value BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_55BDEA309EEA759 ON inventory_item (inventory_id)');
        $this->addSql('COMMENT ON COLUMN inventory_item.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE inventory_item ADD CONSTRAINT FK_55BDEA309EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE inventory_item DROP CONSTRAINT FK_55BDEA309EEA759');
        $this->addSql('DROP TABLE inventory_item');
    }
}
