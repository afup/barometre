<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230225143621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'new column for campaign 2022';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<SQL
            ALTER TABLE response
                ADD salaryInflation INT DEFAULT NULL,
                ADD experienceInYear INT DEFAULT NULL,
                ADD experienceInCurrentJob INT DEFAULT NULL,
                ADD remoteMoney INT DEFAULT NULL,
                ADD numberMeetupParticipation INT DEFAULT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<SQL
            ALTER TABLE response
                DROP salaryInflation,
                DROP experienceInYear,
                DROP experienceInCurrentJob,
                DROP remoteMoney,
                DROP numberMeetupParticipation
        SQL);
    }
}
