<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220721163418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE media_objects__building_room_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE media_objects__building_room (id INT NOT NULL, media_object_id INT NOT NULL, building SMALLINT NOT NULL, room VARCHAR(2) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A0DA09A664DE5A5 ON media_objects__building_room (media_object_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A0DA09A6E16F61D4729F519B64DE5A5 ON media_objects__building_room (building, room, media_object_id)');
        $this->addSql('ALTER TABLE media_objects__building_room ADD CONSTRAINT FK_A0DA09A664DE5A5 FOREIGN KEY (media_object_id) REFERENCES media_object (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE media_objects__building_room_id_seq CASCADE');
        $this->addSql('DROP TABLE media_objects__building_room');
    }
}
