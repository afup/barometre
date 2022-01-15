<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20220109171811 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE job_interest (id INT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE response_jobinterest (response_id INT NOT NULL, jobinterest_id INT NOT NULL, INDEX IDX_2240560EFBF32840 (response_id), INDEX IDX_2240560E53A99FEC (jobinterest_id), PRIMARY KEY(response_id, jobinterest_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE response_jobinterest ADD CONSTRAINT FK_2240560EFBF32840 FOREIGN KEY (response_id) REFERENCES response (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE response_jobinterest ADD CONSTRAINT FK_2240560E53A99FEC FOREIGN KEY (jobinterest_id) REFERENCES job_interest (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE response ADD remotePace INT DEFAULT NULL, ADD covid19WorkCondition INT DEFAULT NULL, ADD retraining INT DEFAULT NULL');

        $this->addSql(<<<SQL
INSERT INTO job_interest (id, name)
VALUES 
       (0, 'Autre'),
       (1, 'La qualité de vie autour de votre emploi'),
       (2, 'L\'intérêt technique de vos projets'),
       (3, 'L\'ambiance dans l\'entreprise'),
       (4, 'La rémunération'),
       (5, 'Le domaine métier de vos projets')
SQL
        );

        $this->addSql('INSERT INTO response_jobinterest (response_id, jobinterest_id) SELECT id, jobInterest FROM response');


        $this->addSql('ALTER TABLE response DROP jobInterest');
    }

    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE response_jobinterest DROP FOREIGN KEY FK_2240560E53A99FEC');
        $this->addSql('DROP TABLE job_interest');
        $this->addSql('DROP TABLE response_jobinterest');
        $this->addSql('ALTER TABLE response ADD jobInterest INT DEFAULT NULL, DROP retraining, DROP remotePace, DROP covid19WorkCondition');
    }
}
