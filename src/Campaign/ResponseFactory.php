<?php

declare(strict_types=1);

namespace App\Campaign;

use agallou\Departements\Collection as Departments;
use App\Entity\Campaign;
use App\Entity\Certification;
use App\Entity\ContainerEnvironmentUsage;
use App\Entity\HostingType;
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
use App\Enums\JobInterestEnums;
use App\Enums\JobTitleEnums;
use App\Enums\MeetupParticipationEnums;
use App\Enums\OsDeveloppmentEnums;
use App\Enums\OtherLanguageEnums;
use App\Enums\PHPDocumentationUsageEnums;
use App\Enums\PHPStrengthEnums;
use App\Enums\PHPVersionEnums;
use App\Enums\RemoteUsageEnums;
use App\Enums\StatusEnums;
use App\Enums\TechnologicalWatchEnums;
use App\Enums\WorkMethodEnums;
use Doctrine\Persistence\ObjectRepository;
use NumberFormatter;

class ResponseFactory
{
    /**
     * @var \NumberFormatter
     */
    private $numberFormatter;

    /**
     * @var EnumsCollection
     */
    private $enums;

    /**
     * @var ObjectRepository
     */
    private $certificationRepository;

    /**
     * @var ObjectRepository
     */
    private $specialityRepository;
    /**
     * @var ObjectRepository
     */
    private $hostingTypeRepository;
    /**
     * @var ObjectRepository
     */
    private $containerEnvironmentUsageRepository;

    public function __construct(
        NumberFormatter $numberFormatter,
        EnumsCollection $enums,
        ObjectRepository $certificationRepository,
        ObjectRepository $specialityRepository,
        ObjectRepository $hostingTypeRepository,
        ObjectRepository $containerEnvironmentUsageRepository
    ) {
        $this->numberFormatter = $numberFormatter;
        $this->enums = $enums;
        $this->certificationRepository = $certificationRepository;
        $this->specialityRepository = $specialityRepository;
        $this->hostingTypeRepository = $hostingTypeRepository;
        $this->containerEnvironmentUsageRepository = $containerEnvironmentUsageRepository;
    }

