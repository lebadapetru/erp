<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200824160423 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE features ADD service_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE features ADD CONSTRAINT FK_BFC0DC13ED5CA9E6 FOREIGN KEY (service_id) REFERENCES "services" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BFC0DC13ED5CA9E6 ON features (service_id)');
        $this->addSql('ALTER TABLE services DROP CONSTRAINT fk_7332e169cec89005');
        $this->addSql('DROP INDEX idx_7332e169cec89005');
        $this->addSql('ALTER TABLE services DROP features_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "features" DROP CONSTRAINT FK_BFC0DC13ED5CA9E6');
        $this->addSql('DROP INDEX IDX_BFC0DC13ED5CA9E6');
        $this->addSql('ALTER TABLE "features" DROP service_id');
        $this->addSql('ALTER TABLE "services" ADD features_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "services" ADD CONSTRAINT fk_7332e169cec89005 FOREIGN KEY (features_id) REFERENCES features (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_7332e169cec89005 ON "services" (features_id)');
    }
}
