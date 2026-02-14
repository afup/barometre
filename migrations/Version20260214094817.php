<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260214094817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Set gender to 0 for responses where gender is null';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE response SET gender = 0 WHERE gender IS NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE response SET gender = NULL WHERE gender = 0');
    }
}
