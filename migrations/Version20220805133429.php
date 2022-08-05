<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220805133429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media_objects__sus ALTER su_id SET NOT NULL');
        $this->addSql('ALTER TABLE media_objects__sus ALTER media_object_id SET NOT NULL');
        $this->addSql('ALTER TABLE stratigraphic_relationships ALTER sx_su_id SET NOT NULL');
        $this->addSql('ALTER TABLE stratigraphic_relationships ALTER dx_su_id SET NOT NULL');
        $this->addSql('ALTER TABLE stratigraphic_relationships ALTER relationship_id SET NOT NULL');
        $this->addSql('ALTER TABLE stratigraphic_sequence ALTER sx_su_id SET NOT NULL');
        $this->addSql('ALTER TABLE stratigraphic_sequence ALTER dx_su_id SET NOT NULL');
        $this->addSql('ALTER TABLE stratigraphic_sequence ALTER relationship_id SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE media_objects__sus ALTER su_id DROP NOT NULL');
        $this->addSql('ALTER TABLE media_objects__sus ALTER media_object_id DROP NOT NULL');
        $this->addSql('ALTER TABLE stratigraphic_relationships ALTER sx_su_id DROP NOT NULL');
        $this->addSql('ALTER TABLE stratigraphic_relationships ALTER dx_su_id DROP NOT NULL');
        $this->addSql('ALTER TABLE stratigraphic_relationships ALTER relationship_id DROP NOT NULL');
        $this->addSql('ALTER TABLE stratigraphic_sequence ALTER sx_su_id DROP NOT NULL');
        $this->addSql('ALTER TABLE stratigraphic_sequence ALTER dx_su_id DROP NOT NULL');
        $this->addSql('ALTER TABLE stratigraphic_sequence ALTER relationship_id DROP NOT NULL');
    }
}
