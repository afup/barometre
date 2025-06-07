<?php

namespace App\Tests\unit\Campaign;

use App\Entity\Campaign;
use App\Entity\Response;
use App\Enums\CompanySizeEnums;
use App\Enums\CompanyTypeEnums;
use App\Enums\ExperienceEnums;
use App\Enums\GenderEnums;
use App\Enums\InitialTrainingEnums;
use App\Enums\JobTitleEnums;
use App\Enums\MeetupParticipationEnums;
use App\Enums\OsDeveloppmentEnums;
use App\Enums\OtherLanguageEnums;
use App\Enums\PHPStrengthEnums;
use App\Enums\PHPVersionEnums;
use App\Enums\RemoteUsageEnums;
use App\Enums\StatusEnums;
use App\Enums\TechnologicalWatchEnums;
use Doctrine\Persistence\ObjectRepository;

class ResponseFactory extends \atoum
{
    public function testCreateResponse()
    {
        $numberFormatter = new \NumberFormatter('fr', 1);
        $enumCollection = new \App\Enums\EnumsCollection([
            new StatusEnums(),
            new InitialTrainingEnums(),
            new CompanyTypeEnums(),
            new CompanySizeEnums(),
            new PHPVersionEnums(),
            new PHPStrengthEnums(),
            new JobTitleEnums(),
            new ExperienceEnums(),
            new GenderEnums(),
            new TechnologicalWatchEnums(),
            new OsDeveloppmentEnums(),
            new OtherLanguageEnums(),
            new RemoteUsageEnums(),
            new MeetupParticipationEnums(),
        ]);

        $certificationRepository = $this->newMockInstance(ObjectRepository::class);
        $specialityRepository = $this->newMockInstance(ObjectRepository::class);
        $hostingTypeRepository = $this->newMockInstance(ObjectRepository::class);
        $containerEnvironmentUsageRepository = $this->newMockInstance(ObjectRepository::class);

        $testedClass = $this->newTestedInstance(
            $numberFormatter,
            $enumCollection,
            $certificationRepository,
            $specialityRepository,
            $hostingTypeRepository,
            $containerEnvironmentUsageRepository
        );

        $data = [
            'gross_annual_salary' => "42\u{a0}000",
            'variable_annual_salary' => '',
            'annual_salary' => "42\u{a0}000",
            'salary_satisfaction' => '4',
            'status' => 'Contrat à durée indéterminée',
            'initial_training' => 'Niveau Master2 ou ingénieur',
            'company_type' => 'Agence de communication',
            'company_size' => 'De 50 à 199 salariés',
            'company_department' => '59',
            'job_interest' => 'La qualité de vie autour de votre emploi',
            'speciality' => 'Zend Framework',
            'php_version' => 'PHP 5.3',
            'has_certification' => 'Non',
            'certification_list' => '',
            'php_strength' => 'Son écosystème (outils, frameworks, documentation)',
            'email' => 'raoul@gmail.com',
            'has_formation' => '',
            'formation_subject' => '',
            'formation_impact' => '',
            'job_title' => '',
            'experience' => '',
            'gender' => '',
            'technological_watch' => '',
            'os_developpment' => '',
            'other_language' => '',
            'meetup_participation' => '',
            'remote_usage' => '',
            'hosting_type' => '',
            'container_environment_usage' => '',
        ];

        $campaign = new Campaign();

        $this
            ->object($response = $testedClass->createResponse($data, $campaign))
              ->isInstanceof(Response::class)
              ->float($response->getGrossAnnualSalary())
                  ->isEqualTo((float) 42000)
              ->integer($response->getStatus())
                  ->isEqualTo(StatusEnums::CDI)
              ->integer($response->getInitialTraining())
                  ->isEqualTo(InitialTrainingEnums::MASTER)
              ->integer($response->getCompanyType())
                  ->isEqualTo(CompanyTypeEnums::AGENCE_COMM)
              ->integer($response->getCompanySize())
                  ->isEqualTo(CompanySizeEnums::DE_50_A_199)
              ->integer($response->getPhpVersion())
                  ->isEqualTo(PHPVersionEnums::PHP_53)
              ->integer($response->getPhpStrength())
                  ->isEqualTo(PHPStrengthEnums::ECOSYSTEME)
        ;
    }
}
