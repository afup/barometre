<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250906084617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add new column for 2025 answers';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE response ADD useGenerativeAI TINYINT(1) DEFAULT NULL, ADD includeAiInProject TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE response DROP useGenerativeAI, DROP includeAiInProject');
    }
}
