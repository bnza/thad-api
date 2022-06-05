<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220605110536 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE grave_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__g__ritual_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__g__type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE grave (id INT NOT NULL, cut_stratigraphic_unit_id INT DEFAULT NULL, fill_stratigraphic_unit_id INT DEFAULT NULL, skeleton_stratigraphic_unit_id INT DEFAULT NULL, earlier_than_id INT DEFAULT NULL, later_than_id INT DEFAULT NULL, site_id INT NOT NULL, area_id INT NOT NULL, period_id SMALLINT DEFAULT NULL, ritual_id SMALLINT DEFAULT NULL, type_id SMALLINT NOT NULL, preservation_state_id SMALLINT DEFAULT NULL, number SMALLINT NOT NULL, year INT NOT NULL, date DATE NOT NULL, description TEXT DEFAULT NULL, interpretation TEXT DEFAULT NULL, alignment TEXT DEFAULT NULL, is_secondary_deposition BOOLEAN DEFAULT false NOT NULL, summary TEXT DEFAULT NULL, area_supervisor VARCHAR(255) DEFAULT NULL, compiler VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_21AEDEE76A154197 ON grave (cut_stratigraphic_unit_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_21AEDEE7C902AD2D ON grave (fill_stratigraphic_unit_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_21AEDEE78CE56243 ON grave (skeleton_stratigraphic_unit_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_21AEDEE71467A8C6 ON grave (earlier_than_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_21AEDEE719875ADC ON grave (later_than_id)');
        $this->addSql('CREATE INDEX IDX_21AEDEE7F6BD1646 ON grave (site_id)');
        $this->addSql('CREATE INDEX IDX_21AEDEE7BD0F409C ON grave (area_id)');
        $this->addSql('CREATE INDEX IDX_21AEDEE7EC8B7ADE ON grave (period_id)');
        $this->addSql('CREATE INDEX IDX_21AEDEE7F8922643 ON grave (ritual_id)');
        $this->addSql('CREATE INDEX IDX_21AEDEE7C54C8C93 ON grave (type_id)');
        $this->addSql('CREATE INDEX IDX_21AEDEE7FE71FA16 ON grave (preservation_state_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_21AEDEE7F6BD164696901F54 ON grave (site_id, number)');
        $this->addSql('COMMENT ON COLUMN grave.date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE voc__g__ritual (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2BD403CA1D775834 ON voc__g__ritual (value)');
        $this->addSql('CREATE TABLE voc__g__type (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CCA3485D1D775834 ON voc__g__type (value)');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT FK_21AEDEE76A154197 FOREIGN KEY (cut_stratigraphic_unit_id) REFERENCES su (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT FK_21AEDEE7C902AD2D FOREIGN KEY (fill_stratigraphic_unit_id) REFERENCES su (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT FK_21AEDEE78CE56243 FOREIGN KEY (skeleton_stratigraphic_unit_id) REFERENCES su (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT FK_21AEDEE71467A8C6 FOREIGN KEY (earlier_than_id) REFERENCES su (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT FK_21AEDEE719875ADC FOREIGN KEY (later_than_id) REFERENCES su (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT FK_21AEDEE7F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT FK_21AEDEE7BD0F409C FOREIGN KEY (area_id) REFERENCES area (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT FK_21AEDEE7EC8B7ADE FOREIGN KEY (period_id) REFERENCES voc__period (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT FK_21AEDEE7F8922643 FOREIGN KEY (ritual_id) REFERENCES voc__g__ritual (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT FK_21AEDEE7C54C8C93 FOREIGN KEY (type_id) REFERENCES voc__g__type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT FK_21AEDEE7FE71FA16 FOREIGN KEY (preservation_state_id) REFERENCES voc__preservation_state (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE su ADD grave_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE su ADD CONSTRAINT FK_65A4BD79E439654A FOREIGN KEY (grave_id) REFERENCES grave (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_65A4BD79E439654A ON su (grave_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE su DROP CONSTRAINT FK_65A4BD79E439654A');
        $this->addSql('ALTER TABLE grave DROP CONSTRAINT FK_21AEDEE7F8922643');
        $this->addSql('ALTER TABLE grave DROP CONSTRAINT FK_21AEDEE7C54C8C93');
        $this->addSql('DROP SEQUENCE grave_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__g__ritual_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__g__type_id_seq CASCADE');
        $this->addSql('DROP TABLE grave');
        $this->addSql('DROP TABLE voc__g__ritual');
        $this->addSql('DROP TABLE voc__g__type');
        $this->addSql('DROP INDEX IDX_65A4BD79E439654A');
        $this->addSql('ALTER TABLE su DROP grave_id');
    }
}
