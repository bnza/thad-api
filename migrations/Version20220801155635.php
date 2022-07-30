<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220801155635 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Generate vw_nominative VIEW';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP VIEW IF EXISTS public.vw_nominative;');
        $this->addSql(<<<EOF
CREATE VIEW public.vw_nominative
 AS
WITH nominatives AS (
    SELECT DISTINCT compiler as name FROM su
    UNION
    SELECT DISTINCT area_supervisor as name FROM su WHERE area_supervisor IS NOT NULL
    UNION
    SELECT DISTINCT compiler as name FROM grave
    UNION
    SELECT DISTINCT area_supervisor as name FROM grave WHERE area_supervisor IS NOT NULL
    UNION
    SELECT DISTINCT compiler as name FROM ecofact
    UNION
    SELECT DISTINCT compiler as name FROM small_find
    UNION
    SELECT DISTINCT compiler as name FROM sample
    UNION
    SELECT DISTINCT creator as name FROM document
    UNION
    SELECT DISTINCT area_supervisor as name FROM document WHERE area_supervisor IS NOT NULL
    GROUP BY name
    ORDER BY name
)
SELECT
    REPLACE(
            REPLACE(
                    ENCODE(name::bytea, 'base64'),
                    '+',
                    '-'
                ),
            '/',
            '_'
        ) as id,
    name
FROM nominatives;
EOF
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW public.vw_nominative;');
    }
}
