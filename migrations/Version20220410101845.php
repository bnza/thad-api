<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220410101845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE su_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE su (id INT NOT NULL, area_id INT DEFAULT NULL, number INT NOT NULL, date DATE NOT NULL, description TEXT DEFAULT NULL, interpretation TEXT DEFAULT NULL, summary TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_65A4BD79BD0F409C ON su (area_id)');
        $this->addSql('COMMENT ON COLUMN su.date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE su ADD CONSTRAINT FK_65A4BD79BD0F409C FOREIGN KEY (area_id) REFERENCES area (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE su_id_seq CASCADE');
        $this->addSql('DROP TABLE su');
    }
}
