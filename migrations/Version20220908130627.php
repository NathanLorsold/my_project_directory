<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220908130627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, suppliers_id INT DEFAULT NULL, product_name VARCHAR(255) NOT NULL, quantity_per_unit VARCHAR(255) NOT NULL, unit_price VARCHAR(255) NOT NULL, units_on_stock VARCHAR(255) NOT NULL, units_on_order VARCHAR(255) NOT NULL, reorder_level VARCHAR(255) NOT NULL, discontinued VARCHAR(255) NOT NULL, INDEX IDX_B3BA5A5A355AF43 (suppliers_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suppliers (id INT AUTO_INCREMENT NOT NULL, company_name VARCHAR(255) NOT NULL, contact_name VARCHAR(255) NOT NULL, contact_title VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, fax VARCHAR(255) NOT NULL, home_page VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A355AF43 FOREIGN KEY (suppliers_id) REFERENCES suppliers (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A355AF43');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE suppliers');
    }
}
