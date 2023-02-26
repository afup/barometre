<?php

declare(strict_types=1);

namespace App\Campaign;

use agallou\Departements\Collection as Departments;
use App\Entity\Campaign;
use App\Entity\Certification;
use App\Entity\ContainerEnvironmentUsage;
use App\Entity\HostingType;
use App\Entity\JobInterest;
use App\Entity\Response;
use App\Entity\Speciality;
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
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

class ResponseFactory
{
    public function __construct(
        private readonly \NumberFormatter $numberFormatter,
        private readonly EnumsCollection $enums,
        private readonly CertificationRepository $certificationRepository,
        private readonly SpecialityRepository $specialityRepository,
        private readonly HostingTypeRepository $hostingTypeRepository,
        private readonly ContainerEnvironmentUsageRepository $containerEnvironmentUsageRepository,
        private readonly JobInterestRepository $jobInterestRepository,
        private readonly PropertyAccessorInterface $propertyAccessor,
    ) {
    }

    public function createResponse(array $data, Campaign $campaign): Response
    {
        $response = new Response();
        $response->setCampaign($campaign);

        $numberValues = [
            'grossAnnualSalary' => 'gross_annual_salary',
            'variableAnnualSalary' => 'variable_annual_salary',
            'annualSalary' => 'annual_salary',
            'salarySatisfaction' => 'salary_satisfaction',
            'experienceInYear' => 'experience_in_year',
            'experienceInCurrentJob' => 'experience_in_current_job',
            'freelanceTjm' => 'freelance_tjm',
            'freelanceAverageWorkDayPerYear' => 'freelance_average_work_day',
            'RemotePace' => 'remote_pace',
            'NumberMeetupParticipation' => 'number_meetup_participation',
            'Covid19RemoteIdealPace' => 'covid19_remote_ideal_pace',
            'Covid19WorkCondition' => 'covid19_work_condition',
        ];

        foreach ($numberValues as $field => $dataKey) {
            if (!isset($data[$dataKey])) {
                continue;
            }

            $this->propertyAccessor->setValue($response, $field, (int)$this->numberFormatter->parse((string) $data[$dataKey]));
        }

        $enumValues = [
            'salaryInflation' => ['key' => 'salary_inflation', 'class' => SalaryInflationEnums::class],
            'initialTraining' => ['key' => 'initial_training', 'class' => InitialTrainingEnums::class],
            'retraining' => ['key' => 'retraining', 'class' => RetrainingEnums::class],
            'status' => ['key' => 'status', 'class' => StatusEnums::class],
            'jobTitle' => ['key' => 'job_title', 'class' => JobTitleEnums::class],
            'experience' => ['key' => 'experience', 'class' => ExperienceEnums::class],
            'contractWorkDuration' => ['key' => 'contract_work_duration', 'class' => ContractWorkDurationEnums::class],
            'companyType' => ['key' => 'company_type', 'class' => CompanyTypeEnums::class],
            'companySize' => ['key' => 'company_size', 'class' => CompanySizeEnums::class],
            'OtherLanguage' => ['key' => 'other_language', 'class' => OtherLanguageEnums::class],
            'RemoteUsage' => ['key' => 'remote_usage', 'class' => RemoteUsageEnums::class],
            'RemoteMoney' => ['key' => 'remote_money', 'class' => RemoteMoneyEnums::class],
            'MeetupParticipation' => ['key' => 'meetup_participation', 'class' => MeetupParticipationEnums::class],
            'TechnologicalWatch' => ['key' => 'technological_watch', 'class' => TechnologicalWatchEnums::class],
            'OsDeveloppment' => ['key' => 'os_developpment', 'class' => OsDeveloppmentEnums::class],
            'WorkMethod' => ['key' => 'work_method', 'class' => WorkMethodEnums::class],
            'PhpVersion' => ['key' => 'php_version', 'class' => WorkMethodEnums::class],
            'phpDocumentationSource' => ['key' => 'php_documentation_source', 'class' => PHPDocumentationUsageEnums::class],
            'FrenchPhpDocumentationQuality' => ['key' => 'french_php_documentation_quality', 'class' => FrenchPHPDocumentationQualityEnums::class],
            'PhpStrength' => ['key' => 'php_strength', 'class' => PHPStrengthEnums::class],
            'Gender' => ['key' => 'gender', 'class' => GenderEnums::class],
            'CmsUsageInProject' => ['key' => 'cms_usage_in_project', 'class' => CmsUsageInProjectEnums::class],
            'Covid19CompanyTrust' => ['key' => 'covid19_company_trust', 'class' => CompanyTrustEnums::class],
            'Covid19CompanyHandle' => ['key' => 'covid19_company_handle', 'class' => CompanyHandleEnums::class],
            'Covid19Layoff' => ['key' => 'covid19_layoff', 'class' => LayoffEnums::class],
            'Covid19FuturePlan' => ['key' => 'covid19_future_plan', 'class' => FuturePlanEnums::class],
            'Covid19SalaryImpact' => ['key' => 'covid19_salary_impact', 'class' => SalaryImpactEnums::class],
            'Covid19PartialUnemployment' => ['key' => 'covid19_partial_unemployment', 'class' => PartialUnemploymentEnums::class],
            'Covid19RegularRemoteFeeling' => ['key' => 'covid19_regular_remote_feeling', 'class' => RegularRemoteFeelingEnums::class],
        ];

        foreach ($enumValues as $field => $enum) {
            $this->propertyAccessor->setValue(
                $response,
                $field,
                $this->enums->getEnums($enum['class'])->getIdByLabel($data[$enum['key']] ?? null)
            );
        }

        $department = new Departments();
        if (\array_key_exists($data['company_department'], $department->getAll())) {
            $response->setCompanyDepartment(
                $data['company_department']
            );
        }

        $this->addJobInterest($response, explode(', ', $data['job_interest'] ?? ''));

        $response->setCompanyOrigin($data['company_origin'] ?? null);

        $this->addHostingType(
            $response,
            explode(', ', $data['hosting_type'] ?? '')
        );

        $this->addContainerEnvironmentUsage(
            $response,
            explode(', ', $data['container_environment_usage'] ?? '')
        );

        $this->addSpeciality(
            $response,
            explode(', ', $data['speciality'] ?? '')
        );

        if ('oui' === mb_strtolower($data['has_certification'])) {
            $this->addCertification(
                $response,
                explode(', ', $data['certification_list'] ?? null)
            );
        }

        $response->setHasRecentTraining(
            'oui' === mb_strtolower($data['has_formation'] ?? null)
        );

        $response->setIsRecentTrainingHadSalaryImpact(
            'oui' === mb_strtolower($data['formation_impact'] ?? null)
        );

        return $response;
    }

