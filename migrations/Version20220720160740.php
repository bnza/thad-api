<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220720160740 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE decorations__potteries_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE decorations__small_finds_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE decorations__potteries (id INT NOT NULL, pottery_id INT NOT NULL, decoration_id SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5E405C87F23816BB ON decorations__potteries (pottery_id)');
        $this->addSql('CREATE INDEX IDX_5E405C873446DFC4 ON decorations__potteries (decoration_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5E405C87F23816BB3446DFC4 ON decorations__potteries (pottery_id, decoration_id)');
        $this->addSql('CREATE TABLE decorations__small_finds (id INT NOT NULL, small_find_id INT NOT NULL, decoration_id SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B99701241EBC97E5 ON decorations__small_finds (small_find_id)');
        $this->addSql('CREATE INDEX IDX_B99701243446DFC4 ON decorations__small_finds (decoration_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B99701241EBC97E53446DFC4 ON decorations__small_finds (small_find_id, decoration_id)');
        $this->addSql('ALTER TABLE decorations__potteries ADD CONSTRAINT FK_5E405C87F23816BB FOREIGN KEY (pottery_id) REFERENCES pottery (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE decorations__potteries ADD CONSTRAINT FK_5E405C873446DFC4 FOREIGN KEY (decoration_id) REFERENCES voc__decoration (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE decorations__small_finds ADD CONSTRAINT FK_B99701241EBC97E5 FOREIGN KEY (small_find_id) REFERENCES small_find (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE decorations__small_finds ADD CONSTRAINT FK_B99701243446DFC4 FOREIGN KEY (decoration_id) REFERENCES voc__decoration (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT fk_1a6518393446dfc4');
        $this->addSql('DROP INDEX idx_1a6518393446dfc4');
        $this->addSql('ALTER TABLE pottery DROP decoration_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE decorations__potteries_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE decorations__small_finds_id_seq CASCADE');
        $this->addSql('DROP TABLE decorations__potteries');
        $this->addSql('DROP TABLE decorations__small_finds');
        $this->addSql('ALTER TABLE pottery ADD decoration_id SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT fk_1a6518393446dfc4 FOREIGN KEY (decoration_id) REFERENCES voc__decoration (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_1a6518393446dfc4 ON pottery (decoration_id)');
    }
}
