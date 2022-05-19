<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220519093049 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Set GIS users permissions';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('GRANT USAGE ON SCHEMA geom TO gis_base;');
        $this->addSql('GRANT SELECT, REFERENCES ON TABLE public.site, public.su, geom.site, geom.su TO gis_base;');
        $this->addSql('GRANT ALL ON TABLE geom.su TO gis_editor;');
        $this->addSql('GRANT USAGE ON SEQUENCE geom.su_id_seq TO gis_editor;');
        $this->addSql('GRANT ALL ON TABLE geom.site TO gis_admin;');
        $this->addSql('GRANT USAGE ON SEQUENCE geom.site_id_seq TO gis_admin;');
        $this->createInsertFunctions();
    }

    public function down(Schema $schema): void
    {
        $this->addSql('REVOKE ALL ON TABLE geom.site FROM gis_admin;');
        $this->addSql('REVOKE ALL ON SEQUENCE geom.site_id_seq FROM gis_admin;');
        $this->addSql('REVOKE ALL ON TABLE geom.su FROM gis_editor;');
        $this->addSql('REVOKE ALL ON SEQUENCE geom.su_id_seq FROM gis_editor;');
        $this->addSql('REVOKE ALL ON TABLE public.site, public.su, geom.site, geom.su FROM gis_base');
        $this->addSql('REVOKE ALL ON SCHEMA geom FROM gis_base');
        $this->dropInsertRules();
    }

    private function createInsertFunctions()
    {
        $this->addSql(<<<EOL
CREATE FUNCTION geom.tf__nextval_id__site()
    RETURNS trigger
    LANGUAGE 'plpgsql'
     NOT LEAKPROOF
AS \$BODY\$
BEGIN
  IF (TG_OP = 'INSERT') THEN
      NEW.id = COALESCE(NEW.id, nextval('"geom".site_id_seq'::regclass));
      RETURN NEW;
  END IF;
END;
\$BODY\$;
EOL);
        $this->addSql(<<<EOL
CREATE TRIGGER __nextval_id
    BEFORE INSERT
    ON geom.site
    FOR EACH ROW
    EXECUTE FUNCTION geom.tf__nextval_id__site()
EOL);
        $this->addSql(<<<EOL
CREATE FUNCTION geom.tf__nextval_id__su()
    RETURNS trigger
    LANGUAGE 'plpgsql'
     NOT LEAKPROOF
AS \$BODY\$
BEGIN
  IF (TG_OP = 'INSERT') THEN
      NEW.id = COALESCE(NEW.id, nextval('"geom".su_id_seq'::regclass));
      RETURN NEW;
  END IF;
END;
\$BODY\$;
EOL);
        $this->addSql(<<<EOL
CREATE TRIGGER __nextval_id
    BEFORE INSERT
    ON geom.su
    FOR EACH ROW
    EXECUTE FUNCTION geom.tf__nextval_id__su()
EOL);
    }

    private function dropInsertRules()
    {
        $this->addSql('DROP TRIGGER IF EXISTS __nextval_id  ON geom.site');
        $this->addSql('DROP TRIGGER IF EXISTS __nextval_id  ON geom.su');
        $this->addSql('DROP FUNCTION IF EXISTS geom.tf__nextval_id__site()');
        $this->addSql('DROP FUNCTION IF EXISTS geom.tf__nextval_id__su()');
    }
}
