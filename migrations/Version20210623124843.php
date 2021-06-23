<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623124843 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal ADD master_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F13B3DB11 FOREIGN KEY (master_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231F13B3DB11 ON animal (master_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F13B3DB11');
        $this->addSql('DROP INDEX IDX_6AAB231F13B3DB11 ON animal');
        $this->addSql('ALTER TABLE animal DROP master_id');
    }
}
