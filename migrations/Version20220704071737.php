<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220704071737 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE announcement DROP FOREIGN KEY FK_4DB9D91C115F0EE5');
        $this->addSql('DROP INDEX IDX_4DB9D91C115F0EE5 ON announcement');
        $this->addSql('ALTER TABLE announcement ADD domain VARCHAR(255) DEFAULT NULL, DROP domain_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE announcement ADD domain_id INT DEFAULT NULL, DROP domain');
        $this->addSql('ALTER TABLE announcement ADD CONSTRAINT FK_4DB9D91C115F0EE5 FOREIGN KEY (domain_id) REFERENCES domain (id)');
        $this->addSql('CREATE INDEX IDX_4DB9D91C115F0EE5 ON announcement (domain_id)');
    }
}
