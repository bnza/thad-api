<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220503184054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pottery ADD spout_id SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE pottery ADD size_group_id SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A6518391E5860E8 FOREIGN KEY (spout_id) REFERENCES voc__p__spout (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A651839A06F4D9B FOREIGN KEY (size_group_id) REFERENCES voc__p__size_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1A6518391E5860E8 ON pottery (spout_id)');
        $this->addSql('CREATE INDEX IDX_1A651839A06F4D9B ON pottery (size_group_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A6518391E5860E8');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A651839A06F4D9B');
        $this->addSql('DROP INDEX IDX_1A6518391E5860E8');
        $this->addSql('DROP INDEX IDX_1A651839A06F4D9B');
        $this->addSql('ALTER TABLE pottery DROP spout_id');
        $this->addSql('ALTER TABLE pottery DROP size_group_id');
    }
}
