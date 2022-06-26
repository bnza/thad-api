<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220626133101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE media_objects__graves_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__d__type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE document (id INT NOT NULL, media_object_id INT DEFAULT NULL, site_id INT NOT NULL, area_id INT NOT NULL, type_id SMALLINT NOT NULL, number SMALLINT NOT NULL, year INT NOT NULL, date DATE NOT NULL, description TEXT NOT NULL, interpretation TEXT NOT NULL, summary TEXT DEFAULT NULL, area_supervisor VARCHAR(255) DEFAULT NULL, creator VARCHAR(255) NOT NULL, buildings TEXT DEFAULT NULL, rooms TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D8698A76F6BD1646 ON document (site_id)');
        $this->addSql('CREATE INDEX IDX_D8698A76BD0F409C ON document (area_id)');
        $this->addSql('CREATE INDEX IDX_D8698A76C54C8C93 ON document (type_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D8698A76F6BD164696901F54 ON document (site_id, number)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D8698A7664DE5A5 ON document (media_object_id)');
        $this->addSql('COMMENT ON COLUMN document.date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN document.buildings IS \'(DC2Type:simple_array)\'');
        $this->addSql('COMMENT ON COLUMN document.rooms IS \'(DC2Type:simple_array)\'');
        $this->addSql('CREATE TABLE media_objects__graves (id INT NOT NULL, grave_id INT NOT NULL, media_object_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6C54F84BE439654A ON media_objects__graves (grave_id)');
        $this->addSql('CREATE INDEX IDX_6C54F84B64DE5A5 ON media_objects__graves (media_object_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6C54F84BE439654A64DE5A5 ON media_objects__graves (grave_id, media_object_id)');
        $this->addSql('CREATE TABLE voc__d__type (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FD4B52C01D775834 ON voc__d__type (value)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A7664DE5A5 FOREIGN KEY (media_object_id) REFERENCES media_object (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76BD0F409C FOREIGN KEY (area_id) REFERENCES area (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76C54C8C93 FOREIGN KEY (type_id) REFERENCES voc__d__type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__graves ADD CONSTRAINT FK_6C54F84BE439654A FOREIGN KEY (grave_id) REFERENCES grave (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__graves ADD CONSTRAINT FK_6C54F84B64DE5A5 FOREIGN KEY (media_object_id) REFERENCES media_object (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE document DROP CONSTRAINT FK_D8698A76C54C8C93');
        $this->addSql('DROP SEQUENCE media_objects__graves_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__d__type_id_seq CASCADE');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE media_objects__graves');
        $this->addSql('DROP TABLE voc__d__type');
    }
}
