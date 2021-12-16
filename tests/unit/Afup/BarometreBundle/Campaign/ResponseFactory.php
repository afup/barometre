<?php

namespace Afup\BarometreBundle\Campaign\Tests\Units;

use Afup\BarometreBundle\Entity\Campaign;
use atoum;
use Afup\BarometreBundle\Campaign\ResponseFactory as TestedClass;
use Afup\BarometreBundle\Enums\CompanySizeEnums;
use Afup\BarometreBundle\Enums\CompanyTypeEnums;
use Afup\BarometreBundle\Enums\ExperienceEnums;
use Afup\BarometreBundle\Enums\MeetupParticipationEnums;
use Afup\BarometreBundle\Enums\GenderEnums;
use Afup\BarometreBundle\Enums\InitialTrainingEnums;
use Afup\BarometreBundle\Enums\JobInterestEnums;
use Afup\BarometreBundle\Enums\JobTitleEnums;
use Afup\BarometreBundle\Enums\OsDeveloppmentEnums;
use Afup\BarometreBundle\Enums\OtherLanguageEnums;
use Afup\BarometreBundle\Enums\PHPStrengthEnums;
use Afup\BarometreBundle\Enums\PHPVersionEnums;
use Afup\BarometreBundle\Enums\RemoteUsageEnums;
use Afup\BarometreBundle\Enums\StatusEnums;
use Afup\BarometreBundle\Enums\TechnologicalWatchEnums;
use Doctrine\Common\Persistence\ObjectRepository;

class ResponseFactory extends atoum
{
    public function testCreateResponse()
    {
        $numberFormatter = new \NumberFormatter('fr', 1);
        $enumCollection = new \Afup\BarometreBundle\Enums\EnumsCollection();

        $enumCollection->addEnums(new StatusEnums(), 'status');
        $enumCollection->addEnums(new InitialTrainingEnums(), 'initial_training');
        $enumCollection->addEnums(new CompanyTypeEnums(), 'company_type');
        $enumCollection->addEnums(new CompanySizeEnums(), 'company_size');
        $enumCollection->addEnums(new JobInterestEnums(), 'job_interest');
        $enumCollection->addEnums(new PHPVersionEnums(), 'php_version');
        $enumCollection->addEnums(new PHPStrengthEnums(), 'php_strength');
        $enumCollection->addEnums(new JobTitleEnums(), 'job_title');
        $enumCollection->addEnums(new ExperienceEnums(), 'experience');
        $enumCollection->addEnums(new GenderEnums(), 'gender');
        $enumCollection->addEnums(new TechnologicalWatchEnums(), 'technological_watch');
        $enumCollection->addEnums(new OsDeveloppmentEnums(), 'os_developpment');
        $enumCollection->addEnums(new OtherLanguageEnums(), 'other_language');
        $enumCollection->addEnums(new RemoteUsageEnums(), 'remote_usage');
        $enumCollection->addEnums(new MeetupParticipationEnums(), 'meetup_participation');

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

        $data = array (
            'gross_annual_salary' => '42 000',
            'variable_annual_salary' => '',
            'annual_salary' => '42 000',
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
            'container_environment_usage' => ''
        );

        $campaign = new Campaign();

        $this
            ->object($response = $testedClass->createResponse($data, $campaign))
              ->isInstanceof("Afup\BarometreBundle\Entity\Response")
              ->float($response->getGrossAnnualSalary())
                  ->isEqualTo((float)42000)
              ->integer($response->getStatus())
                  ->isEqualTo(StatusEnums::CDI)
              ->integer($response->getInitialTraining())
                  ->isEqualTo(InitialTrainingEnums::MASTER)
              ->integer($response->getCompanyType())
                  ->isEqualTo(CompanyTypeEnums::AGENCE_COMM)
              ->integer($response->getCompanySize())
                  ->isEqualTo(CompanySizeEnums::DE_50_A_199)
              ->integer($response->getJobInterest())
                  ->isEqualTo(JobInterestEnums::QUALITE_DE_VIE)
              ->integer($response->getPhpVersion())
                  ->isEqualTo(PHPVersionEnums::PHP_53)
              ->integer($response->getPhpStrength())
                  ->isEqualTo(PHPStrengthEnums::ECOSYSTEME)
        ;
    }
}
