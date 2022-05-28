<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220526183526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__s__type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE sample (id INT NOT NULL, su_id INT NOT NULL, type_id SMALLINT NOT NULL, preservation_state_id SMALLINT DEFAULT NULL, date DATE NOT NULL, number SMALLINT NOT NULL, height DOUBLE PRECISION DEFAULT NULL, width DOUBLE PRECISION DEFAULT NULL, length DOUBLE PRECISION DEFAULT NULL, thickness DOUBLE PRECISION DEFAULT NULL, min_diameter DOUBLE PRECISION DEFAULT NULL, max_diameter DOUBLE PRECISION DEFAULT NULL, weight DOUBLE PRECISION DEFAULT NULL, selected_for_analysis BOOLEAN NOT NULL, compiler VARCHAR(255) DEFAULT NULL, notes TEXT DEFAULT NULL, exhaustive BOOLEAN DEFAULT NULL, contamination_risk BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F10B76C3BDB1218E ON sample (su_id)');
        $this->addSql('CREATE INDEX IDX_F10B76C3C54C8C93 ON sample (type_id)');
        $this->addSql('CREATE INDEX IDX_F10B76C3FE71FA16 ON sample (preservation_state_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F10B76C3BDB1218E96901F54 ON sample (su_id, number)');
        $this->addSql('COMMENT ON COLUMN sample.date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE voc__s__type (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5F32F0801D775834 ON voc__s__type (value)');
        $this->addSql('ALTER TABLE sample ADD CONSTRAINT FK_F10B76C3BDB1218E FOREIGN KEY (su_id) REFERENCES su (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sample ADD CONSTRAINT FK_F10B76C3C54C8C93 FOREIGN KEY (type_id) REFERENCES voc__s__type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sample ADD CONSTRAINT FK_F10B76C3FE71FA16 FOREIGN KEY (preservation_state_id) REFERENCES voc__preservation_state (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE sample DROP CONSTRAINT FK_F10B76C3C54C8C93');
        $this->addSql('DROP SEQUENCE sample_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__s__type_id_seq CASCADE');
        $this->addSql('DROP TABLE sample');
        $this->addSql('DROP TABLE voc__s__type');
    }
}
