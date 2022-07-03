<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220703183457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE department DROP FOREIGN KEY FK_CD1DE18AA41BB822');
        $this->addSql('ALTER TABLE domain DROP FOREIGN KEY FK_A7A91E0BA41BB822');
        $this->addSql('ALTER TABLE type_of_project DROP FOREIGN KEY FK_CFC5F77AA41BB822');
        $this->addSql('DROP TABLE suggestion');
        $this->addSql('DROP INDEX IDX_CD1DE18AA41BB822 ON department');
        $this->addSql('ALTER TABLE department DROP suggestion_id');
        $this->addSql('DROP INDEX IDX_A7A91E0BA41BB822 ON domain');
        $this->addSql('ALTER TABLE domain DROP suggestion_id');
        $this->addSql('DROP INDEX IDX_CFC5F77AA41BB822 ON type_of_project');
        $this->addSql('ALTER TABLE type_of_project DROP suggestion_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE suggestion (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, number_of_students INT DEFAULT NULL, number_of_groups INT DEFAULT NULL, number_of_hours INT DEFAULT NULL, date_start DATE DEFAULT NULL, date_end DATE DEFAULT NULL, UNIQUE INDEX UNIQ_DD80F31BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE suggestion ADD CONSTRAINT FK_DD80F31BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE department ADD suggestion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE department ADD CONSTRAINT FK_CD1DE18AA41BB822 FOREIGN KEY (suggestion_id) REFERENCES suggestion (id)');
        $this->addSql('CREATE INDEX IDX_CD1DE18AA41BB822 ON department (suggestion_id)');
        $this->addSql('ALTER TABLE domain ADD suggestion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE domain ADD CONSTRAINT FK_A7A91E0BA41BB822 FOREIGN KEY (suggestion_id) REFERENCES suggestion (id)');
        $this->addSql('CREATE INDEX IDX_A7A91E0BA41BB822 ON domain (suggestion_id)');
        $this->addSql('ALTER TABLE type_of_project ADD suggestion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_of_project ADD CONSTRAINT FK_CFC5F77AA41BB822 FOREIGN KEY (suggestion_id) REFERENCES suggestion (id)');
        $this->addSql('CREATE INDEX IDX_CFC5F77AA41BB822 ON type_of_project (suggestion_id)');
    }
}
