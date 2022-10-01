<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221001062845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(140) NOT NULL, slug VARCHAR(255) NOT NULL, order_row INT DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, order_row INT DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(140) NOT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_3F207042C2AC5D3 (translatable_id), UNIQUE INDEX category_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, language_id INT DEFAULT NULL, country_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) DEFAULT NULL, phone_main VARCHAR(255) DEFAULT NULL, phone_sales VARCHAR(255) DEFAULT NULL, phone_support VARCHAR(255) DEFAULT NULL, email_main VARCHAR(255) DEFAULT NULL, email_sales VARCHAR(255) DEFAULT NULL, email_support VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(140) DEFAULT NULL, tax_ident VARCHAR(50) DEFAULT NULL, tax_number VARCHAR(60) DEFAULT NULL, tax_porcent NUMERIC(5, 2) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, favicon VARCHAR(255) DEFAULT NULL, bg_color_main VARCHAR(60) DEFAULT NULL, bg_color_secondary VARCHAR(60) DEFAULT NULL, province VARCHAR(140) DEFAULT NULL, city VARCHAR(140) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, primary_color VARCHAR(50) DEFAULT NULL, secondary_color VARCHAR(50) DEFAULT NULL, tertiary_color VARCHAR(50) DEFAULT NULL, legal_name VARCHAR(140) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_4FBF094F82F1BAF4 (language_id), INDEX IDX_4FBF094FF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, slogan VARCHAR(255) NOT NULL, wp_commerce_text VARCHAR(255) DEFAULT NULL, wp_commerce_body LONGTEXT DEFAULT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_ADB8FDF72C2AC5D3 (translatable_id), UNIQUE INDEX company_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, language_id INT DEFAULT NULL, name VARCHAR(140) DEFAULT NULL, code VARCHAR(10) DEFAULT NULL, flag VARCHAR(140) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_5373C96682F1BAF4 (language_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gallery (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(140) NOT NULL, is_active TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gallery_images (id INT AUTO_INCREMENT NOT NULL, language_id INT DEFAULT NULL, gallery_id INT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, body LONGTEXT DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, order_row INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_429C52C882F1BAF4 (language_id), INDEX IDX_429C52C84E7AF8F (gallery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(140) DEFAULT NULL, code VARCHAR(10) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, order_row INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, page_id INT DEFAULT NULL, category_id INT DEFAULT NULL, brand_id INT DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, order_row INT DEFAULT NULL, is_parent TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_7D053A93C4663E4 (page_id), INDEX IDX_7D053A9312469DE2 (category_id), INDEX IDX_7D053A9344F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_menu (menu_source INT NOT NULL, menu_target INT NOT NULL, INDEX IDX_B54ACADD8CCD27AB (menu_source), INDEX IDX_B54ACADD95287724 (menu_target), PRIMARY KEY(menu_source, menu_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_DC955B232C2AC5D3 (translatable_id), UNIQUE INDEX menu_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE office (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, company_id INT DEFAULT NULL, province VARCHAR(140) DEFAULT NULL, city VARCHAR(140) DEFAULT NULL, address VARCHAR(255) NOT NULL, postal_code VARCHAR(100) DEFAULT NULL, is_main TINYINT(1) DEFAULT NULL, phone_main VARCHAR(140) DEFAULT NULL, phone_sales VARCHAR(140) DEFAULT NULL, phone_support VARCHAR(140) DEFAULT NULL, email_main VARCHAR(140) DEFAULT NULL, email_sales VARCHAR(140) DEFAULT NULL, email_support VARCHAR(140) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, order_row INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_74516B02F92F3E70 (country_id), INDEX IDX_74516B02979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE office_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(140) NOT NULL, hours VARCHAR(255) DEFAULT NULL, days VARCHAR(255) DEFAULT NULL, body LONGTEXT DEFAULT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_8E8307DD2C2AC5D3 (translatable_id), UNIQUE INDEX office_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, gallery_id INT DEFAULT NULL, bg_image VARCHAR(255) DEFAULT NULL, order_row INT DEFAULT NULL, is_core TINYINT(1) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, is_catalog TINYINT(1) DEFAULT NULL, is_homepage TINYINT(1) DEFAULT NULL, use_contact_form TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_140AB6204E7AF8F (gallery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_widget (page_id INT NOT NULL, widget_id INT NOT NULL, INDEX IDX_EA2FE8CEC4663E4 (page_id), INDEX IDX_EA2FE8CEFBE885E2 (widget_id), PRIMARY KEY(page_id, widget_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(140) NOT NULL, slug VARCHAR(140) NOT NULL, body LONGTEXT DEFAULT NULL, body_image VARCHAR(255) DEFAULT NULL, body_video VARCHAR(255) DEFAULT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_A3D51B1D2C2AC5D3 (translatable_id), UNIQUE INDEX page_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE presentation (id INT AUTO_INCREMENT NOT NULL, order_row INT DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE presentation_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(140) NOT NULL, slug VARCHAR(140) NOT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_F85A4D4B2C2AC5D3 (translatable_id), UNIQUE INDEX presentation_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, brand_id INT DEFAULT NULL, presentation_id INT DEFAULT NULL, gallery_id INT DEFAULT NULL, code VARCHAR(140) NOT NULL, weight_grammage NUMERIC(6, 2) DEFAULT NULL, quantity_per_box INT DEFAULT NULL, storage_life_months INT DEFAULT NULL, is_new TINYINT(1) DEFAULT NULL, is_best_seller TINYINT(1) DEFAULT NULL, is_recommended TINYINT(1) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, order_row INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_D34A04AD12469DE2 (category_id), INDEX IDX_D34A04AD44F5D008 (brand_id), INDEX IDX_D34A04ADAB627E8B (presentation_id), INDEX IDX_D34A04AD4E7AF8F (gallery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_widget (product_id INT NOT NULL, widget_id INT NOT NULL, INDEX IDX_E7855F744584665A (product_id), INDEX IDX_E7855F74FBE885E2 (widget_id), PRIMARY KEY(product_id, widget_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_product (product_source INT NOT NULL, product_target INT NOT NULL, INDEX IDX_2931F1D3DF63ED7 (product_source), INDEX IDX_2931F1D24136E58 (product_target), PRIMARY KEY(product_source, product_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, body LONGTEXT DEFAULT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_1846DB702C2AC5D3 (translatable_id), UNIQUE INDEX product_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, role_user TINYINT(1) DEFAULT NULL, role_admin TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, profile_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, name VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, totp_secret VARCHAR(255) DEFAULT NULL, is_verified TINYINT(1) NOT NULL, avatar VARCHAR(50) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649CCFA12B8 (profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE widget (id INT AUTO_INCREMENT NOT NULL, gallery_id INT DEFAULT NULL, bg_color VARCHAR(140) DEFAULT NULL, template VARCHAR(140) DEFAULT NULL, order_row INT DEFAULT NULL, is_core TINYINT(1) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, bg_image VARCHAR(255) DEFAULT NULL, text_color VARCHAR(140) DEFAULT NULL, use_related_products_component TINYINT(1) DEFAULT NULL, use_new_products_component TINYINT(1) DEFAULT NULL, use_best_seller_component TINYINT(1) DEFAULT NULL, use_recommended_products_component TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_85F91ED04E7AF8F (gallery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE widget_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(140) NOT NULL, body LONGTEXT DEFAULT NULL, body_video VARCHAR(255) DEFAULT NULL, body_image VARCHAR(255) DEFAULT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_8A73CFE32C2AC5D3 (translatable_id), UNIQUE INDEX widget_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_translation ADD CONSTRAINT FK_3F207042C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE company_translation ADD CONSTRAINT FK_ADB8FDF72C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C96682F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE gallery_images ADD CONSTRAINT FK_429C52C882F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE gallery_images ADD CONSTRAINT FK_429C52C84E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93C4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A9312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A9344F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE menu_menu ADD CONSTRAINT FK_B54ACADD8CCD27AB FOREIGN KEY (menu_source) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_menu ADD CONSTRAINT FK_B54ACADD95287724 FOREIGN KEY (menu_target) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_translation ADD CONSTRAINT FK_DC955B232C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE office ADD CONSTRAINT FK_74516B02F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE office ADD CONSTRAINT FK_74516B02979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE office_translation ADD CONSTRAINT FK_8E8307DD2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES office (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB6204E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id)');
        $this->addSql('ALTER TABLE page_widget ADD CONSTRAINT FK_EA2FE8CEC4663E4 FOREIGN KEY (page_id) REFERENCES page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page_widget ADD CONSTRAINT FK_EA2FE8CEFBE885E2 FOREIGN KEY (widget_id) REFERENCES widget (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page_translation ADD CONSTRAINT FK_A3D51B1D2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE presentation_translation ADD CONSTRAINT FK_F85A4D4B2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES presentation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADAB627E8B FOREIGN KEY (presentation_id) REFERENCES presentation (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD4E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id)');
        $this->addSql('ALTER TABLE product_widget ADD CONSTRAINT FK_E7855F744584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_widget ADD CONSTRAINT FK_E7855F74FBE885E2 FOREIGN KEY (widget_id) REFERENCES widget (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_product ADD CONSTRAINT FK_2931F1D3DF63ED7 FOREIGN KEY (product_source) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_product ADD CONSTRAINT FK_2931F1D24136E58 FOREIGN KEY (product_target) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_translation ADD CONSTRAINT FK_1846DB702C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE widget ADD CONSTRAINT FK_85F91ED04E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id)');
        $this->addSql('ALTER TABLE widget_translation ADD CONSTRAINT FK_8A73CFE32C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES widget (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_translation DROP FOREIGN KEY FK_3F207042C2AC5D3');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F82F1BAF4');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FF92F3E70');
        $this->addSql('ALTER TABLE company_translation DROP FOREIGN KEY FK_ADB8FDF72C2AC5D3');
        $this->addSql('ALTER TABLE country DROP FOREIGN KEY FK_5373C96682F1BAF4');
        $this->addSql('ALTER TABLE gallery_images DROP FOREIGN KEY FK_429C52C882F1BAF4');
        $this->addSql('ALTER TABLE gallery_images DROP FOREIGN KEY FK_429C52C84E7AF8F');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93C4663E4');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A9312469DE2');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A9344F5D008');
        $this->addSql('ALTER TABLE menu_menu DROP FOREIGN KEY FK_B54ACADD8CCD27AB');
        $this->addSql('ALTER TABLE menu_menu DROP FOREIGN KEY FK_B54ACADD95287724');
        $this->addSql('ALTER TABLE menu_translation DROP FOREIGN KEY FK_DC955B232C2AC5D3');
        $this->addSql('ALTER TABLE office DROP FOREIGN KEY FK_74516B02F92F3E70');
        $this->addSql('ALTER TABLE office DROP FOREIGN KEY FK_74516B02979B1AD6');
        $this->addSql('ALTER TABLE office_translation DROP FOREIGN KEY FK_8E8307DD2C2AC5D3');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB6204E7AF8F');
        $this->addSql('ALTER TABLE page_widget DROP FOREIGN KEY FK_EA2FE8CEC4663E4');
        $this->addSql('ALTER TABLE page_widget DROP FOREIGN KEY FK_EA2FE8CEFBE885E2');
        $this->addSql('ALTER TABLE page_translation DROP FOREIGN KEY FK_A3D51B1D2C2AC5D3');
        $this->addSql('ALTER TABLE presentation_translation DROP FOREIGN KEY FK_F85A4D4B2C2AC5D3');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD44F5D008');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADAB627E8B');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD4E7AF8F');
        $this->addSql('ALTER TABLE product_widget DROP FOREIGN KEY FK_E7855F744584665A');
        $this->addSql('ALTER TABLE product_widget DROP FOREIGN KEY FK_E7855F74FBE885E2');
        $this->addSql('ALTER TABLE product_product DROP FOREIGN KEY FK_2931F1D3DF63ED7');
        $this->addSql('ALTER TABLE product_product DROP FOREIGN KEY FK_2931F1D24136E58');
        $this->addSql('ALTER TABLE product_translation DROP FOREIGN KEY FK_1846DB702C2AC5D3');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649CCFA12B8');
        $this->addSql('ALTER TABLE widget DROP FOREIGN KEY FK_85F91ED04E7AF8F');
        $this->addSql('ALTER TABLE widget_translation DROP FOREIGN KEY FK_8A73CFE32C2AC5D3');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_translation');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE company_translation');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE gallery');
        $this->addSql('DROP TABLE gallery_images');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_menu');
        $this->addSql('DROP TABLE menu_translation');
        $this->addSql('DROP TABLE office');
        $this->addSql('DROP TABLE office_translation');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE page_widget');
        $this->addSql('DROP TABLE page_translation');
        $this->addSql('DROP TABLE presentation');
        $this->addSql('DROP TABLE presentation_translation');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_widget');
        $this->addSql('DROP TABLE product_product');
        $this->addSql('DROP TABLE product_translation');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE widget');
        $this->addSql('DROP TABLE widget_translation');
    }
}
