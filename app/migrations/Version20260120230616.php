<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260120230616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inventory_access (id SERIAL NOT NULL, inventory_id INT NOT NULL, editor_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6B5B7FF9EEA759 ON inventory_access (inventory_id)');
        $this->addSql('CREATE INDEX IDX_6B5B7FF6995AC4C ON inventory_access (editor_id)');
        $this->addSql('ALTER TABLE inventory_access ADD CONSTRAINT FK_6B5B7FF9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE inventory_access ADD CONSTRAINT FK_6B5B7FF6995AC4C FOREIGN KEY (editor_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE inventory_access DROP CONSTRAINT FK_6B5B7FF9EEA759');
        $this->addSql('ALTER TABLE inventory_access DROP CONSTRAINT FK_6B5B7FF6995AC4C');
        $this->addSql('DROP TABLE inventory_access');
    }
}
