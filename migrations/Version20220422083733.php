<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220422083733 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE area_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE site_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE stratigraphic_relationships_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE su_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__su__preservation_state_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__su__type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE area (id INT NOT NULL, site_id INT DEFAULT NULL, code VARCHAR(3) NOT NULL, name VARCHAR(64) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D7943D68F6BD1646 ON area (site_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D7943D68F6BD164677153098 ON area (site_id, code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D7943D68F6BD16465E237E06 ON area (site_id, name)');
        $this->addSql('CREATE TABLE site (id INT NOT NULL, code VARCHAR(3) NOT NULL, name VARCHAR(64) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_694309E45E237E06 ON site (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_694309E477153098 ON site (code)');
        $this->addSql('CREATE TABLE stratigraphic_relationships (id INT NOT NULL, sx_su_id INT DEFAULT NULL, dx_su_id INT DEFAULT NULL, relationship_id CHAR(1) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B9A4EF171E31BBE7 ON stratigraphic_relationships (sx_su_id)');
        $this->addSql('CREATE INDEX IDX_B9A4EF17684F83D5 ON stratigraphic_relationships (dx_su_id)');
        $this->addSql('CREATE INDEX IDX_B9A4EF172C41D668 ON stratigraphic_relationships (relationship_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B9A4EF171E31BBE7684F83D5 ON stratigraphic_relationships (sx_su_id, dx_su_id)');
        $this->addSql('CREATE TABLE su (id INT NOT NULL, site_id INT DEFAULT NULL, area_id INT DEFAULT NULL, type_id SMALLINT DEFAULT NULL, preservation_state_id SMALLINT DEFAULT NULL, number INT NOT NULL, date DATE NOT NULL, description TEXT DEFAULT NULL, interpretation TEXT DEFAULT NULL, summary TEXT DEFAULT NULL, top_elevation DOUBLE PRECISION DEFAULT NULL, bottom_elevation DOUBLE PRECISION DEFAULT NULL, area_supervisor VARCHAR(255) DEFAULT NULL, compiler VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_65A4BD79F6BD1646 ON su (site_id)');
        $this->addSql('CREATE INDEX IDX_65A4BD79BD0F409C ON su (area_id)');
        $this->addSql('CREATE INDEX IDX_65A4BD79C54C8C93 ON su (type_id)');
        $this->addSql('CREATE INDEX IDX_65A4BD79FE71FA16 ON su (preservation_state_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_65A4BD79F6BD164696901F54 ON su (site_id, number)');
        $this->addSql('COMMENT ON COLUMN su.date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE "user" (uuid UUID NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(uuid))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('COMMENT ON COLUMN "user".uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE voc__su__preservation_state (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F5A387E71D775834 ON voc__su__preservation_state (value)');
        $this->addSql('CREATE TABLE voc__su__relationship (id CHAR(1) NOT NULL, inverted_by_id CHAR(1) DEFAULT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2DB01D41C4CDAD40 ON voc__su__relationship (inverted_by_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2DB01D411D775834 ON voc__su__relationship (value)');
        $this->addSql('CREATE TABLE voc__su__type (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_15EFB60B1D775834 ON voc__su__type (value)');
        $this->addSql('ALTER TABLE area ADD CONSTRAINT FK_D7943D68F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stratigraphic_relationships ADD CONSTRAINT FK_B9A4EF171E31BBE7 FOREIGN KEY (sx_su_id) REFERENCES su (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stratigraphic_relationships ADD CONSTRAINT FK_B9A4EF17684F83D5 FOREIGN KEY (dx_su_id) REFERENCES su (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stratigraphic_relationships ADD CONSTRAINT FK_B9A4EF172C41D668 FOREIGN KEY (relationship_id) REFERENCES voc__su__relationship (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE su ADD CONSTRAINT FK_65A4BD79F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE su ADD CONSTRAINT FK_65A4BD79BD0F409C FOREIGN KEY (area_id) REFERENCES area (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE su ADD CONSTRAINT FK_65A4BD79C54C8C93 FOREIGN KEY (type_id) REFERENCES voc__su__type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE su ADD CONSTRAINT FK_65A4BD79FE71FA16 FOREIGN KEY (preservation_state_id) REFERENCES voc__su__preservation_state (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE voc__su__relationship ADD CONSTRAINT FK_2DB01D41C4CDAD40 FOREIGN KEY (inverted_by_id) REFERENCES voc__su__relationship (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE su DROP CONSTRAINT FK_65A4BD79BD0F409C');
        $this->addSql('ALTER TABLE area DROP CONSTRAINT FK_D7943D68F6BD1646');
        $this->addSql('ALTER TABLE su DROP CONSTRAINT FK_65A4BD79F6BD1646');
        $this->addSql('ALTER TABLE stratigraphic_relationships DROP CONSTRAINT FK_B9A4EF171E31BBE7');
        $this->addSql('ALTER TABLE stratigraphic_relationships DROP CONSTRAINT FK_B9A4EF17684F83D5');
        $this->addSql('ALTER TABLE su DROP CONSTRAINT FK_65A4BD79FE71FA16');
        $this->addSql('ALTER TABLE stratigraphic_relationships DROP CONSTRAINT FK_B9A4EF172C41D668');
        $this->addSql('ALTER TABLE voc__su__relationship DROP CONSTRAINT FK_2DB01D41C4CDAD40');
        $this->addSql('ALTER TABLE su DROP CONSTRAINT FK_65A4BD79C54C8C93');
        $this->addSql('DROP SEQUENCE area_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE site_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE stratigraphic_relationships_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE su_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__su__preservation_state_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__su__type_id_seq CASCADE');
        $this->addSql('DROP TABLE area');
        $this->addSql('DROP TABLE site');
        $this->addSql('DROP TABLE stratigraphic_relationships');
        $this->addSql('DROP TABLE su');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE voc__su__preservation_state');
        $this->addSql('DROP TABLE voc__su__relationship');
        $this->addSql('DROP TABLE voc__su__type');
    }
}
