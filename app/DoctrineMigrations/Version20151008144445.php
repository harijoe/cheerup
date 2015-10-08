<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151008144445 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cheerup_user DROP FOREIGN KEY FK_A2A731DAD0BBCCBE');
        $this->addSql('CREATE TABLE cheerup_security_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cheerup_user_user_security_group (user_id INT NOT NULL, security_group_id INT NOT NULL, INDEX IDX_CF6B4AA1A76ED395 (user_id), INDEX IDX_CF6B4AA19D3F5E95 (security_group_id), PRIMARY KEY(user_id, security_group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cheerup_user_user_security_group ADD CONSTRAINT FK_CF6B4AA1A76ED395 FOREIGN KEY (user_id) REFERENCES cheerup_user (id)');
        $this->addSql('ALTER TABLE cheerup_user_user_security_group ADD CONSTRAINT FK_CF6B4AA19D3F5E95 FOREIGN KEY (security_group_id) REFERENCES cheerup_security_group (id)');
        $this->addSql('DROP TABLE cheerup_aggregate');
        $this->addSql('DROP TABLE cheerup_user_user_group');
        $this->addSql('ALTER TABLE cheerup_group ADD picture_id INT DEFAULT NULL, ADD description LONGTEXT NOT NULL, ADD offshoot TINYINT(1) NOT NULL, DROP roles');
        $this->addSql('ALTER TABLE cheerup_group ADD CONSTRAINT FK_4E9B2DCEE45BDBF FOREIGN KEY (picture_id) REFERENCES cheerup_picture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4E9B2DC5E237E06 ON cheerup_group (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4E9B2DCEE45BDBF ON cheerup_group (picture_id)');
        $this->addSql('DROP INDEX IDX_A2A731DAD0BBCCBE ON cheerup_user');
        $this->addSql('ALTER TABLE cheerup_user CHANGE aggregate_id group_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cheerup_user ADD CONSTRAINT FK_A2A731DAFE54D947 FOREIGN KEY (group_id) REFERENCES cheerup_group (id)');
        $this->addSql('CREATE INDEX IDX_A2A731DAFE54D947 ON cheerup_user (group_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cheerup_user_user_security_group DROP FOREIGN KEY FK_CF6B4AA19D3F5E95');
        $this->addSql('CREATE TABLE cheerup_aggregate (id INT AUTO_INCREMENT NOT NULL, picture_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, aggregate_type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_5B09189F5E237E06 (name), UNIQUE INDEX UNIQ_5B09189FEE45BDBF (picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cheerup_user_user_group (user_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_EE251908A76ED395 (user_id), INDEX IDX_EE251908FE54D947 (group_id), PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cheerup_aggregate ADD CONSTRAINT FK_5B09189FEE45BDBF FOREIGN KEY (picture_id) REFERENCES cheerup_picture (id)');
        $this->addSql('ALTER TABLE cheerup_user_user_group ADD CONSTRAINT FK_EE251908FE54D947 FOREIGN KEY (group_id) REFERENCES cheerup_group (id)');
        $this->addSql('ALTER TABLE cheerup_user_user_group ADD CONSTRAINT FK_EE251908A76ED395 FOREIGN KEY (user_id) REFERENCES cheerup_user (id)');
        $this->addSql('DROP TABLE cheerup_security_group');
        $this->addSql('DROP TABLE cheerup_user_user_security_group');
        $this->addSql('ALTER TABLE cheerup_group DROP FOREIGN KEY FK_4E9B2DCEE45BDBF');
        $this->addSql('DROP INDEX UNIQ_4E9B2DC5E237E06 ON cheerup_group');
        $this->addSql('DROP INDEX UNIQ_4E9B2DCEE45BDBF ON cheerup_group');
        $this->addSql('ALTER TABLE cheerup_group ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', DROP picture_id, DROP description, DROP offshoot');
        $this->addSql('ALTER TABLE cheerup_user DROP FOREIGN KEY FK_A2A731DAFE54D947');
        $this->addSql('DROP INDEX IDX_A2A731DAFE54D947 ON cheerup_user');
        $this->addSql('ALTER TABLE cheerup_user CHANGE group_id aggregate_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cheerup_user ADD CONSTRAINT FK_A2A731DAD0BBCCBE FOREIGN KEY (aggregate_id) REFERENCES cheerup_aggregate (id)');
        $this->addSql('CREATE INDEX IDX_A2A731DAD0BBCCBE ON cheerup_user (aggregate_id)');
    }
}
