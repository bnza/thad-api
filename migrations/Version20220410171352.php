<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220410171352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE su ADD type_id SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE su ADD preservation_state_id SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE su ADD top_elevation DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE su ADD bottom_elevation DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE su ADD area_supervisor VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE su ADD compiler VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE su ADD CONSTRAINT FK_65A4BD79C54C8C93 FOREIGN KEY (type_id) REFERENCES voc__su__type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE su ADD CONSTRAINT FK_65A4BD79FE71FA16 FOREIGN KEY (preservation_state_id) REFERENCES voc__su__preservation_state (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_65A4BD79C54C8C93 ON su (type_id)');
        $this->addSql('CREATE INDEX IDX_65A4BD79FE71FA16 ON su (preservation_state_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE su DROP CONSTRAINT FK_65A4BD79C54C8C93');
        $this->addSql('ALTER TABLE su DROP CONSTRAINT FK_65A4BD79FE71FA16');
        $this->addSql('DROP INDEX IDX_65A4BD79C54C8C93');
        $this->addSql('DROP INDEX IDX_65A4BD79FE71FA16');
        $this->addSql('ALTER TABLE su DROP type_id');
        $this->addSql('ALTER TABLE su DROP preservation_state_id');
        $this->addSql('ALTER TABLE su DROP top_elevation');
        $this->addSql('ALTER TABLE su DROP bottom_elevation');
        $this->addSql('ALTER TABLE su DROP area_supervisor');
        $this->addSql('ALTER TABLE su DROP compiler');
    }
}
