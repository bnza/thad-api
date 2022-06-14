<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220613171804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grave ADD building SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE grave ADD room VARCHAR(3) DEFAULT NULL');
        $this->addSql('ALTER TABLE grave ADD phase SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE su ADD building SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE su ADD room VARCHAR(3) DEFAULT NULL');
        $this->addSql('ALTER TABLE su ADD phase SMALLINT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE su DROP building');
        $this->addSql('ALTER TABLE su DROP room');
        $this->addSql('ALTER TABLE su DROP phase');
        $this->addSql('ALTER TABLE grave DROP building');
        $this->addSql('ALTER TABLE grave DROP room');
        $this->addSql('ALTER TABLE grave DROP phase');
    }
}
