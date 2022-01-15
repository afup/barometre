<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Campaign;

use Afup\BarometreBundle\Entity\Campaign;
use Afup\BarometreBundle\Entity\Certification;
use Afup\BarometreBundle\Entity\ContainerEnvironmentUsage;
use Afup\BarometreBundle\Entity\HostingType;
use Afup\BarometreBundle\Entity\JobInterest;
use Afup\BarometreBundle\Entity\Response;
use Afup\BarometreBundle\Entity\Speciality;
use Afup\BarometreBundle\Enums\EnumsCollection;
use agallou\Departements\Collection as Departments;
use Doctrine\Common\Persistence\ObjectRepository;
use NumberFormatter;

use function in_array;
use function strlen;

class ResponseFactory
{
    /**
     * @var NumberFormatter
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
    /**
     * @var ObjectRepository
     */
    private $jobInterestRepository;

    public function __construct(
        NumberFormatter $numberFormatter,
        EnumsCollection $enums,
        ObjectRepository $certificationRepository,
        ObjectRepository $specialityRepository,
        ObjectRepository $hostingTypeRepository,
        ObjectRepository $containerEnvironmentUsageRepository,
        ObjectRepository $jobInterestRepository
    ) {
        $this->numberFormatter = $numberFormatter;
        $this->enums = $enums;
        $this->certificationRepository = $certificationRepository;
        $this->specialityRepository = $specialityRepository;
        $this->hostingTypeRepository = $hostingTypeRepository;
        $this->containerEnvironmentUsageRepository = $containerEnvironmentUsageRepository;
        $this->jobInterestRepository = $jobInterestRepository;
    }

