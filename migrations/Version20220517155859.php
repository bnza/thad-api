<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220517155859 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create VIEWS';
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

        $this->addSql(<<<EOF
CREATE VIEW vw_stratigraphic_relationships AS
SELECT 
id, sx_su_id, relationship_id, dx_su_id FROM stratigraphic_relationships
UNION
SELECT sr.id*-1, sr.dx_su_id as sx_su_id, r.inverted_by_id, sr.sx_su_id as dx_su_id FROM stratigraphic_relationships sr
LEFT JOIN voc__su__relationship r ON sr.relationship_id::char = r.id::char;
EOF);
        $this->addSql(<<<EOF
CREATE RULE __insert AS ON INSERT TO vw_stratigraphic_relationships DO INSTEAD 
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
        $this->addSql('CREATE RULE __delete AS ON DELETE TO vw_stratigraphic_relationships DO INSTEAD DELETE FROM stratigraphic_relationships WHERE id = ABS(OLD.id)');
        $this->addSql(<<<EOF
CREATE OR REPLACE VIEW public.vw_cumulative_pottery_sheet
 AS
 SELECT cumulative_pottery_sheet.id,
    cumulative_pottery_sheet.su_id,
    cumulative_pottery_sheet.date,
    cumulative_pottery_sheet.compiler,
    cumulative_pottery_sheet.notes,
    cumulative_pottery_sheet.common_ware_non_diagnostic_count,
    cumulative_pottery_sheet.common_ware_diagnostic_count,
    cumulative_pottery_sheet.fine_ware_non_diagnostic_count,
    cumulative_pottery_sheet.fine_ware_diagnostic_count,
    cumulative_pottery_sheet.coarse_ware_non_diagnostic_count,
    cumulative_pottery_sheet.coarse_ware_diagnostic_count,
    cumulative_pottery_sheet.kitchen_ware_non_diagnostic_count,
    cumulative_pottery_sheet.kitchen_ware_diagnostic_count,
    ( SELECT cumulative_pottery_sheet.common_ware_non_diagnostic_count + cumulative_pottery_sheet.common_ware_diagnostic_count + cumulative_pottery_sheet.fine_ware_non_diagnostic_count + cumulative_pottery_sheet.fine_ware_diagnostic_count + cumulative_pottery_sheet.coarse_ware_non_diagnostic_count + cumulative_pottery_sheet.coarse_ware_diagnostic_count + cumulative_pottery_sheet.kitchen_ware_non_diagnostic_count + cumulative_pottery_sheet.kitchen_ware_diagnostic_count) AS cumulative_ware_count,
    cumulative_pottery_sheet.subperiod_epn_count,
    cumulative_pottery_sheet.subperiod_has_count,
    cumulative_pottery_sheet.subperiod_sam_count,
    cumulative_pottery_sheet.subperiod_hal_count,
    cumulative_pottery_sheet.subperiod_nub_count,
    cumulative_pottery_sheet.subperiod_lca_count,
    cumulative_pottery_sheet.subperiod_lca1_count,
    cumulative_pottery_sheet.subperiod_lca2_count,
    cumulative_pottery_sheet.subperiod_lca3_count,
    cumulative_pottery_sheet.subperiod_lca4_count,
    cumulative_pottery_sheet.subperiod_lca5_count,
    cumulative_pottery_sheet.subperiod_sur_count,
    cumulative_pottery_sheet.subperiod_emt_count,
    cumulative_pottery_sheet.subperiod_emt0_count,
    cumulative_pottery_sheet.subperiod_emt1_count,
    cumulative_pottery_sheet.subperiod_emt2_count,
    cumulative_pottery_sheet.subperiod_emt3_count,
    cumulative_pottery_sheet.subperiod_emt4_count,
    cumulative_pottery_sheet.subperiod_emt5_count,
    cumulative_pottery_sheet.subperiod_mba_count,
    cumulative_pottery_sheet.subperiod_mba1_count,
    cumulative_pottery_sheet.subperiod_mba2_count,
    cumulative_pottery_sheet.subperiod_lba1_count,
    cumulative_pottery_sheet.subperiod_lba2_count,
    cumulative_pottery_sheet.subperiod_ira1_count,
    cumulative_pottery_sheet.subperiod_ira2_count,
    cumulative_pottery_sheet.subperiod_hel_count,
    cumulative_pottery_sheet.subperiod_par_count,
    cumulative_pottery_sheet.subperiod_byz_count,
    cumulative_pottery_sheet.subperiod_sas_count,
    cumulative_pottery_sheet.subperiod_isl_count,
    cumulative_pottery_sheet.subperiod_isl1_count,
    cumulative_pottery_sheet.subperiod_isl2_count,
    cumulative_pottery_sheet.subperiod_isl3_count,
    cumulative_pottery_sheet.subperiod_undetermined_count,
    ( SELECT cumulative_pottery_sheet.subperiod_epn_count 
        + cumulative_pottery_sheet.subperiod_has_count
        + cumulative_pottery_sheet.subperiod_sam_count
        + cumulative_pottery_sheet.subperiod_hal_count
        + cumulative_pottery_sheet.subperiod_nub_count
        + cumulative_pottery_sheet.subperiod_lca_count
        + cumulative_pottery_sheet.subperiod_lca1_count
        + cumulative_pottery_sheet.subperiod_lca2_count
        + cumulative_pottery_sheet.subperiod_lca3_count
        + cumulative_pottery_sheet.subperiod_lca4_count
        + cumulative_pottery_sheet.subperiod_lca5_count
        + cumulative_pottery_sheet.subperiod_sur_count
        + cumulative_pottery_sheet.subperiod_emt_count
        + cumulative_pottery_sheet.subperiod_emt0_count
        + cumulative_pottery_sheet.subperiod_emt1_count
        + cumulative_pottery_sheet.subperiod_emt2_count
        + cumulative_pottery_sheet.subperiod_emt3_count
        + cumulative_pottery_sheet.subperiod_emt4_count
        + cumulative_pottery_sheet.subperiod_emt5_count
        + cumulative_pottery_sheet.subperiod_mba_count
        + cumulative_pottery_sheet.subperiod_mba1_count
        + cumulative_pottery_sheet.subperiod_mba2_count
        + cumulative_pottery_sheet.subperiod_lba1_count
        + cumulative_pottery_sheet.subperiod_lba2_count
        + cumulative_pottery_sheet.subperiod_ira1_count
        + cumulative_pottery_sheet.subperiod_ira2_count
        + cumulative_pottery_sheet.subperiod_hel_count
        + cumulative_pottery_sheet.subperiod_par_count
        + cumulative_pottery_sheet.subperiod_byz_count
        + cumulative_pottery_sheet.subperiod_sas_count
        + cumulative_pottery_sheet.subperiod_isl_count
        + cumulative_pottery_sheet.subperiod_isl1_count
        + cumulative_pottery_sheet.subperiod_isl2_count
        + cumulative_pottery_sheet.subperiod_isl3_count
        + cumulative_pottery_sheet.subperiod_undetermined_count
    ) AS diagnostic_ware_count,
    cumulative_pottery_sheet.subperiod_epn_count AS period_epn_count,
    cumulative_pottery_sheet.subperiod_has_count AS period_has_count,
    cumulative_pottery_sheet.subperiod_sam_count AS period_sam_count,
    cumulative_pottery_sheet.subperiod_hal_count AS period_hal_count,
    cumulative_pottery_sheet.subperiod_nub_count AS period_nub_count,
    ( SELECT cumulative_pottery_sheet.subperiod_lca_count + cumulative_pottery_sheet.subperiod_lca1_count + cumulative_pottery_sheet.subperiod_lca2_count + cumulative_pottery_sheet.subperiod_lca3_count + cumulative_pottery_sheet.subperiod_lca4_count + cumulative_pottery_sheet.subperiod_lca5_count + cumulative_pottery_sheet.subperiod_sur_count) AS period_lca_count,
    ( SELECT cumulative_pottery_sheet.subperiod_emt_count + cumulative_pottery_sheet.subperiod_emt0_count + cumulative_pottery_sheet.subperiod_emt1_count + cumulative_pottery_sheet.subperiod_emt2_count + cumulative_pottery_sheet.subperiod_emt3_count + cumulative_pottery_sheet.subperiod_emt4_count + cumulative_pottery_sheet.subperiod_emt5_count) AS period_emt_count,
    ( SELECT cumulative_pottery_sheet.subperiod_mba_count + cumulative_pottery_sheet.subperiod_mba1_count + cumulative_pottery_sheet.subperiod_mba2_count) AS period_mba_count,
    ( SELECT cumulative_pottery_sheet.subperiod_lba1_count + cumulative_pottery_sheet.subperiod_lba2_count) AS period_lba_count,
    ( SELECT cumulative_pottery_sheet.subperiod_ira1_count + cumulative_pottery_sheet.subperiod_ira2_count) AS period_ira_count,
    cumulative_pottery_sheet.subperiod_hel_count AS period_hel_count,
    cumulative_pottery_sheet.subperiod_par_count AS period_par_count,
    cumulative_pottery_sheet.subperiod_byz_count AS period_byz_count,
    cumulative_pottery_sheet.subperiod_sas_count AS period_sas_count,
    ( SELECT cumulative_pottery_sheet.subperiod_isl_count + cumulative_pottery_sheet.subperiod_isl1_count + cumulative_pottery_sheet.subperiod_isl2_count + cumulative_pottery_sheet.subperiod_isl3_count) AS period_isl_count
   FROM cumulative_pottery_sheet;
EOF
);
        $this->addSql(<<<EOL
CREATE RULE __insert AS ON INSERT TO vw_cumulative_pottery_sheet DO INSTEAD 
INSERT INTO cumulative_pottery_sheet
(
	id,
	su_id,
	date,
	compiler,
	notes,
	common_ware_non_diagnostic_count,
	common_ware_diagnostic_count,
	fine_ware_non_diagnostic_count,
	fine_ware_diagnostic_count,
	coarse_ware_non_diagnostic_count,
	coarse_ware_diagnostic_count,
	kitchen_ware_non_diagnostic_count,
	kitchen_ware_diagnostic_count,
	subperiod_epn_count,
	subperiod_has_count,
	subperiod_sam_count,
	subperiod_hal_count,
	subperiod_nub_count,
	subperiod_lca_count,
	subperiod_lca1_count,
	subperiod_lca2_count,
	subperiod_lca3_count,
	subperiod_lca4_count,
	subperiod_lca5_count,
	subperiod_sur_count,
	subperiod_emt_count,
	subperiod_emt0_count,
	subperiod_emt1_count,
	subperiod_emt2_count,
	subperiod_emt3_count,
	subperiod_emt4_count,
	subperiod_emt5_count,
	subperiod_mba_count,
	subperiod_mba1_count,
	subperiod_mba2_count,
	subperiod_lba1_count,
	subperiod_lba2_count,
	subperiod_ira1_count,
	subperiod_ira2_count,
	subperiod_hel_count,
	subperiod_par_count,
	subperiod_byz_count,
	subperiod_sas_count,
	subperiod_isl_count,
	subperiod_isl1_count,
	subperiod_isl2_count,
	subperiod_isl3_count,
	subperiod_undetermined_count
)
VALUES
(
	NEW.id,
	NEW.su_id,
	NEW.date,
	NEW.compiler,
	NEW.notes,
	NEW.common_ware_non_diagnostic_count,
	NEW.common_ware_diagnostic_count,
	NEW.fine_ware_non_diagnostic_count,
	NEW.fine_ware_diagnostic_count,
	NEW.coarse_ware_non_diagnostic_count,
	NEW.coarse_ware_diagnostic_count,
	NEW.kitchen_ware_non_diagnostic_count,
	NEW.kitchen_ware_diagnostic_count,
	NEW.subperiod_epn_count,
	NEW.subperiod_has_count,
	NEW.subperiod_sam_count,
	NEW.subperiod_hal_count,
	NEW.subperiod_nub_count,
	NEW.subperiod_lca_count,
	NEW.subperiod_lca1_count,
	NEW.subperiod_lca2_count,
	NEW.subperiod_lca3_count,
	NEW.subperiod_lca4_count,
	NEW.subperiod_lca5_count,
	NEW.subperiod_sur_count,
	NEW.subperiod_emt_count,
	NEW.subperiod_emt0_count,
	NEW.subperiod_emt1_count,
	NEW.subperiod_emt2_count,
	NEW.subperiod_emt3_count,
	NEW.subperiod_emt4_count,
	NEW.subperiod_emt5_count,
	NEW.subperiod_mba_count,
	NEW.subperiod_mba1_count,
	NEW.subperiod_mba2_count,
	NEW.subperiod_lba1_count,
	NEW.subperiod_lba2_count,
	NEW.subperiod_ira1_count,
	NEW.subperiod_ira2_count,
	NEW.subperiod_hel_count,
	NEW.subperiod_par_count,
	NEW.subperiod_byz_count,
	NEW.subperiod_sas_count,
	NEW.subperiod_isl_count,
	NEW.subperiod_isl1_count,
	NEW.subperiod_isl2_count,
	NEW.subperiod_isl3_count,
	NEW.subperiod_undetermined_count
);
EOL
);
        $this->addSql(<<<EOL
CREATE RULE __update AS ON UPDATE TO vw_cumulative_pottery_sheet DO INSTEAD 
UPDATE public.cumulative_pottery_sheet
	SET 
	su_id=NEW.su_id, 
	date=NEW.date, 
	compiler=NEW.compiler,
	notes=NEW.notes, 
	common_ware_non_diagnostic_count=NEW.common_ware_non_diagnostic_count, 
	common_ware_diagnostic_count=NEW.common_ware_diagnostic_count,
	fine_ware_non_diagnostic_count=NEW.fine_ware_non_diagnostic_count, 
	fine_ware_diagnostic_count=NEW.fine_ware_diagnostic_count, 
	coarse_ware_non_diagnostic_count=NEW.coarse_ware_non_diagnostic_count, 
	coarse_ware_diagnostic_count=NEW.coarse_ware_diagnostic_count, 
	kitchen_ware_non_diagnostic_count=NEW.kitchen_ware_non_diagnostic_count,
	kitchen_ware_diagnostic_count=NEW.kitchen_ware_diagnostic_count, 
	subperiod_epn_count=NEW.subperiod_epn_count, 
	subperiod_has_count=NEW.subperiod_has_count, 
	subperiod_sam_count=NEW.subperiod_sam_count, 
	subperiod_hal_count=NEW.subperiod_hal_count, 
	subperiod_nub_count=NEW.subperiod_nub_count, 
	subperiod_lca_count=NEW.subperiod_lca_count, 
	subperiod_lca1_count=NEW.subperiod_lca_count, 
	subperiod_lca2_count=NEW.subperiod_lca2_count, 
	subperiod_lca3_count=NEW.subperiod_lca3_count, 
	subperiod_lca4_count=NEW.subperiod_lca4_count, 
	subperiod_lca5_count=NEW.subperiod_lca5_count, 
	subperiod_sur_count=NEW.subperiod_sur_count, 
	subperiod_emt_count=NEW.subperiod_emt_count,
	subperiod_emt0_count=NEW.subperiod_emt0_count,
	subperiod_emt1_count=NEW.subperiod_emt1_count, 
	subperiod_emt2_count=NEW.subperiod_emt2_count, 
	subperiod_emt3_count=NEW.subperiod_emt3_count, 
	subperiod_emt4_count=NEW.subperiod_emt4_count, 
	subperiod_emt5_count=NEW.subperiod_emt5_count, 
	subperiod_mba_count=NEW.subperiod_mba_count, 
	subperiod_mba1_count=NEW.subperiod_mba1_count, 
	subperiod_mba2_count=NEW.subperiod_mba2_count, 
	subperiod_lba1_count=NEW.subperiod_lba1_count, 
	subperiod_lba2_count=NEW.subperiod_lba2_count, 
	subperiod_ira1_count=NEW.subperiod_ira1_count, 
	subperiod_ira2_count=NEW.subperiod_ira2_count, 
	subperiod_hel_count=NEW.subperiod_hel_count, 
	subperiod_par_count=NEW.subperiod_par_count, 
	subperiod_byz_count=NEW.subperiod_byz_count, 
	subperiod_sas_count=NEW.subperiod_sas_count, 
	subperiod_isl_count=NEW.subperiod_isl_count, 
	subperiod_isl1_count=NEW.subperiod_isl1_count, 
	subperiod_isl2_count=NEW.subperiod_isl2_count, 
	subperiod_isl3_count=NEW.subperiod_isl3_count, 
	subperiod_undetermined_count=NEW.subperiod_undetermined_count
	WHERE id=OLD.id;
EOL
);
        $this->addSql('CREATE RULE __delete AS ON DELETE TO vw_cumulative_pottery_sheet DO INSTEAD DELETE FROM cumulative_pottery_sheet WHERE id = OLD.id');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW vw_stratigraphic_sequence;');
        $this->addSql('DROP VIEW vw_stratigraphic_relationships;');
        $this->addSql('DROP VIEW vw_cumulative_pottery_sheet;');
    }
}
