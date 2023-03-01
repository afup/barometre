<?php

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20191223141442 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE hosting_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE response_hostingtype (response_id INT NOT NULL, hostingtype_id INT NOT NULL, INDEX IDX_4AC9A7EDFBF32840 (response_id), INDEX IDX_4AC9A7ED61CE1A05 (hostingtype_id), PRIMARY KEY(response_id, hostingtype_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE response_containerenvironmentusage (response_id INT NOT NULL, containerenvironmentusage_id INT NOT NULL, INDEX IDX_6608F85EFBF32840 (response_id), INDEX IDX_6608F85E443CCD38 (containerenvironmentusage_id), PRIMARY KEY(response_id, containerenvironmentusage_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE container_environment_usage (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE response_hostingtype ADD CONSTRAINT FK_4AC9A7EDFBF32840 FOREIGN KEY (response_id) REFERENCES response (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE response_hostingtype ADD CONSTRAINT FK_4AC9A7ED61CE1A05 FOREIGN KEY (hostingtype_id) REFERENCES hosting_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE response_containerenvironmentusage ADD CONSTRAINT FK_6608F85EFBF32840 FOREIGN KEY (response_id) REFERENCES response (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE response_containerenvironmentusage ADD CONSTRAINT FK_6608F85E443CCD38 FOREIGN KEY (containerenvironmentusage_id) REFERENCES container_environment_usage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE response ADD freelanceTjm INT DEFAULT NULL, ADD freelanceAverageWorkDayPerYear INT DEFAULT NULL, ADD contractWorkDuration INT DEFAULT NULL, ADD workMethod INT DEFAULT NULL, ADD phpDocumentationSource INT DEFAULT NULL, ADD frenchPhpDocumentationQuality INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE response_hostingtype DROP FOREIGN KEY FK_4AC9A7ED61CE1A05');
        $this->addSql('ALTER TABLE response_containerenvironmentusage DROP FOREIGN KEY FK_6608F85E443CCD38');
        $this->addSql('DROP TABLE hosting_type');
        $this->addSql('DROP TABLE response_hostingtype');
        $this->addSql('DROP TABLE response_containerenvironmentusage');
        $this->addSql('DROP TABLE container_environment_usage');
        $this->addSql('ALTER TABLE response DROP freelanceTjm, DROP freelanceAverageWorkDayPerYear, DROP contractWorkDuration, DROP workMethod, DROP phpDocumentationSource, DROP frenchPhpDocumentationQuality');
    }
}