    public function createResponse(array $data, Campaign $campaign): Response
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
            $this->enums->getEnums('initial_training')
                        ->getIdByLabel($data['initial_training'])
        );

        if (isset($data['retraining'])) {
            $response->setRetraining($this->enums->getEnums('retraining')->getIdByLabel($data['retraining']));
        }

        $response->setStatus(
            $this->enums->getEnums('status')
                        ->getIdByLabel($data['status'])
        );
        $response->setJobTitle(
            $this->enums->getEnums('job_title')
                        ->getIdByLabel($data['job_title'])
        );
        $response->setExperience(
            $this->enums->getEnums('experience')
                        ->getIdByLabel($data['experience'])
        );

        $response->setFreelanceTjm($data['freelance_tjm'] ?? null);

        $response->setFreelanceAverageWorkDayPerYear(
            $data['freelance_average_work_day'] ?? null
        );

        if (isset($data['contract_work_duration'])) {
            $response->setContractWorkDuration(
                $this->enums->getEnums('contract_work_duration')
                            ->getIdByLabel($data['contract_work_duration'])
            );
        }

        $department = new Departments();
        if (in_array($data['company_department'], array_keys($department->getAll()))) {
            $response->setCompanyDepartment(
                $data['company_department']
            );
        }

        $response->setCompanyType(
            $this->enums->getEnums('company_type')
                        ->getIdByLabel($data['company_type'])
        );
        $response->setCompanySize(
            $this->enums->getEnums('company_size')
                        ->getIdByLabel($data['company_size'])
        );

        $this->addJobInterest($response, explode(', ', $data['job_interest']));

        if (isset($data['company_origin'])) {
            $response->setCompanyOrigin($data['company_origin']);
        }

        $response->setOtherLanguage(
            $this->enums->getEnums('other_language')
                        ->getIdByLabel($data['other_language'])
        );

        $response->setRemoteUsage(
            $this->enums->getEnums('remote_usage')
                        ->getIdByLabel($data['remote_usage'])
        );

        if (isset($data['remote_pace'])) {
            $response->setRemotePace((int) $data['remote_pace']);
        }

        $response->setMeetupParticipation(
            $this->enums->getEnums('meetup_participation')
                        ->getIdByLabel($data['meetup_participation'])
        );

        $response->setTechnologicalWatch(
            $this->enums->getEnums('technological_watch')
                        ->getIdByLabel($data['technological_watch'])
        );

        $response->setOsDeveloppment(
            $this->enums->getEnums('os_developpment')
                        ->getIdByLabel($data['os_developpment'])
        );

        if (isset($data['hosting_type']) && strlen(trim($data['hosting_type'])) !== 0) {
            $this->addHostingType(
                $response,
                explode(', ', $data['hosting_type'])
            );
        }

        if (isset($data['container_environment_usage']) && strlen(trim($data['container_environment_usage'])) !== 0) {
            $this->addContainerEnvironmentUsage(
                $response,
                explode(', ', $data['container_environment_usage'])
            );
        }

        if (isset($data['work_method'])) {
            $response->setWorkMethod(
                $this->enums->getEnums('work_method')
                            ->getIdByLabel($data['work_method'])
            );
        }

        if (strlen(trim($data['speciality'])) !== 0) {
            $this->addSpeciality(
                $response,
                explode(', ', $data['speciality'])
            );
        }

        $response->setPhpVersion(
            $this->enums->getEnums('php_version')
                        ->getIdByLabel($data['php_version'])
        );

        if (isset($data['php_documentation_source'])) {
            $response->setPhpDocumentationSource(
                $this->enums->getEnums('php_documentation_source')
                            ->getIdByLabel($data['php_documentation_source'])
            );
        }
        if (isset($data['french_php_documentation_quality'])) {
            $response->setFrenchPhpDocumentationQuality(
                $this->enums->getEnums('french_php_documentation_quality')
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
            $this->enums->getEnums('php_strength')
                        ->getIdByLabel($data['php_strength'])
        );

        $response->setHasRecentTraining(
            'oui' === strtolower($data['has_formation'])
        );

        if (strlen($data['formation_impact'])) {
            $response->setRecentTrainingHadSalaryImpact(
                'oui' === strtolower($data['formation_impact'])
            );
        }

        $response->setGender(
            $this->enums->getEnums('gender')
                        ->getIdByLabel($data['gender'])
        );

        // added in campaign 2020
        if (isset($data['cms_usage_in_project'])) {
            $response->setCmsUsageInProject(
                $this
                    ->enums
                    ->getEnums('cms_usage_in_project')
                    ->getIdByLabel($data['cms_usage_in_project'])
            );
        }

        if (isset($data['covid19_company_trust'])) {
            $response->setCovid19CompanyTrust(
                $this->enums->getEnums('covid19.company_trust')->getIdByLabel($data['covid19_company_trust'])
            );
        }

        if (isset($data['covid19_company_handle'])) {
            $response->setCovid19CompanyHandle(
                $this->enums->getEnums('covid19.company_handle')->getIdByLabel($data['covid19_company_handle'])
            );
        }

        if (isset($data['covid19_layoff'])) {
            $response->setCovid19Layoff(
                $this->enums->getEnums('covid19.layoff')->getIdByLabel($data['covid19_layoff'])
            );
        }

        if (isset($data['covid19_future_plan'])) {
            $response->setCovid19FuturePlan(
                $this->enums->getEnums('covid19.future_plan')->getIdByLabel($data['covid19_future_plan'])
            );
        }

        if (isset($data['covid19_salary_impact'])) {
            $response->setCovid19SalaryImpact(
                $this->enums->getEnums('covid19.salary_impact')->getIdByLabel($data['covid19_salary_impact'])
            );
        }

        if (isset($data['covid19_partial_unemployment'])) {
            $response->setCovid19PartialUnemployment(
                $this->enums->getEnums('covid19.partial_unemployment')->getIdByLabel($data['covid19_partial_unemployment'])
            );
        }

        if (isset($data['covid19_regular_remote_feeling'])) {
            $response->setCovid19RegularRemoteFeeling(
                $this->enums->getEnums('covid19.regular_remote_feeling')->getIdByLabel($data['covid19_regular_remote_feeling'])
            );
        }

        if (isset($data['covid19_remote_ideal_pace'])) {
            $response->setCovid19RemoteIdealPace(
                (int) $data['covid19_remote_ideal_pace']
            );
        }

        if (isset($data['covid19_work_condition'])) {
            $response->setCovid19WorkCondition(
                (int) $data['covid19_work_condition']
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
