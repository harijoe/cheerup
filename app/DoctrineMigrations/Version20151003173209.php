<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151003173209 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cheerup_user_profile DROP FOREIGN KEY FK_622862E0292E8AE2');
        $this->addSql('CREATE TABLE aggregate (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cheerup_picture (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE cheerup_profile_picture');
        $this->addSql('DROP INDEX UNIQ_622862E0292E8AE2 ON cheerup_user_profile');
        $this->addSql('ALTER TABLE cheerup_user_profile CHANGE profile_picture_id picture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cheerup_user_profile ADD CONSTRAINT FK_622862E0EE45BDBF FOREIGN KEY (picture_id) REFERENCES cheerup_picture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_622862E0EE45BDBF ON cheerup_user_profile (picture_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cheerup_user_profile DROP FOREIGN KEY FK_622862E0EE45BDBF');
        $this->addSql('CREATE TABLE cheerup_profile_picture (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE aggregate');
        $this->addSql('DROP TABLE cheerup_picture');
        $this->addSql('DROP INDEX UNIQ_622862E0EE45BDBF ON cheerup_user_profile');
        $this->addSql('ALTER TABLE cheerup_user_profile CHANGE picture_id profile_picture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cheerup_user_profile ADD CONSTRAINT FK_622862E0292E8AE2 FOREIGN KEY (profile_picture_id) REFERENCES cheerup_profile_picture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_622862E0292E8AE2 ON cheerup_user_profile (profile_picture_id)');
    }
}
