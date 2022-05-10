<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220510104416 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create VIEW "vw_stratigraphic_relationships"';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<EOF
CREATE VIEW vw_stratigraphic_relationships AS
SELECT 
id, sx_su_id, relationship_id, dx_su_id FROM stratigraphic_relationships
UNION
SELECT sr.id*-1, sr.dx_su_id as sx_su_id, r.inverted_by_id, sr.sx_su_id as dx_su_id FROM stratigraphic_relationships sr
LEFT JOIN voc__su__relationship r ON sr.relationship_id::char = r.id::char;
EOF);
        $this->addSql(<<<EOF
CREATE RULE insert__stratigraphic_relationship AS ON INSERT TO vw_stratigraphic_relationships DO INSTEAD 
INSERT INTO stratigraphic_relationships 
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
        $this->addSql('CREATE RULE delete__stratigraphic_relationship AS ON DELETE TO vw_stratigraphic_relationships DO INSTEAD DELETE FROM stratigraphic_relationships WHERE id = ABS(OLD.id)');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW vw_stratigraphic_relationships;');
    }
}
