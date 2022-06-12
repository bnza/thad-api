<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220612102343 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE media_objects__samples_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE media_objects__samples (id INT NOT NULL, sample_id INT NOT NULL, media_object_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1F6DF7861B1FEA20 ON media_objects__samples (sample_id)');
        $this->addSql('CREATE INDEX IDX_1F6DF78664DE5A5 ON media_objects__samples (media_object_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1F6DF7861B1FEA2064DE5A5 ON media_objects__samples (sample_id, media_object_id)');
        $this->addSql('ALTER TABLE media_objects__samples ADD CONSTRAINT FK_1F6DF7861B1FEA20 FOREIGN KEY (sample_id) REFERENCES sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__samples ADD CONSTRAINT FK_1F6DF78664DE5A5 FOREIGN KEY (media_object_id) REFERENCES media_object (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE media_objects__samples_id_seq CASCADE');
        $this->addSql('DROP TABLE media_objects__samples');
    }
}
