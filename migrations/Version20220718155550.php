<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220718155550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Generate appId VIEWS';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<EOF
CREATE VIEW vw_app_id__su AS
    SELECT 
        su.id,
        su.site_id,
        su.area_id,
        s.code || '.' || substring(su.year::VARCHAR, 3) || '.SU.' || lpad(su.number::VARCHAR, 5, '0') AS code 
    FROM su
    LEFT JOIN site s on su.site_id = s.id
EOF);
        $this->addSql(<<<EOF
CREATE VIEW vw_app_id__pottery AS
    SELECT 
        o.id,
        s.code || '.' || substring(su.year::VARCHAR, 3) || '.' || lpad(su.number::VARCHAR, 5, '0') || '.P.' || o.number AS code
    FROM pottery o
    LEFT JOIN su ON o.su_id = su.id
    LEFT JOIN site s on su.site_id = s.id
EOF);
        $this->addSql(<<<EOF
CREATE VIEW vw_app_id__sample AS
    SELECT
        o.id,
        s.code || '.' || substring(su.year::VARCHAR, 3) || '.' || lpad(su.number::VARCHAR, 5, '0') || '.S.' || o.number AS code
    FROM sample o
         LEFT JOIN su ON o.su_id = su.id
         LEFT JOIN site s on su.site_id = s.id
EOF);
        $this->addSql(<<<EOF
CREATE VIEW vw_app_id__small_find AS
    SELECT
        o.id,
        s.code || '.' || substring(su.year::VARCHAR, 3) || '.' || lpad(su.number::VARCHAR, 5, '0') || '.O.' || o.number AS code
    FROM small_find o
         LEFT JOIN su ON o.su_id = su.id
         LEFT JOIN site s on su.site_id = s.id
EOF);
        $this->addSql(<<<EOF
CREATE VIEW vw_app_id__ecofact AS
    SELECT
        o.id,
        s.code || '.' || substring(su.year::VARCHAR, 3) || '.' || lpad(su.number::VARCHAR, 5, '0') || '.E.' || o.number AS code
    FROM ecofact o
         LEFT JOIN su ON o.su_id = su.id
         LEFT JOIN site s on su.site_id = s.id
EOF);
        $this->addSql(<<<EOF
CREATE VIEW vw_app_id__cumulative_pottery_sheet AS
    SELECT
        o.id,
        s.code || '.' || substring(su.year::VARCHAR, 3) || '.' || lpad(su.number::VARCHAR, 5, '0') || '.CP' AS code
    FROM cumulative_pottery_sheet o
         LEFT JOIN su ON o.su_id = su.id
         LEFT JOIN site s on su.site_id = s.id
EOF);
        $this->addSql(<<<EOF
CREATE VIEW vw_app_id__grave AS
    SELECT
        o.id,
        s.code || '.' || substring(o.year::VARCHAR, 3) || '.G.' || lpad(o.number::VARCHAR, 5, '0') AS code
    FROM grave o
        LEFT JOIN site s ON o.site_id = s.id
EOF);
        $this->addSql(<<<EOF
CREATE VIEW vw_app_id__document AS
    SELECT
        o.id,
        s.code || '.' || substring(o.year::VARCHAR, 3) || '.D.' || lpad(o.number::VARCHAR, 5, '0') AS code
    FROM document o
        LEFT JOIN site s ON o.site_id = s.id
EOF);
        $this->addSql(<<<EOF
CREATE VIEW vw_app_id__area AS
    SELECT
        a.id,
        s.id as site_id,
        s.code || '.' || a.code as code
    FROM area a
    LEFT JOIN site s on a.site_id = s.id
EOF);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW vw_app_id__area;');
        $this->addSql('DROP VIEW vw_app_id__su;');
        $this->addSql('DROP VIEW vw_app_id__pottery;');
        $this->addSql('DROP VIEW vw_app_id__sample;');
        $this->addSql('DROP VIEW vw_app_id__small_find;');
        $this->addSql('DROP VIEW vw_app_id__ecofact;');
        $this->addSql('DROP VIEW vw_app_id__cumulative_pottery_sheet;');
        $this->addSql('DROP VIEW vw_app_id__grave;');
        $this->addSql('DROP VIEW vw_app_id__document;');
    }
}
