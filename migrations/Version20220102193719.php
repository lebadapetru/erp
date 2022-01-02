<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220102193719 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql('
            INSERT INTO
                "lookup_product_statuses" (id, name, label, deleted_at, updated_at, created_at)
            VALUES
                (NEXTVAL(\'lookup_product_statuses_id_seq\'), \'Draft\', \'draft\', null, NOW(), NOW()),
                (NEXTVAL(\'lookup_product_statuses_id_seq\'), \'Order\', \'order\', null, NOW(), NOW()),
                (NEXTVAL(\'lookup_product_statuses_id_seq\'), \'Active\', \'active\', null, NOW(), NOW())
            ');

        $this->addSql('
            INSERT INTO
                "variant_options" (id, name, deleted_at, updated_at, created_at)
            VALUES
                (NEXTVAL(\'variant_options_id_seq\'), \'Size\', null, NOW(), NOW()),
                (NEXTVAL(\'variant_options_id_seq\'), \'Color\', null, NOW(), NOW()),
                (NEXTVAL(\'variant_options_id_seq\'), \'Material\', null, NOW(), NOW())
            ');

        $this->addSql('
            INSERT INTO
                "vendors" (id, name, deleted_at, updated_at, created_at)
            VALUES
                (NEXTVAL(\'vendors_id_seq\'), \'Client name\' , null, NOW(), NOW())
            ');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('TRUNCATE "lookup_product_statuses" CASCADE');
        $this->addSql('ALTER SEQUENCE "lookup_product_statuses_id_seq" RESTART WITH 1');

        $this->addSql('TRUNCATE "variant_options" CASCADE');
        $this->addSql('ALTER SEQUENCE "variant_options_id_seq" RESTART WITH 1');

        $this->addSql('TRUNCATE "vendors" CASCADE');
        $this->addSql('ALTER SEQUENCE "vendors_id_seq" RESTART WITH 1');
    }
}
