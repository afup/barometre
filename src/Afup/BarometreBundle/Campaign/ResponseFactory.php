<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Campaign;

use Afup\BarometreBundle\Entity\Campaign;
use Afup\BarometreBundle\Entity\Certification;
use Afup\BarometreBundle\Entity\ContainerEnvironmentUsage;
use Afup\BarometreBundle\Entity\HostingType;
use Afup\BarometreBundle\Entity\Response;
use Afup\BarometreBundle\Entity\Speciality;
use Afup\BarometreBundle\Enums\EnumsCollection;
use Afup\BarometreBundle\Repository\CertificationRepository;
use Afup\BarometreBundle\Repository\ContainerEnvironmentUsageRepository;
use Afup\BarometreBundle\Repository\HostingTypeRepository;
use Afup\BarometreBundle\Repository\SpecialityRepository;
use agallou\Departements\Collection as Departments;
use Doctrine\Common\Persistence\ObjectRepository;
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
        CertificationRepository $certificationRepository,
        SpecialityRepository $specialityRepository,
        HostingTypeRepository $hostingTypeRepository,
        ContainerEnvironmentUsageRepository $containerEnvironmentUsageRepository
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
            $this->numberFormatter->parse($data['gross_annual_salary'])
        );
        $response->setVariableAnnualSalary(
            $this->numberFormatter->parse($data['variable_annual_salary'])
        );
        $response->setAnnualSalary(
            $this->numberFormatter->parse($data['annual_salary'])
        );
        $response->setSalarySatisfaction(
            $this->numberFormatter->parse($data['salary_satisfaction'])
        );
        $response->setInitialTraining(
            $this->enums->getEnums('initial_training')
                        ->getIdByLabel($data['initial_training'])
        );
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

        $response->setFreelanceTjm(
            isset($data['freelance_tjm']) ? $data['freelance_tjm'] : null
        );

        $response->setFreelanceAverageWorkDayPerYear(
            isset($data['freelance_average_work_day']) ? $data['freelance_average_work_day'] : null
        );

        if (isset($data['contract_work_duration'])) {
            $response->setContractWorkDuration(
                $this->enums->getEnums('contract_work_duration')
                            ->getIdByLabel($data['contract_work_duration'])
            );
        }

        $department = new Departments();
        if (\in_array($data['company_department'], array_keys($department->getAll()))) {
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

        $response->setJobInterest(
            $this->enums->getEnums('job_interest')
                        ->getIdByLabel($data['job_interest'])
        );

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
                $this->enums->getEnums('work_method')
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

        if (\strlen($data['formation_impact'])) {
            $response->setRecentTrainingHadSalaryImpact(
                'oui' === strtolower($data['formation_impact'])
            );
        }

        $response->setGender(
            $this->enums->getEnums('gender')
                        ->getIdByLabel($data['gender'])
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
}
