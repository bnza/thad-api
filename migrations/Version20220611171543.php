<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220611171543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE media_objects__small_finds_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE media_objects__small_finds (id INT NOT NULL, small_find_id INT NOT NULL, media_object_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_12A190F01EBC97E5 ON media_objects__small_finds (small_find_id)');
        $this->addSql('CREATE INDEX IDX_12A190F064DE5A5 ON media_objects__small_finds (media_object_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_12A190F01EBC97E564DE5A5 ON media_objects__small_finds (small_find_id, media_object_id)');
        $this->addSql('ALTER TABLE media_objects__small_finds ADD CONSTRAINT FK_12A190F01EBC97E5 FOREIGN KEY (small_find_id) REFERENCES small_find (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__small_finds ADD CONSTRAINT FK_12A190F064DE5A5 FOREIGN KEY (media_object_id) REFERENCES media_object (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__potteries ALTER pottery_id SET NOT NULL');
        $this->addSql('ALTER TABLE media_objects__potteries ALTER media_object_id SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE media_objects__small_finds_id_seq CASCADE');
        $this->addSql('DROP TABLE media_objects__small_finds');
        $this->addSql('ALTER TABLE media_objects__potteries ALTER pottery_id DROP NOT NULL');
        $this->addSql('ALTER TABLE media_objects__potteries ALTER media_object_id DROP NOT NULL');
    }
}
