<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220507103929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE voc__period_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE voc__period (id SMALLINT NOT NULL, parent_id SMALLINT DEFAULT NULL, code VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_15F30C99727ACA70 ON voc__period (parent_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_15F30C991D775834 ON voc__period (value)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_15F30C9977153098 ON voc__period (code)');
        $this->addSql('ALTER TABLE voc__period ADD CONSTRAINT FK_15F30C99727ACA70 FOREIGN KEY (parent_id) REFERENCES voc__period (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery ADD period_id SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A651839EC8B7ADE FOREIGN KEY (period_id) REFERENCES voc__period (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1A651839EC8B7ADE ON pottery (period_id)');
        $this->addSql('ALTER TABLE su ADD period_id SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE su ALTER type_id SET NOT NULL');
        $this->addSql('ALTER TABLE su ADD CONSTRAINT FK_65A4BD79EC8B7ADE FOREIGN KEY (period_id) REFERENCES voc__period (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_65A4BD79EC8B7ADE ON su (period_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A651839EC8B7ADE');
        $this->addSql('ALTER TABLE su DROP CONSTRAINT FK_65A4BD79EC8B7ADE');
        $this->addSql('ALTER TABLE voc__period DROP CONSTRAINT FK_15F30C99727ACA70');
        $this->addSql('DROP SEQUENCE voc__period_id_seq CASCADE');
        $this->addSql('DROP TABLE voc__period');
        $this->addSql('DROP INDEX IDX_1A651839EC8B7ADE');
        $this->addSql('ALTER TABLE pottery DROP period_id');
        $this->addSql('DROP INDEX IDX_65A4BD79EC8B7ADE');
        $this->addSql('ALTER TABLE su DROP period_id');
        $this->addSql('ALTER TABLE su ALTER type_id DROP NOT NULL');
    }
}
