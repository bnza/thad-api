<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220708084331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE small_find ADD coord_n DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE small_find ADD coord_e DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE small_find ADD coord_z DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE small_find DROP coord_n');
        $this->addSql('ALTER TABLE small_find DROP coord_e');
        $this->addSql('ALTER TABLE small_find DROP coord_z');
    }
}
