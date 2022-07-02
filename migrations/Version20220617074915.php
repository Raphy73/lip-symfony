<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220617074915 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, suggestion_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, number INT NOT NULL, INDEX IDX_CD1DE18AA41BB822 (suggestion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domain (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, suggestion_id INT DEFAULT NULL, type_of_project_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_A7A91E0BA76ED395 (user_id), INDEX IDX_A7A91E0BA41BB822 (suggestion_id), INDEX IDX_A7A91E0B8FD4693C (type_of_project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suggestion (id INT AUTO_INCREMENT NOT NULL, number_of_students INT DEFAULT NULL, number_of_groups INT DEFAULT NULL, number_of_hours INT DEFAULT NULL, date_start DATE DEFAULT NULL, date_end INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_of_project (id INT AUTO_INCREMENT NOT NULL, suggestion_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_CFC5F77AA41BB822 (suggestion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, company VARCHAR(255) DEFAULT NULL, school VARCHAR(255) DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, uai VARCHAR(255) DEFAULT NULL, are_preferences_empty TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE department ADD CONSTRAINT FK_CD1DE18AA41BB822 FOREIGN KEY (suggestion_id) REFERENCES suggestion (id)');
        $this->addSql('ALTER TABLE domain ADD CONSTRAINT FK_A7A91E0BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE domain ADD CONSTRAINT FK_A7A91E0BA41BB822 FOREIGN KEY (suggestion_id) REFERENCES suggestion (id)');
        $this->addSql('ALTER TABLE domain ADD CONSTRAINT FK_A7A91E0B8FD4693C FOREIGN KEY (type_of_project_id) REFERENCES type_of_project (id)');
        $this->addSql('ALTER TABLE type_of_project ADD CONSTRAINT FK_CFC5F77AA41BB822 FOREIGN KEY (suggestion_id) REFERENCES suggestion (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE department DROP FOREIGN KEY FK_CD1DE18AA41BB822');
        $this->addSql('ALTER TABLE domain DROP FOREIGN KEY FK_A7A91E0BA41BB822');
        $this->addSql('ALTER TABLE type_of_project DROP FOREIGN KEY FK_CFC5F77AA41BB822');
        $this->addSql('ALTER TABLE domain DROP FOREIGN KEY FK_A7A91E0B8FD4693C');
        $this->addSql('ALTER TABLE domain DROP FOREIGN KEY FK_A7A91E0BA76ED395');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE domain');
        $this->addSql('DROP TABLE suggestion');
        $this->addSql('DROP TABLE type_of_project');
        $this->addSql('DROP TABLE user');
    }
}
