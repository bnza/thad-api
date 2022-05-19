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
        $this->addSql('DROP ROLE IF EXISTS gis_base;');
        $this->addSql('CREATE ROLE gis_base NOSUPERUSER;');
        $this->addSql('GRANT USAGE ON SCHEMA geom TO gis_base;');
        $this->addSql('GRANT SELECT, REFERENCES ON TABLE public.site, public.su, geom.site, geom.su TO gis_base;');
        $this->addSql('DROP ROLE IF EXISTS gis_editor;');
        $this->addSql('CREATE ROLE gis_editor NOSUPERUSER IN ROLE gis_base;');
        $this->addSql('GRANT ALL ON TABLE geom.su TO gis_editor;');
        $this->addSql('GRANT USAGE ON SEQUENCE geom.su_id_seq TO gis_editor;');
        $this->addSql('DROP ROLE IF EXISTS gis_admin;');
        $this->addSql('CREATE ROLE gis_admin NOSUPERUSER IN ROLE gis_editor;');
        $this->addSql('GRANT ALL ON TABLE geom.site TO gis_admin;');
        $this->addSql('GRANT USAGE ON SEQUENCE geom.site_id_seq TO gis_admin;');
        $this->addSql('DROP ROLE IF EXISTS gis_admin_user;');
        $this->addSql('DROP ROLE IF EXISTS gis_editor_user;');
        $this->addSql('DROP ROLE IF EXISTS gis_base_user;');
        $this->addSql(sprintf('CREATE USER gis_admin_user NOSUPERUSER IN ROLE gis_admin ENCRYPTED PASSWORD \'%s\'', $_ENV['USER_GIS_ADMIN_PW']));
        $this->addSql(sprintf('CREATE USER gis_editor_user NOSUPERUSER IN ROLE gis_editor ENCRYPTED PASSWORD \'%s\'', $_ENV['USER_GIS_EDITOR_PW']));
        $this->addSql(sprintf('CREATE USER gis_base_user NOSUPERUSER IN ROLE gis_base ENCRYPTED PASSWORD \'%s\'', $_ENV['USER_GIS_BASE_PW']));
        $this->createInsertRules();
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP ROLE IF EXISTS gis_admin_user;');
        $this->addSql('DROP ROLE IF EXISTS gis_editor_user;');
        $this->addSql('DROP ROLE IF EXISTS gis_base_user;');
        $this->addSql('REVOKE ALL ON TABLE geom.site FROM gis_admin;');
        $this->addSql('REVOKE ALL ON SEQUENCE geom.site_id_seq FROM gis_admin;');
        $this->addSql('DROP ROLE gis_admin;');
        $this->addSql('REVOKE ALL ON TABLE geom.su FROM gis_editor;');
        $this->addSql('REVOKE ALL ON SEQUENCE geom.su_id_seq FROM gis_editor;');
        $this->addSql('DROP ROLE gis_editor;');
        $this->addSql('REVOKE ALL ON TABLE public.site, public.su, geom.site, geom.su FROM gis_base');
        $this->addSql('REVOKE ALL ON SCHEMA geom FROM gis_base');
        $this->addSql('DROP ROLE gis_base;');
        $this->dropInsertRules();
    }

    private function createInsertRules()
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
