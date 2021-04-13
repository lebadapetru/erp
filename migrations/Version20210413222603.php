<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210413222603 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "categories_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "email_tokens_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "features_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "files_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "groups_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "lookup_measurement_units_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "lookup_product_statuses_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "permissions_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "products_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "reset_password_tokens_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "roles_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "services_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "tags_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "users_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "variant_options_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "variant_values_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "variants_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "vendors_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "categories" (id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, is_public BOOLEAN NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "email_tokens" (id INT NOT NULL, user_id INT NOT NULL, token VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D7C0C27E5F37A13B ON "email_tokens" (token)');
        $this->addSql('CREATE INDEX IDX_D7C0C27EA76ED395 ON "email_tokens" (user_id)');
        $this->addSql('CREATE TABLE "features" (id INT NOT NULL, service_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, parent INT DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BFC0DC13EA750E8 ON "features" (label)');
        $this->addSql('CREATE INDEX IDX_BFC0DC13ED5CA9E6 ON "features" (service_id)');
        $this->addSql('CREATE TABLE "files" (id INT NOT NULL, original_name VARCHAR(255) NOT NULL, display_name VARCHAR(255) NOT NULL, extension VARCHAR(255) DEFAULT NULL, mime_type VARCHAR(255) DEFAULT NULL, size INT DEFAULT NULL, width DOUBLE PRECISION DEFAULT NULL, height DOUBLE PRECISION DEFAULT NULL, path VARCHAR(255) DEFAULT NULL, media_url VARCHAR(255) DEFAULT NULL, is_processed BOOLEAN NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_635405954561530 ON "files" (original_name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6354059D5499347 ON "files" (display_name)');
        $this->addSql('CREATE TABLE "groups" (id INT NOT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F06D3970EA750E8 ON "groups" (label)');
        $this->addSql('CREATE TABLE group_user (group_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(group_id, user_id))');
        $this->addSql('CREATE INDEX IDX_A4C98D39FE54D947 ON group_user (group_id)');
        $this->addSql('CREATE INDEX IDX_A4C98D39A76ED395 ON group_user (user_id)');
        $this->addSql('CREATE TABLE group_role (group_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(group_id, role_id))');
        $this->addSql('CREATE INDEX IDX_7E33D11AFE54D947 ON group_role (group_id)');
        $this->addSql('CREATE INDEX IDX_7E33D11AD60322AC ON group_role (role_id)');
        $this->addSql('CREATE TABLE "lookup_measurement_units" (id INT NOT NULL, name VARCHAR(255) NOT NULL, symbol VARCHAR(255) NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, parent INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "lookup_product_statuses" (id INT NOT NULL, name VARCHAR(255) NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "permissions" (id INT NOT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2DEDCC6FEA750E8 ON "permissions" (label)');
        $this->addSql('CREATE TABLE "products" (id INT NOT NULL, status_id INT NOT NULL, vendor_id INT NOT NULL, weight_unit_id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, is_public BOOLEAN NOT NULL, sku VARCHAR(255) DEFAULT NULL, stock INT NOT NULL, original_price NUMERIC(10, 2) NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, discount SMALLINT NOT NULL, weight INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A6BF700BD ON "products" (status_id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5AF603EE73 ON "products" (vendor_id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A7794469 ON "products" (weight_unit_id)');
        $this->addSql('CREATE TABLE product_file (product_id INT NOT NULL, file_id INT NOT NULL, PRIMARY KEY(product_id, file_id))');
        $this->addSql('CREATE INDEX IDX_17714B14584665A ON product_file (product_id)');
        $this->addSql('CREATE INDEX IDX_17714B193CB796C ON product_file (file_id)');
        $this->addSql('CREATE TABLE product_category (product_id INT NOT NULL, category_id INT NOT NULL, PRIMARY KEY(product_id, category_id))');
        $this->addSql('CREATE INDEX IDX_CDFC73564584665A ON product_category (product_id)');
        $this->addSql('CREATE INDEX IDX_CDFC735612469DE2 ON product_category (category_id)');
        $this->addSql('CREATE TABLE product_tag (product_id INT NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(product_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_E3A6E39C4584665A ON product_tag (product_id)');
        $this->addSql('CREATE INDEX IDX_E3A6E39CBAD26311 ON product_tag (tag_id)');
        $this->addSql('CREATE TABLE "reset_password_tokens" (id INT NOT NULL, user_id INT NOT NULL, token VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F045D5AA5F37A13B ON "reset_password_tokens" (token)');
        $this->addSql('CREATE INDEX IDX_F045D5AAA76ED395 ON "reset_password_tokens" (user_id)');
        $this->addSql('CREATE TABLE "roles" (id INT NOT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B63E2EC7EA750E8 ON "roles" (label)');
        $this->addSql('CREATE TABLE role_permission (role_id INT NOT NULL, permission_id INT NOT NULL, PRIMARY KEY(role_id, permission_id))');
        $this->addSql('CREATE INDEX IDX_6F7DF886D60322AC ON role_permission (role_id)');
        $this->addSql('CREATE INDEX IDX_6F7DF886FED90CCA ON role_permission (permission_id)');
        $this->addSql('CREATE TABLE "services" (id INT NOT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, is_active BOOLEAN NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7332E169EA750E8 ON "services" (label)');
        $this->addSql('CREATE TABLE "tags" (id INT NOT NULL, name VARCHAR(255) NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "users" (id INT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, is_active BOOLEAN NOT NULL, verified_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9F85E0677 ON "users" (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON "users" (email)');
        $this->addSql('CREATE TABLE user_role (user_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(user_id, role_id))');
        $this->addSql('CREATE INDEX IDX_2DE8C6A3A76ED395 ON user_role (user_id)');
        $this->addSql('CREATE INDEX IDX_2DE8C6A3D60322AC ON user_role (role_id)');
        $this->addSql('CREATE TABLE "variant_options" (id INT NOT NULL, name VARCHAR(255) NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "variant_values" (id INT NOT NULL, variant_option_id INT NOT NULL, name VARCHAR(255) NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2FFDEB304438C63C ON "variant_values" (variant_option_id)');
        $this->addSql('CREATE TABLE "variants" (id INT NOT NULL, product_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, original_price NUMERIC(10, 2) DEFAULT NULL, discount INT DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B39853E14584665A ON "variants" (product_id)');
        $this->addSql('CREATE TABLE variant_variant_value (variant_id INT NOT NULL, variant_value_id INT NOT NULL, PRIMARY KEY(variant_id, variant_value_id))');
        $this->addSql('CREATE INDEX IDX_4493A0873B69A9AF ON variant_variant_value (variant_id)');
        $this->addSql('CREATE INDEX IDX_4493A08766F0FA2A ON variant_variant_value (variant_value_id)');
        $this->addSql('CREATE TABLE "vendors" (id INT NOT NULL, name VARCHAR(255) NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE "email_tokens" ADD CONSTRAINT FK_D7C0C27EA76ED395 FOREIGN KEY (user_id) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "features" ADD CONSTRAINT FK_BFC0DC13ED5CA9E6 FOREIGN KEY (service_id) REFERENCES "services" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_user ADD CONSTRAINT FK_A4C98D39FE54D947 FOREIGN KEY (group_id) REFERENCES "groups" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_user ADD CONSTRAINT FK_A4C98D39A76ED395 FOREIGN KEY (user_id) REFERENCES "users" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_role ADD CONSTRAINT FK_7E33D11AFE54D947 FOREIGN KEY (group_id) REFERENCES "groups" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_role ADD CONSTRAINT FK_7E33D11AD60322AC FOREIGN KEY (role_id) REFERENCES "roles" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "products" ADD CONSTRAINT FK_B3BA5A5A6BF700BD FOREIGN KEY (status_id) REFERENCES "lookup_product_statuses" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "products" ADD CONSTRAINT FK_B3BA5A5AF603EE73 FOREIGN KEY (vendor_id) REFERENCES "vendors" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "products" ADD CONSTRAINT FK_B3BA5A5A7794469 FOREIGN KEY (weight_unit_id) REFERENCES "lookup_measurement_units" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_file ADD CONSTRAINT FK_17714B14584665A FOREIGN KEY (product_id) REFERENCES "products" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_file ADD CONSTRAINT FK_17714B193CB796C FOREIGN KEY (file_id) REFERENCES "files" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC73564584665A FOREIGN KEY (product_id) REFERENCES "products" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735612469DE2 FOREIGN KEY (category_id) REFERENCES "categories" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_tag ADD CONSTRAINT FK_E3A6E39C4584665A FOREIGN KEY (product_id) REFERENCES "products" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_tag ADD CONSTRAINT FK_E3A6E39CBAD26311 FOREIGN KEY (tag_id) REFERENCES "tags" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "reset_password_tokens" ADD CONSTRAINT FK_F045D5AAA76ED395 FOREIGN KEY (user_id) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE role_permission ADD CONSTRAINT FK_6F7DF886D60322AC FOREIGN KEY (role_id) REFERENCES "roles" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE role_permission ADD CONSTRAINT FK_6F7DF886FED90CCA FOREIGN KEY (permission_id) REFERENCES "permissions" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3A76ED395 FOREIGN KEY (user_id) REFERENCES "users" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3D60322AC FOREIGN KEY (role_id) REFERENCES "roles" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "variant_values" ADD CONSTRAINT FK_2FFDEB304438C63C FOREIGN KEY (variant_option_id) REFERENCES "variant_options" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "variants" ADD CONSTRAINT FK_B39853E14584665A FOREIGN KEY (product_id) REFERENCES "products" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE variant_variant_value ADD CONSTRAINT FK_4493A0873B69A9AF FOREIGN KEY (variant_id) REFERENCES "variants" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE variant_variant_value ADD CONSTRAINT FK_4493A08766F0FA2A FOREIGN KEY (variant_value_id) REFERENCES "variant_values" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE product_category DROP CONSTRAINT FK_CDFC735612469DE2');
        $this->addSql('ALTER TABLE product_file DROP CONSTRAINT FK_17714B193CB796C');
        $this->addSql('ALTER TABLE group_user DROP CONSTRAINT FK_A4C98D39FE54D947');
        $this->addSql('ALTER TABLE group_role DROP CONSTRAINT FK_7E33D11AFE54D947');
        $this->addSql('ALTER TABLE "products" DROP CONSTRAINT FK_B3BA5A5A7794469');
        $this->addSql('ALTER TABLE "products" DROP CONSTRAINT FK_B3BA5A5A6BF700BD');
        $this->addSql('ALTER TABLE role_permission DROP CONSTRAINT FK_6F7DF886FED90CCA');
        $this->addSql('ALTER TABLE product_file DROP CONSTRAINT FK_17714B14584665A');
        $this->addSql('ALTER TABLE product_category DROP CONSTRAINT FK_CDFC73564584665A');
        $this->addSql('ALTER TABLE product_tag DROP CONSTRAINT FK_E3A6E39C4584665A');
        $this->addSql('ALTER TABLE "variants" DROP CONSTRAINT FK_B39853E14584665A');
        $this->addSql('ALTER TABLE group_role DROP CONSTRAINT FK_7E33D11AD60322AC');
        $this->addSql('ALTER TABLE role_permission DROP CONSTRAINT FK_6F7DF886D60322AC');
        $this->addSql('ALTER TABLE user_role DROP CONSTRAINT FK_2DE8C6A3D60322AC');
        $this->addSql('ALTER TABLE "features" DROP CONSTRAINT FK_BFC0DC13ED5CA9E6');
        $this->addSql('ALTER TABLE product_tag DROP CONSTRAINT FK_E3A6E39CBAD26311');
        $this->addSql('ALTER TABLE "email_tokens" DROP CONSTRAINT FK_D7C0C27EA76ED395');
        $this->addSql('ALTER TABLE group_user DROP CONSTRAINT FK_A4C98D39A76ED395');
        $this->addSql('ALTER TABLE "reset_password_tokens" DROP CONSTRAINT FK_F045D5AAA76ED395');
        $this->addSql('ALTER TABLE user_role DROP CONSTRAINT FK_2DE8C6A3A76ED395');
        $this->addSql('ALTER TABLE "variant_values" DROP CONSTRAINT FK_2FFDEB304438C63C');
        $this->addSql('ALTER TABLE variant_variant_value DROP CONSTRAINT FK_4493A08766F0FA2A');
        $this->addSql('ALTER TABLE variant_variant_value DROP CONSTRAINT FK_4493A0873B69A9AF');
        $this->addSql('ALTER TABLE "products" DROP CONSTRAINT FK_B3BA5A5AF603EE73');
        $this->addSql('DROP SEQUENCE "categories_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "email_tokens_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "features_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "files_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "groups_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "lookup_measurement_units_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "lookup_product_statuses_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "permissions_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "products_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "reset_password_tokens_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "roles_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "services_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "tags_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "users_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "variant_options_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "variant_values_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "variants_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "vendors_id_seq" CASCADE');
        $this->addSql('DROP TABLE "categories"');
        $this->addSql('DROP TABLE "email_tokens"');
        $this->addSql('DROP TABLE "features"');
        $this->addSql('DROP TABLE "files"');
        $this->addSql('DROP TABLE "groups"');
        $this->addSql('DROP TABLE group_user');
        $this->addSql('DROP TABLE group_role');
        $this->addSql('DROP TABLE "lookup_measurement_units"');
        $this->addSql('DROP TABLE "lookup_product_statuses"');
        $this->addSql('DROP TABLE "permissions"');
        $this->addSql('DROP TABLE "products"');
        $this->addSql('DROP TABLE product_file');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE product_tag');
        $this->addSql('DROP TABLE "reset_password_tokens"');
        $this->addSql('DROP TABLE "roles"');
        $this->addSql('DROP TABLE role_permission');
        $this->addSql('DROP TABLE "services"');
        $this->addSql('DROP TABLE "tags"');
        $this->addSql('DROP TABLE "users"');
        $this->addSql('DROP TABLE user_role');
        $this->addSql('DROP TABLE "variant_options"');
        $this->addSql('DROP TABLE "variant_values"');
        $this->addSql('DROP TABLE "variants"');
        $this->addSql('DROP TABLE variant_variant_value');
        $this->addSql('DROP TABLE "vendors"');
    }
}
