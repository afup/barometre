<?php

declare(strict_types=1);

namespace App\Tests\Campaign;

use App\Campaign\ResponseFactory;
use App\Entity\Campaign;
use App\Entity\Response;
use App\Enums\CmsUsageInProjectEnums;
use App\Enums\CompanySizeEnums;
use App\Enums\CompanyTypeEnums;
use App\Enums\ContractWorkDurationEnums;
use App\Enums\Covid19\CompanyHandleEnums;
use App\Enums\Covid19\CompanyTrustEnums;
use App\Enums\Covid19\FuturePlanEnums;
use App\Enums\Covid19\LayoffEnums;
use App\Enums\Covid19\PartialUnemploymentEnums;
use App\Enums\Covid19\RegularRemoteFeelingEnums;
use App\Enums\Covid19\SalaryImpactEnums;
use App\Enums\EnumsCollection;
use App\Enums\ExperienceEnums;
use App\Enums\FrenchPHPDocumentationQualityEnums;
use App\Enums\GenderEnums;
use App\Enums\InitialTrainingEnums;
use App\Enums\JobTitleEnums;
use App\Enums\LeaveJobEnums;
use App\Enums\MeetupParticipationEnums;
use App\Enums\OsDeveloppmentEnums;
use App\Enums\OtherLanguageEnums;
use App\Enums\PHPDocumentationUsageEnums;
use App\Enums\PHPStrengthEnums;
use App\Enums\PHPVersionEnums;
use App\Enums\RemoteMoneyEnums;
use App\Enums\RemoteUsageEnums;
use App\Enums\RetrainingEnums;
use App\Enums\SalaryInflationEnums;
use App\Enums\StatusEnums;
use App\Enums\TechnologicalWatchEnums;
use App\Enums\WorkMethodEnums;
use App\Repository\CertificationRepository;
use App\Repository\ContainerEnvironmentUsageRepository;
use App\Repository\HostingTypeRepository;
use App\Repository\JobInterestRepository;
use App\Repository\SpecialityRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PropertyAccess\PropertyAccess;

class ResponseFactoryTest extends TestCase
{
    public function testCreateResponse(): void
    {
        $numberFormatter = new \NumberFormatter('fr', \NumberFormatter::DECIMAL);
        $enumCollection = new EnumsCollection([
            new StatusEnums(),
            new InitialTrainingEnums(),
            new RetrainingEnums(),
            new CompanyTypeEnums(),
            new CompanySizeEnums(),
            new PHPVersionEnums(),
            new PHPStrengthEnums(),
            new JobTitleEnums(),
            new ExperienceEnums(),
            new ContractWorkDurationEnums(),
            new LeaveJobEnums(),
            new GenderEnums(),
            new TechnologicalWatchEnums(),
            new OsDeveloppmentEnums(),
            new OtherLanguageEnums(),
            new RemoteUsageEnums(),
            new RemoteMoneyEnums(),
            new MeetupParticipationEnums(),
            new WorkMethodEnums(),
            new PHPDocumentationUsageEnums(),
            new FrenchPHPDocumentationQualityEnums(),
            new CmsUsageInProjectEnums(),
            new SalaryInflationEnums(),
            new CompanyTrustEnums(),
            new CompanyHandleEnums(),
            new LayoffEnums(),
            new FuturePlanEnums(),
            new SalaryImpactEnums(),
            new PartialUnemploymentEnums(),
            new RegularRemoteFeelingEnums(),
        ]);

        $certificationRepository = $this->createMock(CertificationRepository::class);
        $specialityRepository = $this->createMock(SpecialityRepository::class);
        $hostingTypeRepository = $this->createMock(HostingTypeRepository::class);
        $containerEnvironmentUsageRepository = $this->createMock(ContainerEnvironmentUsageRepository::class);
        $jobInterestRepository = $this->createMock(JobInterestRepository::class);
        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        $responseFactory = new ResponseFactory(
            $numberFormatter,
            $enumCollection,
            $certificationRepository,
            $specialityRepository,
            $hostingTypeRepository,
            $containerEnvironmentUsageRepository,
            $jobInterestRepository,
            $propertyAccessor
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
        $response = $responseFactory->createResponse($data, $campaign);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(42000, $response->getGrossAnnualSalary());
        $this->assertSame(StatusEnums::CDI, $response->getStatus());
        $this->assertSame(InitialTrainingEnums::MASTER, $response->getInitialTraining());
        $this->assertSame(CompanyTypeEnums::AGENCE_COMM, $response->getCompanyType());
        $this->assertSame(CompanySizeEnums::DE_50_A_199, $response->getCompanySize());
        $this->assertSame(PHPVersionEnums::PHP_53, $response->getPhpVersion());
        $this->assertSame(PHPStrengthEnums::ECOSYSTEME, $response->getPhpStrength());
    }
}
