<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151002141917 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE profile_picture (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cheerup_user_profile ADD profile_picture_id INT DEFAULT NULL, ADD first_year_contact INT DEFAULT NULL, ADD additional_address_details VARCHAR(255) DEFAULT NULL, ADD facebook_profile VARCHAR(255) DEFAULT NULL, ADD twitter_profile VARCHAR(255) DEFAULT NULL, ADD linked_in_profile VARCHAR(255) DEFAULT NULL, ADD personal_website VARCHAR(255) DEFAULT NULL, ADD phone_number INT DEFAULT NULL, ADD cellphone_number INT DEFAULT NULL, DROP firstYearContact, DROP additionalAddressDetails, DROP linkedInProfile, DROP personalWebsite, DROP phoneNumber, DROP cellphoneNumber, DROP facebookProfile, DROP twitterProfile, CHANGE zipcode zip_code VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE cheerup_user_profile ADD CONSTRAINT FK_622862E0292E8AE2 FOREIGN KEY (profile_picture_id) REFERENCES profile_picture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_622862E0292E8AE2 ON cheerup_user_profile (profile_picture_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cheerup_user_profile DROP FOREIGN KEY FK_622862E0292E8AE2');
        $this->addSql('DROP TABLE profile_picture');
        $this->addSql('DROP INDEX UNIQ_622862E0292E8AE2 ON cheerup_user_profile');
        $this->addSql('ALTER TABLE cheerup_user_profile ADD firstYearContact INT DEFAULT NULL, ADD additionalAddressDetails VARCHAR(255) DEFAULT NULL, ADD linkedInProfile VARCHAR(255) DEFAULT NULL, ADD personalWebsite VARCHAR(255) DEFAULT NULL, ADD phoneNumber INT DEFAULT NULL, ADD cellphoneNumber INT DEFAULT NULL, ADD facebookProfile VARCHAR(255) DEFAULT NULL, ADD twitterProfile VARCHAR(255) DEFAULT NULL, DROP profile_picture_id, DROP first_year_contact, DROP additional_address_details, DROP facebook_profile, DROP twitter_profile, DROP linked_in_profile, DROP personal_website, DROP phone_number, DROP cellphone_number, CHANGE zip_code zipCode VARCHAR(20) DEFAULT NULL');
    }
}
