<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20251002080532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add new specialities';
    }

    public function up(Schema $schema): void
    {
        $specialities = [
            'API Platform',
            'Sylius',
            'Laminas (ex Zend Framework)',
            'Ibexa (ex EzPublish)',
        ];

        foreach ($specialities as $speciality) {
            $this->addSql('INSERT INTO speciality (name) VALUES(:name)', ['name' => $speciality]);
        }
    }
}
