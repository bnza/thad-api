<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220425185127 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE pottery_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__p__base_shape_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__p__body_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__p__colour_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__p__decoration_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__p__fabric_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__p__firing_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__p__handle_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__p__manufacturing_technique_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__p__neck_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__p__neck_length_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__p__preservation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__p__rim_characterization_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__p__rim_direction_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__p__rim_shape_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__p__size_group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__p__spout_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__p__surface_characteristic_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__p__surface_treatment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__p__vessel_shape_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voc__p__ware_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE pottery (id INT NOT NULL, su_id INT NOT NULL, ext_surface_color_id SMALLINT DEFAULT NULL, int_surface_color_id SMALLINT DEFAULT NULL, fracture_color_id SMALLINT DEFAULT NULL, ware_id SMALLINT DEFAULT NULL, fabric_id SMALLINT DEFAULT NULL, surface_characteristic_id SMALLINT DEFAULT NULL, surface_treatment_id SMALLINT DEFAULT NULL, manufacturing_technique_id SMALLINT DEFAULT NULL, firing_id SMALLINT DEFAULT NULL, decoration_id SMALLINT DEFAULT NULL, vessel_shape_id SMALLINT DEFAULT NULL, rim_shape_id SMALLINT DEFAULT NULL, rim_direction_id SMALLINT DEFAULT NULL, rim_characterization_id SMALLINT DEFAULT NULL, neck_id SMALLINT DEFAULT NULL, neck_length_id SMALLINT DEFAULT NULL, body_id SMALLINT DEFAULT NULL, handle_id SMALLINT DEFAULT NULL, base_shape_id SMALLINT DEFAULT NULL, preservation_id SMALLINT DEFAULT NULL, number SMALLINT NOT NULL, thickness DOUBLE PRECISION DEFAULT NULL, rim_diameter DOUBLE PRECISION DEFAULT NULL, base_diameter DOUBLE PRECISION DEFAULT NULL, date DATE NOT NULL, compiler VARCHAR(255) DEFAULT NULL, notes TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1A651839BDB1218E ON pottery (su_id)');
        $this->addSql('CREATE INDEX IDX_1A651839AD1FCB98 ON pottery (ext_surface_color_id)');
        $this->addSql('CREATE INDEX IDX_1A651839F0B7C66A ON pottery (int_surface_color_id)');
        $this->addSql('CREATE INDEX IDX_1A651839ABB639B3 ON pottery (fracture_color_id)');
        $this->addSql('CREATE INDEX IDX_1A65183961E14598 ON pottery (ware_id)');
        $this->addSql('CREATE INDEX IDX_1A651839AB43EC50 ON pottery (fabric_id)');
        $this->addSql('CREATE INDEX IDX_1A651839479088F4 ON pottery (surface_characteristic_id)');
        $this->addSql('CREATE INDEX IDX_1A651839EFB04BBB ON pottery (surface_treatment_id)');
        $this->addSql('CREATE INDEX IDX_1A6518395D832DFC ON pottery (manufacturing_technique_id)');
        $this->addSql('CREATE INDEX IDX_1A6518394B2BD234 ON pottery (firing_id)');
        $this->addSql('CREATE INDEX IDX_1A6518393446DFC4 ON pottery (decoration_id)');
        $this->addSql('CREATE INDEX IDX_1A651839DD564C42 ON pottery (vessel_shape_id)');
        $this->addSql('CREATE INDEX IDX_1A65183924CBC30C ON pottery (rim_shape_id)');
        $this->addSql('CREATE INDEX IDX_1A651839414A8D6D ON pottery (rim_direction_id)');
        $this->addSql('CREATE INDEX IDX_1A651839DEBFB82A ON pottery (rim_characterization_id)');
        $this->addSql('CREATE INDEX IDX_1A651839B5691792 ON pottery (neck_id)');
        $this->addSql('CREATE INDEX IDX_1A65183966E3E996 ON pottery (neck_length_id)');
        $this->addSql('CREATE INDEX IDX_1A6518399B621D84 ON pottery (body_id)');
        $this->addSql('CREATE INDEX IDX_1A6518399C256C9C ON pottery (handle_id)');
        $this->addSql('CREATE INDEX IDX_1A6518391ACDCF43 ON pottery (base_shape_id)');
        $this->addSql('CREATE INDEX IDX_1A651839B806376B ON pottery (preservation_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1A651839BDB1218E96901F54 ON pottery (su_id, number)');
        $this->addSql('COMMENT ON COLUMN pottery.date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE voc__p__base_shape (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_32A3748D1D775834 ON voc__p__base_shape (value)');
        $this->addSql('CREATE TABLE voc__p__body (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_39ACB6861D775834 ON voc__p__body (value)');
        $this->addSql('CREATE TABLE voc__p__colour (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F402BB0C1D775834 ON voc__p__colour (value)');
        $this->addSql('CREATE TABLE voc__p__decoration (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_55DC87201D775834 ON voc__p__decoration (value)');
        $this->addSql('CREATE TABLE voc__p__fabric (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6319AE611D775834 ON voc__p__fabric (value)');
        $this->addSql('CREATE TABLE voc__p__firing (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5B2FAC701D775834 ON voc__p__firing (value)');
        $this->addSql('CREATE TABLE voc__p__handle (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9F7AFE1B1D775834 ON voc__p__handle (value)');
        $this->addSql('CREATE TABLE voc__p__manufacturing_technique (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2F2D5EE21D775834 ON voc__p__manufacturing_technique (value)');
        $this->addSql('CREATE TABLE voc__p__neck (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C2156B671D775834 ON voc__p__neck (value)');
        $this->addSql('CREATE TABLE voc__p__neck_length (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A028CABC1D775834 ON voc__p__neck_length (value)');
        $this->addSql('CREATE TABLE voc__p__preservation (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FF701A6C1D775834 ON voc__p__preservation (value)');
        $this->addSql('CREATE TABLE voc__p__rim_characterization (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7BDAA3201D775834 ON voc__p__rim_characterization (value)');
        $this->addSql('CREATE TABLE voc__p__rim_direction (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FAD6D6011D775834 ON voc__p__rim_direction (value)');
        $this->addSql('CREATE TABLE voc__p__rim_shape (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2BAB6A1C1D775834 ON voc__p__rim_shape (value)');
        $this->addSql('CREATE TABLE voc__p__size_group (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EEA89C751D775834 ON voc__p__size_group (value)');
        $this->addSql('CREATE TABLE voc__p__spout (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7492891D1D775834 ON voc__p__spout (value)');
        $this->addSql('CREATE TABLE voc__p__surface_characteristic (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_873DCB111D775834 ON voc__p__surface_characteristic (value)');
        $this->addSql('CREATE TABLE voc__p__surface_treatment (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B449A6991D775834 ON voc__p__surface_treatment (value)');
        $this->addSql('CREATE TABLE voc__p__vessel_shape (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FE06866D1D775834 ON voc__p__vessel_shape (value)');
        $this->addSql('CREATE TABLE voc__p__ware (id SMALLINT NOT NULL, value VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5C6CD5B91D775834 ON voc__p__ware (value)');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A651839BDB1218E FOREIGN KEY (su_id) REFERENCES su (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A651839AD1FCB98 FOREIGN KEY (ext_surface_color_id) REFERENCES voc__p__colour (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A651839F0B7C66A FOREIGN KEY (int_surface_color_id) REFERENCES voc__p__colour (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A651839ABB639B3 FOREIGN KEY (fracture_color_id) REFERENCES voc__p__colour (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A65183961E14598 FOREIGN KEY (ware_id) REFERENCES voc__p__ware (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A651839AB43EC50 FOREIGN KEY (fabric_id) REFERENCES voc__p__fabric (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A651839479088F4 FOREIGN KEY (surface_characteristic_id) REFERENCES voc__p__surface_characteristic (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A651839EFB04BBB FOREIGN KEY (surface_treatment_id) REFERENCES voc__p__surface_treatment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A6518395D832DFC FOREIGN KEY (manufacturing_technique_id) REFERENCES voc__p__manufacturing_technique (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A6518394B2BD234 FOREIGN KEY (firing_id) REFERENCES voc__p__firing (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A6518393446DFC4 FOREIGN KEY (decoration_id) REFERENCES voc__p__decoration (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A651839DD564C42 FOREIGN KEY (vessel_shape_id) REFERENCES voc__p__vessel_shape (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A65183924CBC30C FOREIGN KEY (rim_shape_id) REFERENCES voc__p__rim_shape (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A651839414A8D6D FOREIGN KEY (rim_direction_id) REFERENCES voc__p__rim_direction (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A651839DEBFB82A FOREIGN KEY (rim_characterization_id) REFERENCES voc__p__rim_characterization (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A651839B5691792 FOREIGN KEY (neck_id) REFERENCES voc__p__neck (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A65183966E3E996 FOREIGN KEY (neck_length_id) REFERENCES voc__p__neck_length (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A6518399B621D84 FOREIGN KEY (body_id) REFERENCES voc__p__body (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A6518399C256C9C FOREIGN KEY (handle_id) REFERENCES voc__p__handle (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A6518391ACDCF43 FOREIGN KEY (base_shape_id) REFERENCES voc__p__base_shape (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pottery ADD CONSTRAINT FK_1A651839B806376B FOREIGN KEY (preservation_id) REFERENCES voc__p__preservation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE su ALTER site_id SET NOT NULL');
        $this->addSql('ALTER TABLE su ALTER area_id SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A6518391ACDCF43');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A6518399B621D84');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A651839AD1FCB98');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A651839F0B7C66A');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A651839ABB639B3');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A6518393446DFC4');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A651839AB43EC50');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A6518394B2BD234');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A6518399C256C9C');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A6518395D832DFC');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A651839B5691792');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A65183966E3E996');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A651839B806376B');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A651839DEBFB82A');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A651839414A8D6D');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A65183924CBC30C');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A651839479088F4');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A651839EFB04BBB');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A651839DD564C42');
        $this->addSql('ALTER TABLE pottery DROP CONSTRAINT FK_1A65183961E14598');
        $this->addSql('DROP SEQUENCE pottery_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__p__base_shape_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__p__body_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__p__colour_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__p__decoration_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__p__fabric_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__p__firing_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__p__handle_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__p__manufacturing_technique_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__p__neck_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__p__neck_length_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__p__preservation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__p__rim_characterization_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__p__rim_direction_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__p__rim_shape_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__p__size_group_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__p__spout_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__p__surface_characteristic_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__p__surface_treatment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__p__vessel_shape_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voc__p__ware_id_seq CASCADE');
        $this->addSql('DROP TABLE pottery');
        $this->addSql('DROP TABLE voc__p__base_shape');
        $this->addSql('DROP TABLE voc__p__body');
        $this->addSql('DROP TABLE voc__p__colour');
        $this->addSql('DROP TABLE voc__p__decoration');
        $this->addSql('DROP TABLE voc__p__fabric');
        $this->addSql('DROP TABLE voc__p__firing');
        $this->addSql('DROP TABLE voc__p__handle');
        $this->addSql('DROP TABLE voc__p__manufacturing_technique');
        $this->addSql('DROP TABLE voc__p__neck');
        $this->addSql('DROP TABLE voc__p__neck_length');
        $this->addSql('DROP TABLE voc__p__preservation');
        $this->addSql('DROP TABLE voc__p__rim_characterization');
        $this->addSql('DROP TABLE voc__p__rim_direction');
        $this->addSql('DROP TABLE voc__p__rim_shape');
        $this->addSql('DROP TABLE voc__p__size_group');
        $this->addSql('DROP TABLE voc__p__spout');
        $this->addSql('DROP TABLE voc__p__surface_characteristic');
        $this->addSql('DROP TABLE voc__p__surface_treatment');
        $this->addSql('DROP TABLE voc__p__vessel_shape');
        $this->addSql('DROP TABLE voc__p__ware');
        $this->addSql('ALTER TABLE su ALTER site_id DROP NOT NULL');
        $this->addSql('ALTER TABLE su ALTER area_id DROP NOT NULL');
    }
}
