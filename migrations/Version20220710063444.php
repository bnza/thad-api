<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220710063444 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cumulative_pottery_sheet ALTER compiler SET NOT NULL');
        $this->addSql('ALTER TABLE ecofact ALTER compiler SET NOT NULL');
        $this->addSql('ALTER TABLE grave ALTER compiler SET NOT NULL');
        $this->addSql('ALTER TABLE pottery ALTER compiler SET NOT NULL');
        $this->addSql('ALTER TABLE sample ALTER compiler SET NOT NULL');
        $this->addSql('ALTER TABLE small_find ALTER compiler SET NOT NULL');
        $this->addSql('ALTER TABLE su ALTER compiler SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE cumulative_pottery_sheet ALTER compiler DROP NOT NULL');
        $this->addSql('ALTER TABLE ecofact ALTER compiler DROP NOT NULL');
        $this->addSql('ALTER TABLE grave ALTER compiler DROP NOT NULL');
        $this->addSql('ALTER TABLE pottery ALTER compiler DROP NOT NULL');
        $this->addSql('ALTER TABLE sample ALTER compiler DROP NOT NULL');
        $this->addSql('ALTER TABLE small_find ALTER compiler DROP NOT NULL');
        $this->addSql('ALTER TABLE su ALTER compiler DROP NOT NULL');
    }
}
