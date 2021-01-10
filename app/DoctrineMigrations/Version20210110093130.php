<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20210110093130 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE response ADD cmsUsageInProject INT DEFAULT NULL, ADD covid19CompanyTrust INT DEFAULT NULL, ADD covid19CompanyHandle INT DEFAULT NULL, ADD covid19Layoff INT DEFAULT NULL, ADD covid19FuturePlan INT DEFAULT NULL, ADD covid19SalaryImpact INT DEFAULT NULL, ADD covid19PartialUnemployment INT DEFAULT NULL, ADD covid19RegularRemoteFeeling INT DEFAULT NULL, ADD covid19RemoteIdealPace INT DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE response DROP cmsUsageInProject, DROP covid19CompanyTrust, DROP covid19CompanyHandle, DROP covid19Layoff, DROP covid19FuturePlan, DROP covid19SalaryImpact, DROP covid19PartialUnemployment, DROP covid19RegularRemoteFeeling, DROP covid19RemoteIdealPace');
    }
}