    protected function addCertification(Response $response, array $certificationList)
    {
        foreach ($certificationList as $certification) {
            $certification = $this->certificationRepository->findOneBy(
                [
                    'name' => trim($certification),
                ]
            );

            if (!$certification instanceof Certification) {
                continue;
            }

            $response->addCertification($certification);
        }
    }

    protected function addSpeciality(Response $response, array $specialityList)
    {
        foreach ($specialityList as $speciality) {
            $speciality = $this->specialityRepository->findOneBy(['name' => trim($speciality)]);

            if (!$speciality instanceof Speciality) {
                continue;
            }

            $response->addSpeciality($speciality);
        }
    }

    private function addHostingType(Response $response, array $hostingType)
    {
        foreach ($hostingType as $hostingTypeName) {
            $hostingType = $this->hostingTypeRepository->findOneBy(['name' => trim($hostingTypeName)]);

            if (!$hostingType instanceof HostingType) {
                continue;
            }

            $response->addHostingType($hostingType);
        }
    }

    private function addContainerEnvironmentUsage(Response $response, array $containerEnvironmentsUsage)
    {
        foreach ($containerEnvironmentsUsage as $name) {
            $containerEnvironmentUsage = $this->containerEnvironmentUsageRepository->findOneBy(['name' => trim($name)]);

            if (!$containerEnvironmentUsage instanceof ContainerEnvironmentUsage) {
                continue;
            }

            $response->addContainerEnvironmentUsage($containerEnvironmentUsage);
        }
    }

    private function addJobInterest(Response $response, array $jobInterests)
    {
        foreach ($jobInterests as $name) {
            $jobInterest = $this->jobInterestRepository->findOneBy(['name' => $name]);

            if (!$jobInterest instanceof JobInterest) {
                continue;
            }

            $response->addJobInterest($jobInterest);
        }
    }
}
