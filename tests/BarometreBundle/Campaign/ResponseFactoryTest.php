<?php

declare(strict_types=1);

namespace Afup\Tests\BarometreBundle\Campaign;

use Afup\BarometreBundle\Campaign\ResponseFactory;
use Afup\BarometreBundle\Entity\Campaign;
use Afup\BarometreBundle\Enums;
use Afup\BarometreBundle\Enums\EnumsCollection;
use Afup\BarometreBundle\Repository\CertificationRepository;
use Afup\BarometreBundle\Repository\ContainerEnvironmentUsageRepository;
use Afup\BarometreBundle\Repository\HostingTypeRepository;
use Afup\BarometreBundle\Repository\SpecialityRepository;
use PHPUnit\Framework\TestCase;

class ResponseFactoryTest extends TestCase
{
    public function testCreateResponse()
    {
        $enumCollection = new EnumsCollection();
        $enumCollection->addEnums(new Enums\StatusEnums());
        $enumCollection->addEnums(new Enums\InitialTrainingEnums());
        $enumCollection->addEnums(new Enums\CompanyTypeEnums());
        $enumCollection->addEnums(new Enums\CompanySizeEnums());
        $enumCollection->addEnums(new Enums\JobInterestEnums());
        $enumCollection->addEnums(new Enums\PHPVersionEnums());
        $enumCollection->addEnums(new Enums\PHPStrengthEnums());
        $enumCollection->addEnums(new Enums\JobTitleEnums());
        $enumCollection->addEnums(new Enums\ExperienceEnums());
        $enumCollection->addEnums(new Enums\GenderEnums());
        $enumCollection->addEnums(new Enums\TechnologicalWatchEnums());
        $enumCollection->addEnums(new Enums\OsDeveloppmentEnums());
        $enumCollection->addEnums(new Enums\OtherLanguageEnums());
        $enumCollection->addEnums(new Enums\RemoteUsageEnums());
        $enumCollection->addEnums(new Enums\MeetupParticipationEnums());

        $certificationRepository = $this->prophesize(CertificationRepository::class);
        $specialityRepository = $this->prophesize(SpecialityRepository::class);
        $hostingTypeRepository = $this->prophesize(HostingTypeRepository::class);
        $containerEnvironmentUsageRepository = $this->prophesize(ContainerEnvironmentUsageRepository::class);

        $responseFactory = new ResponseFactory(
            new \NumberFormatter('fr', 1),
            $enumCollection,
            $certificationRepository->reveal(),
            $specialityRepository->reveal(),
            $hostingTypeRepository->reveal(),
            $containerEnvironmentUsageRepository->reveal()
        );

        $data = [
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
            'container_environment_usage' => '',
        ];

        $response = $responseFactory->createResponse($data, new Campaign());

        self::assertEquals(42000.0, $response->getGrossAnnualSalary());
        self::assertEquals(Enums\StatusEnums::CDI, $response->getStatus());
        self::assertEquals(Enums\InitialTrainingEnums::MASTER, $response->getInitialTraining());
        self::assertEquals(Enums\CompanyTypeEnums::AGENCE_COMM, $response->getCompanyType());
        self::assertEquals(Enums\CompanySizeEnums::DE_50_A_199, $response->getCompanySize());
        self::assertEquals(Enums\JobInterestEnums::QUALITE_DE_VIE, $response->getJobInterest());
        self::assertEquals(Enums\PHPVersionEnums::PHP_53, $response->getPhpVersion());
        self::assertEquals(Enums\PHPStrengthEnums::ECOSYSTEME, $response->getPhpStrength());
    }
}
