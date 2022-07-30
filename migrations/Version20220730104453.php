<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220730104453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Generate vw_typology VIEW';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<EOF
CREATE VIEW public.vw_typology
 AS
    WITH typologies AS (
        SELECT DISTINCT
            typology as code 
            FROM pottery
            WHERE typology IS NOT NULL
        ORDER BY code
    )
    SELECT
    REPLACE(
        REPLACE(
            ENCODE(code::bytea, 'base64'),
            '+',
            '-'
        ),
        '/',
        '_'    
    ) as id,
        code
    FROM typologies
EOF
        );

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW public.vw_typology;');
    }
}
