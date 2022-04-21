<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220421092924 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE stratigraphic_relationships_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE stratigraphic_relationships (id INT NOT NULL, relationship_id CHAR(1) DEFAULT NULL, sx_su_id INT DEFAULT NULL, dx_su_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B9A4EF172C41D668 ON stratigraphic_relationships (relationship_id)');
        $this->addSql('CREATE INDEX IDX_B9A4EF171E31BBE7 ON stratigraphic_relationships (sx_su_id)');
        $this->addSql('CREATE INDEX IDX_B9A4EF17684F83D5 ON stratigraphic_relationships (dx_su_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B9A4EF171E31BBE72C41D668684F83D5 ON stratigraphic_relationships (sx_su_id, relationship_id, dx_su_id)');
        $this->addSql('CREATE TABLE voc__su__relationship (id CHAR(1) NOT NULL, inverted_by_id CHAR(1) DEFAULT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2DB01D41C4CDAD40 ON voc__su__relationship (inverted_by_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2DB01D411D775834 ON voc__su__relationship (value)');
        $this->addSql('ALTER TABLE stratigraphic_relationships ADD CONSTRAINT FK_B9A4EF172C41D668 FOREIGN KEY (relationship_id) REFERENCES voc__su__relationship (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stratigraphic_relationships ADD CONSTRAINT FK_B9A4EF171E31BBE7 FOREIGN KEY (sx_su_id) REFERENCES su (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stratigraphic_relationships ADD CONSTRAINT FK_B9A4EF17684F83D5 FOREIGN KEY (dx_su_id) REFERENCES su (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE voc__su__relationship ADD CONSTRAINT FK_2DB01D41C4CDAD40 FOREIGN KEY (inverted_by_id) REFERENCES voc__su__relationship (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE stratigraphic_relationships DROP CONSTRAINT FK_B9A4EF172C41D668');
        $this->addSql('ALTER TABLE voc__su__relationship DROP CONSTRAINT FK_2DB01D41C4CDAD40');
        $this->addSql('DROP SEQUENCE stratigraphic_relationships_id_seq CASCADE');
        $this->addSql('DROP TABLE stratigraphic_relationships');
        $this->addSql('DROP TABLE voc__su__relationship');
    }
}
