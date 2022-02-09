<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220126194307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE purchaseitem (id INT AUTO_INCREMENT NOT NULL, purchase_id INT NOT NULL, product_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, quantity INT NOT NULL, total_price INT NOT NULL, INDEX IDX_8B4CD0E1558FBEB9 (purchase_id), INDEX IDX_8B4CD0E14584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE purchaseitem ADD CONSTRAINT FK_8B4CD0E1558FBEB9 FOREIGN KEY (purchase_id) REFERENCES purchase (id)');
        $this->addSql('ALTER TABLE purchaseitem ADD CONSTRAINT FK_8B4CD0E14584665A FOREIGN KEY (product_id) REFERENCES product (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE purchaseitem');
    }
}
