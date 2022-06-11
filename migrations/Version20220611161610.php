<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220611161610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE media_objects__potteries_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE media_objects__potteries (id INT NOT NULL, pottery_id INT DEFAULT NULL, media_object_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4AE07489F23816BB ON media_objects__potteries (pottery_id)');
        $this->addSql('CREATE INDEX IDX_4AE0748964DE5A5 ON media_objects__potteries (media_object_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4AE07489F23816BB64DE5A5 ON media_objects__potteries (pottery_id, media_object_id)');
        $this->addSql('ALTER TABLE media_objects__potteries ADD CONSTRAINT FK_4AE07489F23816BB FOREIGN KEY (pottery_id) REFERENCES pottery (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__potteries ADD CONSTRAINT FK_4AE0748964DE5A5 FOREIGN KEY (media_object_id) REFERENCES media_object (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE media_objects__potteries_id_seq CASCADE');
        $this->addSql('DROP TABLE media_objects__potteries');
    }
}
