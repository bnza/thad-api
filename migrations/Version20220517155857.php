<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220517155857 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create PostGIS';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE EXTENSION IF NOT EXISTS plpgsql;');
        $this->addSql('DROP EXTENSION IF EXISTS postgis_topology;');
        $this->addSql('DROP EXTENSION IF EXISTS postgis_tiger_geocoder;');
        $this->addSql('CREATE EXTENSION IF NOT EXISTS postgis;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP EXTENSION postgis;');
    }
}
