<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220519093048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE geom.site_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE geom.su_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE geom.site (id INT NOT NULL, site_id INT DEFAULT NULL, geom geometry(MULTIPOLYGON, 4326) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B9623109F6BD1646 ON geom.site (site_id)');
        $this->addSql('CREATE TABLE geom.su (id INT NOT NULL, su_id INT DEFAULT NULL, geom geometry(MULTIPOLYGON, 4326) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4FC438D2BDB1218E ON geom.su (su_id)');
        $this->addSql('ALTER TABLE geom.site ADD CONSTRAINT FK_B9623109F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE geom.su ADD CONSTRAINT FK_4FC438D2BDB1218E FOREIGN KEY (su_id) REFERENCES su (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE geom.site_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE geom.su_id_seq CASCADE');
        $this->addSql('DROP TABLE geom.site');
        $this->addSql('DROP TABLE geom.su');
    }
}
