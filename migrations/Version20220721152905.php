<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220721152905 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE decorations__potteries DROP CONSTRAINT FK_5E405C87F23816BB');
        $this->addSql('ALTER TABLE decorations__potteries ADD CONSTRAINT FK_5E405C87F23816BB FOREIGN KEY (pottery_id) REFERENCES pottery (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE decorations__small_finds DROP CONSTRAINT FK_B99701241EBC97E5');
        $this->addSql('ALTER TABLE decorations__small_finds ADD CONSTRAINT FK_B99701241EBC97E5 FOREIGN KEY (small_find_id) REFERENCES small_find (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__ecofacts DROP CONSTRAINT FK_294F5CED30602B60');
        $this->addSql('ALTER TABLE media_objects__ecofacts DROP CONSTRAINT FK_294F5CED64DE5A5');
        $this->addSql('ALTER TABLE media_objects__ecofacts ADD CONSTRAINT FK_294F5CED30602B60 FOREIGN KEY (ecofact_id) REFERENCES ecofact (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__ecofacts ADD CONSTRAINT FK_294F5CED64DE5A5 FOREIGN KEY (media_object_id) REFERENCES media_object (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__graves DROP CONSTRAINT FK_6C54F84BE439654A');
        $this->addSql('ALTER TABLE media_objects__graves DROP CONSTRAINT FK_6C54F84B64DE5A5');
        $this->addSql('ALTER TABLE media_objects__graves ADD CONSTRAINT FK_6C54F84BE439654A FOREIGN KEY (grave_id) REFERENCES grave (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__graves ADD CONSTRAINT FK_6C54F84B64DE5A5 FOREIGN KEY (media_object_id) REFERENCES media_object (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__potteries DROP CONSTRAINT FK_4AE07489F23816BB');
        $this->addSql('ALTER TABLE media_objects__potteries DROP CONSTRAINT FK_4AE0748964DE5A5');
        $this->addSql('ALTER TABLE media_objects__potteries ADD CONSTRAINT FK_4AE07489F23816BB FOREIGN KEY (pottery_id) REFERENCES pottery (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__potteries ADD CONSTRAINT FK_4AE0748964DE5A5 FOREIGN KEY (media_object_id) REFERENCES media_object (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__samples DROP CONSTRAINT FK_1F6DF7861B1FEA20');
        $this->addSql('ALTER TABLE media_objects__samples DROP CONSTRAINT FK_1F6DF78664DE5A5');
        $this->addSql('ALTER TABLE media_objects__samples ADD CONSTRAINT FK_1F6DF7861B1FEA20 FOREIGN KEY (sample_id) REFERENCES sample (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__samples ADD CONSTRAINT FK_1F6DF78664DE5A5 FOREIGN KEY (media_object_id) REFERENCES media_object (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__small_finds DROP CONSTRAINT FK_12A190F01EBC97E5');
        $this->addSql('ALTER TABLE media_objects__small_finds DROP CONSTRAINT FK_12A190F064DE5A5');
        $this->addSql('ALTER TABLE media_objects__small_finds ADD CONSTRAINT FK_12A190F01EBC97E5 FOREIGN KEY (small_find_id) REFERENCES small_find (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__small_finds ADD CONSTRAINT FK_12A190F064DE5A5 FOREIGN KEY (media_object_id) REFERENCES media_object (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__sus DROP CONSTRAINT FK_BF40F0ECBDB1218E');
        $this->addSql('ALTER TABLE media_objects__sus DROP CONSTRAINT FK_BF40F0EC64DE5A5');
        $this->addSql('ALTER TABLE media_objects__sus ADD CONSTRAINT FK_BF40F0ECBDB1218E FOREIGN KEY (su_id) REFERENCES su (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__sus ADD CONSTRAINT FK_BF40F0EC64DE5A5 FOREIGN KEY (media_object_id) REFERENCES media_object (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE media_objects__ecofacts DROP CONSTRAINT fk_294f5ced30602b60');
        $this->addSql('ALTER TABLE media_objects__ecofacts DROP CONSTRAINT fk_294f5ced64de5a5');
        $this->addSql('ALTER TABLE media_objects__ecofacts ADD CONSTRAINT fk_294f5ced30602b60 FOREIGN KEY (ecofact_id) REFERENCES ecofact (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__ecofacts ADD CONSTRAINT fk_294f5ced64de5a5 FOREIGN KEY (media_object_id) REFERENCES media_object (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__graves DROP CONSTRAINT fk_6c54f84be439654a');
        $this->addSql('ALTER TABLE media_objects__graves DROP CONSTRAINT fk_6c54f84b64de5a5');
        $this->addSql('ALTER TABLE media_objects__graves ADD CONSTRAINT fk_6c54f84be439654a FOREIGN KEY (grave_id) REFERENCES grave (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__graves ADD CONSTRAINT fk_6c54f84b64de5a5 FOREIGN KEY (media_object_id) REFERENCES media_object (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__potteries DROP CONSTRAINT fk_4ae07489f23816bb');
        $this->addSql('ALTER TABLE media_objects__potteries DROP CONSTRAINT fk_4ae0748964de5a5');
        $this->addSql('ALTER TABLE media_objects__potteries ADD CONSTRAINT fk_4ae07489f23816bb FOREIGN KEY (pottery_id) REFERENCES pottery (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__potteries ADD CONSTRAINT fk_4ae0748964de5a5 FOREIGN KEY (media_object_id) REFERENCES media_object (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__samples DROP CONSTRAINT fk_1f6df7861b1fea20');
        $this->addSql('ALTER TABLE media_objects__samples DROP CONSTRAINT fk_1f6df78664de5a5');
        $this->addSql('ALTER TABLE media_objects__samples ADD CONSTRAINT fk_1f6df7861b1fea20 FOREIGN KEY (sample_id) REFERENCES sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__samples ADD CONSTRAINT fk_1f6df78664de5a5 FOREIGN KEY (media_object_id) REFERENCES media_object (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__small_finds DROP CONSTRAINT fk_12a190f01ebc97e5');
        $this->addSql('ALTER TABLE media_objects__small_finds DROP CONSTRAINT fk_12a190f064de5a5');
        $this->addSql('ALTER TABLE media_objects__small_finds ADD CONSTRAINT fk_12a190f01ebc97e5 FOREIGN KEY (small_find_id) REFERENCES small_find (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__small_finds ADD CONSTRAINT fk_12a190f064de5a5 FOREIGN KEY (media_object_id) REFERENCES media_object (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__sus DROP CONSTRAINT fk_bf40f0ecbdb1218e');
        $this->addSql('ALTER TABLE media_objects__sus DROP CONSTRAINT fk_bf40f0ec64de5a5');
        $this->addSql('ALTER TABLE media_objects__sus ADD CONSTRAINT fk_bf40f0ecbdb1218e FOREIGN KEY (su_id) REFERENCES su (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_objects__sus ADD CONSTRAINT fk_bf40f0ec64de5a5 FOREIGN KEY (media_object_id) REFERENCES media_object (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE decorations__potteries DROP CONSTRAINT fk_5e405c87f23816bb');
        $this->addSql('ALTER TABLE decorations__potteries ADD CONSTRAINT fk_5e405c87f23816bb FOREIGN KEY (pottery_id) REFERENCES pottery (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE decorations__small_finds DROP CONSTRAINT fk_b99701241ebc97e5');
        $this->addSql('ALTER TABLE decorations__small_finds ADD CONSTRAINT fk_b99701241ebc97e5 FOREIGN KEY (small_find_id) REFERENCES small_find (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
