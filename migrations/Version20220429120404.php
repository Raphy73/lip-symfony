<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220429120404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE domain ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE domain ADD CONSTRAINT FK_A7A91E0BA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_A7A91E0BA76ED395 ON domain (user_id)');
        $this->addSql('ALTER TABLE user ADD siret VARCHAR(255) DEFAULT NULL, ADD uai VARCHAR(255) DEFAULT NULL, ADD is_preferences_empty TINYINT(1) NOT NULL, ADD password VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE domain DROP FOREIGN KEY FK_A7A91E0BA76ED395');
        $this->addSql('DROP INDEX IDX_A7A91E0BA76ED395 ON domain');
        $this->addSql('ALTER TABLE domain DROP user_id');
        $this->addSql('ALTER TABLE `user` DROP siret, DROP uai, DROP is_preferences_empty, DROP password');
    }
}
