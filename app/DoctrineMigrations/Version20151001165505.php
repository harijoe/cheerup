<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151001165505 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cheerup_user_profile (id INT AUTO_INCREMENT NOT NULL, firstYearContact INT DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, additionalAddressDetails VARCHAR(255) DEFAULT NULL, zipCode VARCHAR(20) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, facebookProfileUrl VARCHAR(255) DEFAULT NULL, twitterProfileUrl VARCHAR(255) DEFAULT NULL, linkedInProfile VARCHAR(255) DEFAULT NULL, personalWebsite VARCHAR(255) DEFAULT NULL, phoneNumber INT DEFAULT NULL, cellphoneNumber INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cheerup_user ADD user_profile_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cheerup_user ADD CONSTRAINT FK_A2A731DA6B9DD454 FOREIGN KEY (user_profile_id) REFERENCES cheerup_user_profile (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A2A731DA6B9DD454 ON cheerup_user (user_profile_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cheerup_user DROP FOREIGN KEY FK_A2A731DA6B9DD454');
        $this->addSql('DROP TABLE cheerup_user_profile');
        $this->addSql('DROP INDEX UNIQ_A2A731DA6B9DD454 ON cheerup_user');
        $this->addSql('ALTER TABLE cheerup_user DROP user_profile_id');
    }
}
