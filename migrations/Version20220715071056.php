<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220715071056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE voc__s__strategy_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE voc__s__strategy (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_150367091D775834 ON voc__s__strategy (value)');
        $this->addSql('ALTER TABLE sample ADD strategy_id SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE sample DROP exhaustive');
        $this->addSql('ALTER TABLE sample ADD CONSTRAINT FK_F10B76C3D5CAD932 FOREIGN KEY (strategy_id) REFERENCES voc__s__strategy (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F10B76C3D5CAD932 ON sample (strategy_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE sample DROP CONSTRAINT FK_F10B76C3D5CAD932');
        $this->addSql('DROP SEQUENCE voc__s__strategy_id_seq CASCADE');
        $this->addSql('DROP TABLE voc__s__strategy');
        $this->addSql('DROP INDEX IDX_F10B76C3D5CAD932');
        $this->addSql('ALTER TABLE sample ADD exhaustive BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE sample DROP strategy_id');
    }
}
