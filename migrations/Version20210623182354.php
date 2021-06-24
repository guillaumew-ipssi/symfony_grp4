<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623182354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adopt (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, zipcode INT NOT NULL, INDEX IDX_EDE8897AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adopt ADD CONSTRAINT FK_EDE8897AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F13B3DB11');
        $this->addSql('DROP INDEX IDX_6AAB231F13B3DB11 ON animal');
        $this->addSql('ALTER TABLE animal CHANGE master_id adopt_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F7BB76113 FOREIGN KEY (adopt_id) REFERENCES adopt (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231F7BB76113 ON animal (adopt_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F7BB76113');
        $this->addSql('DROP TABLE adopt');
        $this->addSql('DROP INDEX IDX_6AAB231F7BB76113 ON animal');
        $this->addSql('ALTER TABLE animal CHANGE adopt_id master_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F13B3DB11 FOREIGN KEY (master_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231F13B3DB11 ON animal (master_id)');
    }
}
