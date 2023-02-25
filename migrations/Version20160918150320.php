<?php

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20160918150320 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE response ADD remoteUsage INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
    }
}
