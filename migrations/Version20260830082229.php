<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260830082229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add new columns and ai_usage_purpose table for 2026 answers';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE ai_usage_purpose (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE response_aiusagepurpose (response_id INT NOT NULL, aiusagepurpose_id INT NOT NULL, INDEX IDX_8CAA88E7FBF32840 (response_id), INDEX IDX_8CAA88E74827D971 (aiusagepurpose_id), PRIMARY KEY(response_id, aiusagepurpose_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE response_aiusagepurpose ADD CONSTRAINT FK_8CAA88E7FBF32840 FOREIGN KEY (response_id) REFERENCES response (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE response_aiusagepurpose ADD CONSTRAINT FK_8CAA88E74827D971 FOREIGN KEY (aiusagepurpose_id) REFERENCES ai_usage_purpose (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE response ADD aiUsageFrequency INT DEFAULT NULL, ADD aiPerception INT DEFAULT NULL, ADD aiJobImpact INT DEFAULT NULL, ADD aiJobMarketImpact INT DEFAULT NULL');

        $sqlAiUsagePurpose = 'INSERT INTO ai_usage_purpose (name) VALUE (:name)';

        $aiUsagePurposes = [
            'Debug / compréhension de code',
            'Refactoring',
            'Génération de boilerplate',
            'Écriture de tests',
            'Documentation',
            'Rédaction de specs',
            'Revue de code',
            'Automatisation / CI',
        ];

        foreach ($aiUsagePurposes as $aiUsagePurpose) {
            $this->addSql($sqlAiUsagePurpose, ['name' => $aiUsagePurpose]);
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE response_aiusagepurpose DROP FOREIGN KEY FK_8CAA88E7FBF32840');
        $this->addSql('ALTER TABLE response_aiusagepurpose DROP FOREIGN KEY FK_8CAA88E74827D971');
        $this->addSql('DROP TABLE ai_usage_purpose');
        $this->addSql('DROP TABLE response_aiusagepurpose');
        $this->addSql('ALTER TABLE response DROP aiUsageFrequency, DROP aiPerception, DROP aiJobImpact, DROP aiJobMarketImpact');
    }
}