    /**
     * @return Response
     */
    public function createResponse(array $data, Campaign $campaign)
    {
        $response = new Response();

        $response->setCampaign($campaign);

        $response->setGrossAnnualSalary(
            $this->numberFormatter->parse((string) $data['gross_annual_salary'])
        );
        $response->setVariableAnnualSalary(
            $this->numberFormatter->parse((string) $data['variable_annual_salary'])
        );
        $response->setAnnualSalary(
            $this->numberFormatter->parse((string) $data['annual_salary'])
        );
        $response->setSalarySatisfaction(
            $this->numberFormatter->parse($data['salary_satisfaction'])
        );
        $response->setInitialTraining(
            $this->enums->getEnums(InitialTrainingEnums::class)
                        ->getIdByLabel($data['initial_training'])
        );
        $response->setStatus(
            $this->enums->getEnums(StatusEnums::class)
                        ->getIdByLabel($data['status'])
        );
        $response->setJobTitle(
            $this->enums->getEnums(JobTitleEnums::class)
                        ->getIdByLabel($data['job_title'])
        );
        $response->setExperience(
            $this->enums->getEnums(ExperienceEnums::class)
                        ->getIdByLabel($data['experience'])
        );

        $response->setFreelanceTjm(
            $data['freelance_tjm'] ?? null
        );

        $response->setFreelanceAverageWorkDayPerYear(
            $data['freelance_average_work_day'] ?? null
        );

        if (isset($data['contract_work_duration'])) {
            $response->setContractWorkDuration(
                $this->enums->getEnums(ContractWorkDurationEnums::class)
                            ->getIdByLabel($data['contract_work_duration'])
            );
        }

        $department = new Departments();
        if (\array_key_exists($data['company_department'], $department->getAll())) {
            $response->setCompanyDepartment(
                $data['company_department']
            );
        }

        $response->setCompanyType(
            $this->enums->getEnums(CompanyTypeEnums::class)
                        ->getIdByLabel($data['company_type'])
        );
        $response->setCompanySize(
            $this->enums->getEnums(CompanySizeEnums::class)
                        ->getIdByLabel($data['company_size'])
        );

        $response->setJobInterest(
            $this->enums->getEnums(JobInterestEnums::class)
                        ->getIdByLabel($data['job_interest'])
        );

        if (isset($data['company_origin'])) {
            $response->setCompanyOrigin($data['company_origin']);
        }

        $response->setOtherLanguage(
            $this->enums->getEnums(OtherLanguageEnums::class)
                        ->getIdByLabel($data['other_language'])
        );

        $response->setRemoteUsage(
            $this->enums->getEnums(RemoteUsageEnums::class)
                        ->getIdByLabel($data['remote_usage'])
        );

        $response->setMeetupParticipation(
            $this->enums->getEnums(MeetupParticipationEnums::class)
                        ->getIdByLabel($data['meetup_participation'])
        );

        $response->setTechnologicalWatch(
            $this->enums->getEnums(TechnologicalWatchEnums::class)
                        ->getIdByLabel($data['technological_watch'])
        );

        $response->setOsDeveloppment(
            $this->enums->getEnums(OsDeveloppmentEnums::class)
                        ->getIdByLabel($data['os_developpment'])
        );

        if (\strlen(trim($data['hosting_type'])) !== 0) {
            $this->addHostingType(
                $response,
                explode(', ', $data['hosting_type'])
            );
        }

        if (\strlen(trim($data['container_environment_usage'])) !== 0) {
            $this->addContainerEnvironmentUsage(
                $response,
                explode(', ', $data['container_environment_usage'])
            );
        }

        if (isset($data['work_method'])) {
            $response->setWorkMethod(
                $this->enums->getEnums(WorkMethodEnums::class)
                            ->getIdByLabel($data['work_method'])
            );
        }

        if (\strlen(trim($data['speciality'])) !== 0) {
            $this->addSpeciality(
                $response,
                explode(', ', $data['speciality'])
            );
        }

        $response->setPhpVersion(
            $this->enums->getEnums(PHPVersionEnums::class)
                        ->getIdByLabel($data['php_version'])
        );

        if (isset($data['php_documentation_source'])) {
            $response->setPhpDocumentationSource(
                $this->enums->getEnums(PHPDocumentationUsageEnums::class)
                            ->getIdByLabel($data['php_documentation_source'])
            );
        }
        if (isset($data['french_php_documentation_quality'])) {
            $response->setFrenchPhpDocumentationQuality(
                $this->enums->getEnums(FrenchPHPDocumentationQualityEnums::class)
                            ->getIdByLabel($data['french_php_documentation_quality'])
            );
        }

        if ('oui' === strtolower($data['has_certification'])) {
            $this->addCertification(
                $response,
                explode(', ', $data['certification_list'])
            );
        }

        $response->setPhpStrength(
            $this->enums->getEnums(PHPStrengthEnums::class)
                        ->getIdByLabel($data['php_strength'])
        );

        $response->setHasRecentTraining(
            'oui' === strtolower($data['has_formation'])
        );

        if (\strlen($data['formation_impact'])) {
            $response->setRecentTrainingHadSalaryImpact(
                'oui' === strtolower($data['formation_impact'])
            );
        }

        $response->setGender(
            $this->enums->getEnums(GenderEnums::class)
                        ->getIdByLabel($data['gender'])
        );

        // added in campaign 2020
        if (isset($data['cms_usage_in_project'])) {
            $response->setCmsUsageInProject(
                $this
                    ->enums
                    ->getEnums(CmsUsageInProjectEnums::class)
                    ->getIdByLabel($data['cms_usage_in_project'])
            );
        }

        if (isset($data['covid19_company_trust'])) {
            $response->setCovid19CompanyTrust(
                $this->enums->getEnums(CompanyTrustEnums::class)->getIdByLabel($data['covid19_company_trust'])
            );
        }

        if (isset($data['covid19_company_handle'])) {
            $response->setCovid19CompanyHandle(
                $this->enums->getEnums(CompanyHandleEnums::class)->getIdByLabel($data['covid19_company_handle'])
            );
        }

        if (isset($data['covid19_layoff'])) {
            $response->setCovid19Layoff(
                $this->enums->getEnums(LayoffEnums::class)->getIdByLabel($data['covid19_layoff'])
            );
        }

        if (isset($data['covid19_future_plan'])) {
            $response->setCovid19FuturePlan(
                $this->enums->getEnums(FuturePlanEnums::class)->getIdByLabel($data['covid19_future_plan'])
            );
        }

        if (isset($data['covid19_salary_impact'])) {
            $response->setCovid19SalaryImpact(
                $this->enums->getEnums(SalaryImpactEnums::class)->getIdByLabel($data['covid19_salary_impact'])
            );
        }

        if (isset($data['covid19_partial_unemployment'])) {
            $response->setCovid19PartialUnemployment(
                $this->enums->getEnums(PartialUnemploymentEnums::class)->getIdByLabel($data['covid19_partial_unemployment'])
            );
        }

        if (isset($data['covid19_regular_remote_feeling'])) {
            $response->setCovid19RegularRemoteFeeling(
                $this->enums->getEnums(RegularRemoteFeelingEnums::class)->getIdByLabel($data['covid19_regular_remote_feeling'])
            );
        }

        if (isset($data['covid19_remote_ideal_pace'])) {
            $response->setCovid19RemoteIdealPace(
                (int) $data['covid19_remote_ideal_pace']
            );
        }

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
}
