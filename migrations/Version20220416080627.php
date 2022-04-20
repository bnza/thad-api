<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220416080627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE su ADD site_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE su ADD CONSTRAINT FK_65A4BD79F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_65A4BD79F6BD1646 ON su (site_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_65A4BD79F6BD164696901F54 ON su (site_id, number)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE su DROP CONSTRAINT FK_65A4BD79F6BD1646');
        $this->addSql('DROP INDEX IDX_65A4BD79F6BD1646');
        $this->addSql('DROP INDEX UNIQ_65A4BD79F6BD164696901F54');
        $this->addSql('ALTER TABLE su DROP site_id');
    }
}
