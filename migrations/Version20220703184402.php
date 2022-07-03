<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220703184402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE suggestion (id INT AUTO_INCREMENT NOT NULL, domain_id INT DEFAULT NULL, user_id INT NOT NULL, number_of_students INT DEFAULT NULL, number_of_groups INT DEFAULT NULL, number_of_hours INT DEFAULT NULL, date_start DATE DEFAULT NULL, date_end DATE DEFAULT NULL, INDEX IDX_DD80F31B115F0EE5 (domain_id), UNIQUE INDEX UNIQ_DD80F31BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE suggestion ADD CONSTRAINT FK_DD80F31B115F0EE5 FOREIGN KEY (domain_id) REFERENCES domain (id)');
        $this->addSql('ALTER TABLE suggestion ADD CONSTRAINT FK_DD80F31BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE suggestion');
    }
}
