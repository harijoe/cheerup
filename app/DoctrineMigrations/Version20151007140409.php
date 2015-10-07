<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151007140409 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cheerup_group (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cheerup_user_user_group (user_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_EE251908A76ED395 (user_id), INDEX IDX_EE251908FE54D947 (group_id), PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cheerup_user_user_group ADD CONSTRAINT FK_EE251908A76ED395 FOREIGN KEY (user_id) REFERENCES cheerup_user (id)');
        $this->addSql('ALTER TABLE cheerup_user_user_group ADD CONSTRAINT FK_EE251908FE54D947 FOREIGN KEY (group_id) REFERENCES cheerup_group (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cheerup_user_user_group DROP FOREIGN KEY FK_EE251908FE54D947');
        $this->addSql('DROP TABLE cheerup_group');
        $this->addSql('DROP TABLE cheerup_user_user_group');
    }
}
