<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220517155856 extends AbstractMigration
{
    private bool $skip;

    public function getDescription(): string
    {
        return 'Create PostGIS users';
    }

    public function preUp(Schema $schema): void
    {
        $this->skip = (bool) $this->connection->executeQuery('SELECT 1 FROM pg_roles WHERE rolname=\'gis_base\'')->fetchOne();
    }

    public function up(Schema $schema): void
    {
        if (!$this->skip) {
            $this->addSql('CREATE ROLE gis_base NOSUPERUSER;');
            $this->addSql('CREATE ROLE gis_editor NOSUPERUSER IN ROLE gis_base;');
            $this->addSql('CREATE ROLE gis_admin NOSUPERUSER IN ROLE gis_editor;');
            $this->addSql(sprintf('CREATE USER gis_admin_user NOSUPERUSER IN ROLE gis_admin ENCRYPTED PASSWORD \'%s\'', $_ENV['USER_GIS_ADMIN_PW']));
            $this->addSql(sprintf('CREATE USER gis_editor_user NOSUPERUSER IN ROLE gis_editor ENCRYPTED PASSWORD \'%s\'', $_ENV['USER_GIS_EDITOR_PW']));
            $this->addSql(sprintf('CREATE USER gis_base_user NOSUPERUSER IN ROLE gis_base ENCRYPTED PASSWORD \'%s\'', $_ENV['USER_GIS_BASE_PW']));
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP ROLE IF EXISTS gis_admin_user;');
        $this->addSql('DROP ROLE IF EXISTS gis_editor_user;');
        $this->addSql('DROP ROLE IF EXISTS gis_base_user;');
        $this->addSql('DROP ROLE gis_admin;');
        $this->addSql('DROP ROLE gis_editor;');
        $this->addSql('DROP ROLE gis_base;');
    }
}
