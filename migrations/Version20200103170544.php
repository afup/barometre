<?php

namespace Application\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20200103170544 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
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

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
    }
}
