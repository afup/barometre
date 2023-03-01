<?php

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20161009134550 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE response CHANGE isRecentTrainingHadSalaryImpact isRecentTrainingHadSalaryImpact TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
    }
}
