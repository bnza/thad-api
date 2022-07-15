<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220715073526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE voc__g__deposition_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE voc__g__deposition (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_95B0890E1D775834 ON voc__g__deposition (value)');
        $this->addSql('ALTER TABLE grave ADD deposition_id SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE grave DROP is_secondary_deposition');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT FK_21AEDEE7C7CC72F8 FOREIGN KEY (deposition_id) REFERENCES voc__g__deposition (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_21AEDEE7C7CC72F8 ON grave (deposition_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE grave DROP CONSTRAINT FK_21AEDEE7C7CC72F8');
        $this->addSql('DROP SEQUENCE voc__g__deposition_id_seq CASCADE');
        $this->addSql('DROP TABLE voc__g__deposition');
        $this->addSql('DROP INDEX IDX_21AEDEE7C7CC72F8');
        $this->addSql('ALTER TABLE grave ADD is_secondary_deposition BOOLEAN DEFAULT false NOT NULL');
        $this->addSql('ALTER TABLE grave DROP deposition_id');
    }
}
