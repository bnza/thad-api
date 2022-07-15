<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220715061937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grave DROP CONSTRAINT fk_21aedee76a154197');
        $this->addSql('ALTER TABLE grave DROP CONSTRAINT fk_21aedee7c902ad2d');
        $this->addSql('ALTER TABLE grave DROP CONSTRAINT fk_21aedee78ce56243');
        $this->addSql('DROP INDEX uniq_21aedee7c902ad2d');
        $this->addSql('DROP INDEX uniq_21aedee78ce56243');
        $this->addSql('DROP INDEX uniq_21aedee76a154197');
        $this->addSql('ALTER TABLE grave DROP cut_stratigraphic_unit_id');
        $this->addSql('ALTER TABLE grave DROP fill_stratigraphic_unit_id');
        $this->addSql('ALTER TABLE grave DROP skeleton_stratigraphic_unit_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE grave ADD cut_stratigraphic_unit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE grave ADD fill_stratigraphic_unit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE grave ADD skeleton_stratigraphic_unit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT fk_21aedee76a154197 FOREIGN KEY (cut_stratigraphic_unit_id) REFERENCES su (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT fk_21aedee7c902ad2d FOREIGN KEY (fill_stratigraphic_unit_id) REFERENCES su (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT fk_21aedee78ce56243 FOREIGN KEY (skeleton_stratigraphic_unit_id) REFERENCES su (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_21aedee7c902ad2d ON grave (fill_stratigraphic_unit_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_21aedee78ce56243 ON grave (skeleton_stratigraphic_unit_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_21aedee76a154197 ON grave (cut_stratigraphic_unit_id)');
    }
}
