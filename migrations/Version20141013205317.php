<?php

namespace Application\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20141013205317 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE response ADD gender INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
    }
}
