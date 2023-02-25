<?php

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20200103170544 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $sqlHostingType = 'INSERT INTO hosting_type (name) VALUE (:name)';

        $hostingTypes = [
            'Mutualisé',
            'Dédié',
            'PAAS',
            'IAAS',
            'Cloud',
        ];

        foreach ($hostingTypes as $hostingType) {
            $this->addSql($sqlHostingType, ['name' => $hostingType]);
        }

        $containerEnvs = [
            'En développement',
            'En recette',
            'En production',
        ];

        $sqlContainerEnv = 'INSERT INTO container_environment_usage (name) VALUE (:name)';
        foreach ($containerEnvs as $containerEnv) {
            $this->addSql($sqlContainerEnv, ['name' => $containerEnv]);
        }
    }

    public function down(Schema $schema): void
    {
    }
}
