<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220703152619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE suggestion (id INT AUTO_INCREMENT NOT NULL, number_of_students INT DEFAULT NULL, number_of_groups INT DEFAULT NULL, number_of_hours INT DEFAULT NULL, date_start DATE DEFAULT NULL, date_end INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_of_project (id INT AUTO_INCREMENT NOT NULL, suggestion_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_CFC5F77AA41BB822 (suggestion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE type_of_project ADD CONSTRAINT FK_CFC5F77AA41BB822 FOREIGN KEY (suggestion_id) REFERENCES suggestion (id)');
        $this->addSql('ALTER TABLE department ADD CONSTRAINT FK_CD1DE18AA41BB822 FOREIGN KEY (suggestion_id) REFERENCES suggestion (id)');
        $this->addSql('ALTER TABLE domain ADD suggestion_id INT DEFAULT NULL, ADD type_of_project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE domain ADD CONSTRAINT FK_A7A91E0BA41BB822 FOREIGN KEY (suggestion_id) REFERENCES suggestion (id)');
        $this->addSql('ALTER TABLE domain ADD CONSTRAINT FK_A7A91E0B8FD4693C FOREIGN KEY (type_of_project_id) REFERENCES type_of_project (id)');
        $this->addSql('CREATE INDEX IDX_A7A91E0BA41BB822 ON domain (suggestion_id)');
        $this->addSql('CREATE INDEX IDX_A7A91E0B8FD4693C ON domain (type_of_project_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE department DROP FOREIGN KEY FK_CD1DE18AA41BB822');
        $this->addSql('ALTER TABLE domain DROP FOREIGN KEY FK_A7A91E0BA41BB822');
        $this->addSql('ALTER TABLE type_of_project DROP FOREIGN KEY FK_CFC5F77AA41BB822');
        $this->addSql('ALTER TABLE domain DROP FOREIGN KEY FK_A7A91E0B8FD4693C');
        $this->addSql('DROP TABLE suggestion');
        $this->addSql('DROP TABLE type_of_project');
        $this->addSql('DROP INDEX IDX_A7A91E0BA41BB822 ON domain');
        $this->addSql('DROP INDEX IDX_A7A91E0B8FD4693C ON domain');
        $this->addSql('ALTER TABLE domain DROP suggestion_id, DROP type_of_project_id');
    }
}
