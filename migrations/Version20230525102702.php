<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230525102702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE countrie (id_countries INT AUTO_INCREMENT NOT NULL, label_name_fr VARCHAR(255) DEFAULT NULL, label_name_en VARCHAR(255) DEFAULT NULL, iso_alpha2 VARCHAR(3) DEFAULT NULL, iso_alpha3 VARCHAR(3) DEFAULT NULL, iso_numeric INT DEFAULT NULL, flag VARCHAR(50) DEFAULT NULL, indicative VARCHAR(15) NOT NULL, active TINYINT(1) NOT NULL, zone_geo VARCHAR(255) DEFAULT NULL, cities_list_fr VARCHAR(255) DEFAULT NULL, cities_list_en VARCHAR(255) DEFAULT NULL, currencies VARCHAR(500) DEFAULT NULL, PRIMARY KEY(id_countries)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `member` (id_countries INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, guid VARCHAR(255) DEFAULT NULL, title VARCHAR(50) DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, emailAddress VARCHAR(255) DEFAULT NULL, town VARCHAR(50) DEFAULT NULL, postalCode VARCHAR(50) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, phone INT DEFAULT NULL, date_of_birth DATE DEFAULT NULL, create_at DATETIME DEFAULT NULL, update_at DATETIME DEFAULT NULL, INDEX IDX_70E4FA78F92F3E70 (country_id), PRIMARY KEY(id_countries)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `member` ADD CONSTRAINT FK_70E4FA78F92F3E70 FOREIGN KEY (country_id) REFERENCES countrie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `member` DROP FOREIGN KEY FK_70E4FA78F92F3E70');
        $this->addSql('DROP TABLE countrie');
        $this->addSql('DROP TABLE `member`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
