<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220604111723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<EOF
CREATE VIEW vw_stratigraphic_sequence AS
SELECT 
id, sx_su_id, relationship_id, dx_su_id FROM stratigraphic_sequence
UNION
SELECT id*-1, dx_su_id as sx_su_id, relationship_id*-1, sx_su_id as dx_su_id FROM stratigraphic_sequence
EOF);
        $this->addSql(<<<EOF
CREATE RULE __insert AS ON INSERT TO vw_stratigraphic_sequence DO INSTEAD 
INSERT INTO stratigraphic_sequence 
(
	id,
	sx_su_id, 
	dx_su_id, 
	relationship_id
) 
VALUES
(
	NEW.id,
	NEW.sx_su_id,
	NEW.dx_su_id,
	NEW.relationship_id
)
EOF);
        $this->addSql('CREATE RULE __delete AS ON DELETE TO vw_stratigraphic_sequence DO INSTEAD DELETE FROM stratigraphic_sequence WHERE id = ABS(OLD.id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW vw_stratigraphic_sequence;');
    }
}
