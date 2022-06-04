<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220604111634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE stratigraphic_sequence_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE stratigraphic_sequence (id INT NOT NULL, sx_su_id INT DEFAULT NULL, dx_su_id INT DEFAULT NULL, relationship_id SMALLINT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4DAEB91F1E31BBE7 ON stratigraphic_sequence (sx_su_id)');
        $this->addSql('CREATE INDEX IDX_4DAEB91F684F83D5 ON stratigraphic_sequence (dx_su_id)');
        $this->addSql('CREATE INDEX IDX_4DAEB91F2C41D668 ON stratigraphic_sequence (relationship_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4DAEB91F1E31BBE7684F83D5 ON stratigraphic_sequence (sx_su_id, dx_su_id)');
        $this->addSql('CREATE TABLE voc__su__sequence (id SMALLINT NOT NULL, inverted_by_id SMALLINT DEFAULT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BF13265BC4CDAD40 ON voc__su__sequence (inverted_by_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BF13265B1D775834 ON voc__su__sequence (value)');
        $this->addSql('ALTER TABLE stratigraphic_sequence ADD CONSTRAINT FK_4DAEB91F1E31BBE7 FOREIGN KEY (sx_su_id) REFERENCES su (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stratigraphic_sequence ADD CONSTRAINT FK_4DAEB91F684F83D5 FOREIGN KEY (dx_su_id) REFERENCES su (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stratigraphic_sequence ADD CONSTRAINT FK_4DAEB91F2C41D668 FOREIGN KEY (relationship_id) REFERENCES voc__su__sequence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE voc__su__sequence ADD CONSTRAINT FK_BF13265BC4CDAD40 FOREIGN KEY (inverted_by_id) REFERENCES voc__su__sequence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE stratigraphic_sequence DROP CONSTRAINT FK_4DAEB91F2C41D668');
        $this->addSql('ALTER TABLE voc__su__sequence DROP CONSTRAINT FK_BF13265BC4CDAD40');
        $this->addSql('DROP SEQUENCE stratigraphic_sequence_id_seq CASCADE');
        $this->addSql('DROP TABLE stratigraphic_sequence');
        $this->addSql('DROP TABLE voc__su__sequence');
    }
}
