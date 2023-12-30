<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20231230123408 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'new column for campaign 2023';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE response ADD leaveJob INT DEFAULT NULL, ADD discriminationDuringHiring INT DEFAULT NULL, ADD communityInclusion INT DEFAULT NULL, ADD age INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE response DROP leaveJob, DROP discriminationDuringHiring, DROP communityInclusion, DROP age');
    }
}
