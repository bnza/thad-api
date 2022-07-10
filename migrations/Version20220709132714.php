<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220709132714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Generate vw_nominative VIEW';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<EOF
CREATE VIEW public.vw_nominative
 AS
    SELECT DISTINCT compiler as name FROM su
    UNION
    SELECT DISTINCT area_supervisor as name FROM su
    UNION
    SELECT DISTINCT compiler as name FROM grave
    UNION
    SELECT DISTINCT area_supervisor as name FROM grave
    UNION
    SELECT DISTINCT compiler as name FROM ecofact
    UNION
    SELECT DISTINCT compiler as name FROM small_find
    UNION
    SELECT DISTINCT compiler as name FROM sample
    UNION
    SELECT DISTINCT creator as name FROM document
    UNION
    SELECT DISTINCT area_supervisor as name FROM document
    GROUP BY name
    ORDER BY name;
EOF
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW public.vw_nominative;');
    }
}
