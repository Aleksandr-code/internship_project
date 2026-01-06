<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260105221846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inventory ADD custom_string1_state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_string1_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_string2_state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_string2_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_string3_state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_string3_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_text1_state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_text1_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_text2_state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_text2_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_text3_state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_text3_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_int1_state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_int1_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_int2_state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_int2_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_int3_state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_int3_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_file1_state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_file1_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_file2_state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_file2_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_file3_state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_file3_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_bool1_state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_bool1_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_bool2_state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_bool2_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_bool3_state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD custom_bool3_name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE inventory DROP custom_string1_state');
        $this->addSql('ALTER TABLE inventory DROP custom_string1_name');
        $this->addSql('ALTER TABLE inventory DROP custom_string2_state');
        $this->addSql('ALTER TABLE inventory DROP custom_string2_name');
        $this->addSql('ALTER TABLE inventory DROP custom_string3_state');
        $this->addSql('ALTER TABLE inventory DROP custom_string3_name');
        $this->addSql('ALTER TABLE inventory DROP custom_text1_state');
        $this->addSql('ALTER TABLE inventory DROP custom_text1_name');
        $this->addSql('ALTER TABLE inventory DROP custom_text2_state');
        $this->addSql('ALTER TABLE inventory DROP custom_text2_name');
        $this->addSql('ALTER TABLE inventory DROP custom_text3_state');
        $this->addSql('ALTER TABLE inventory DROP custom_text3_name');
        $this->addSql('ALTER TABLE inventory DROP custom_int1_state');
        $this->addSql('ALTER TABLE inventory DROP custom_int1_name');
        $this->addSql('ALTER TABLE inventory DROP custom_int2_state');
        $this->addSql('ALTER TABLE inventory DROP custom_int2_name');
        $this->addSql('ALTER TABLE inventory DROP custom_int3_state');
        $this->addSql('ALTER TABLE inventory DROP custom_int3_name');
        $this->addSql('ALTER TABLE inventory DROP custom_file1_state');
        $this->addSql('ALTER TABLE inventory DROP custom_file1_name');
        $this->addSql('ALTER TABLE inventory DROP custom_file2_state');
        $this->addSql('ALTER TABLE inventory DROP custom_file2_name');
        $this->addSql('ALTER TABLE inventory DROP custom_file3_state');
        $this->addSql('ALTER TABLE inventory DROP custom_file3_name');
        $this->addSql('ALTER TABLE inventory DROP custom_bool1_state');
        $this->addSql('ALTER TABLE inventory DROP custom_bool1_name');
        $this->addSql('ALTER TABLE inventory DROP custom_bool2_state');
        $this->addSql('ALTER TABLE inventory DROP custom_bool2_name');
        $this->addSql('ALTER TABLE inventory DROP custom_bool3_state');
        $this->addSql('ALTER TABLE inventory DROP custom_bool3_name');
    }
}
