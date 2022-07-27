<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220727162816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE small_find DROP CONSTRAINT fk_2e109a893446dfc4');
        $this->addSql('DROP INDEX idx_2e109a893446dfc4');
        $this->addSql('ALTER TABLE small_find DROP decoration_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE small_find ADD decoration_id SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE small_find ADD CONSTRAINT fk_2e109a893446dfc4 FOREIGN KEY (decoration_id) REFERENCES voc__decoration (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_2e109a893446dfc4 ON small_find (decoration_id)');
    }
}
