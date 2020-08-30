<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200829175553 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE role_group');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE role_group (role_id INT NOT NULL, group_id INT NOT NULL, PRIMARY KEY(role_id, group_id))');
        $this->addSql('CREATE INDEX idx_9a1caceafe54d947 ON role_group (group_id)');
        $this->addSql('CREATE INDEX idx_9a1cacead60322ac ON role_group (role_id)');
        $this->addSql('ALTER TABLE role_group ADD CONSTRAINT fk_9a1cacead60322ac FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE role_group ADD CONSTRAINT fk_9a1caceafe54d947 FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
