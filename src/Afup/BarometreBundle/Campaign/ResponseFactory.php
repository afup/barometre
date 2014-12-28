<?php

namespace Afup\BarometreBundle\Campaign;

use Afup\BarometreBundle\Entity\Campaign;
use Afup\BarometreBundle\Entity\Certification;
use Afup\BarometreBundle\Entity\Response;
use Afup\BarometreBundle\Entity\Speciality;
use Afup\BarometreBundle\Enums\EnumsCollection;
use Doctrine\Common\Persistence\ObjectRepository;
use agallou\Departements\Collection as Departments;
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
     * @param NumberFormatter  $numberFormatter
     * @param EnumsCollection  $enums
     * @param ObjectRepository $certificationRepository
     * @param ObjectRepository $specialityRepository
     */
    public function __construct(
        NumberFormatter $numberFormatter,
        EnumsCollection $enums,
        ObjectRepository $certificationRepository,
        ObjectRepository $specialityRepository
    ) {
        $this->numberFormatter         = $numberFormatter;
        $this->enums                   = $enums;
        $this->certificationRepository = $certificationRepository;
        $this->specialityRepository    = $specialityRepository;
    }

    /**
     * @param array    $data
     * @param Campaign $campaign
     *
     * @return Response
     */
    public function createResponse(array $data, Campaign $campaign)
    {
        $response = new Response();

        $response->setCampaign($campaign);

        $response->setGrossAnnualSalary(
            $this->numberFormatter->parse($data["gross_annual_salary"])
        );
        $response->setVariableAnnualSalary(
            $this->numberFormatter->parse($data["variable_annual_salary"])
        );
        $response->setAnnualSalary(
            $this->numberFormatter->parse($data["annual_salary"])
        );
        $response->setSalarySatisfaction(
            $this->numberFormatter->parse($data["salary_satisfaction"])
        );
        $response->setStatus(
            $this->enums->getEnums('status')->getIdByLabel($data["status"])
        );
        $response->setJobTitle(
            $this->enums->getEnums('job_title')->getIdByLabel($data["job_title"])
        );
        $response->setExperience(
            $this->enums->getEnums('experience')->getIdByLabel($data["experience"])
        );
        $response->setInitialTraining(
            $this->enums->getEnums('initial_training')->getIdByLabel($data["initial_training"])
        );
        $response->setCompanyType(
            $this->enums->getEnums('company_type')->getIdByLabel($data["company_type"])
        );
        $response->setCompanySize(
            $this->enums->getEnums('company_size')->getIdByLabel($data["company_size"])
        );

        $department = new Departments();
        if (in_array($data["company_department"], array_keys($department->getAll()))) {
            $response->setCompanyDepartment(
                $data["company_department"]
            );
        }
        $response->setJobInterest(
            $this->enums->getEnums('job_interest')->getIdByLabel($data["job_interest"])
        );
        $response->setPhpVersion(
            $this->enums->getEnums('php_version')->getIdByLabel($data["php_version"])
        );
        $response->setPhpStrength(
            $this->enums->getEnums('php_strength')->getIdByLabel($data["php_strength"])
        );
        $response->setHasRecentTraining(
            "oui" === strtolower($data["has_formation"])
        );
        $response->setRecentTrainingHadSalaryImpact(
            "oui" === strtolower($data["formation_impact"])
        );

        if ("oui" === strtolower($data['has_certification'])) {
            $this->addCertification(
                $response,
                explode(', ', $data['certification_list'])
            );
        }

        if (strlen(trim($data["speciality"])) !== 0) {
            $this->addSpeciality(
                $response,
                explode(', ', $data['speciality'])
            );
        }

        $response->setGender(
            $this->enums->getEnums('gender')->getIdByLabel($data["gender"])
        );

        return $response;
    }

    /**
     * @param Response $response
     * @param array    $certificationList
     */
    protected function addCertification(Response $response, array $certificationList)
    {
        foreach ($certificationList as $certification) {

            $certification = $this->certificationRepository->findOneBy(
                array(
                    'name' => trim($certification)
                )
            );

            if (!$certification instanceof Certification) {
                continue;
            }

            $response->addCertification($certification);
        }
    }

    /**
     * @param Response $response
     * @param array    $specialityList
     */
    protected function addSpeciality(Response $response, array $specialityList)
    {
        foreach ($specialityList as $speciality) {
            $speciality = $this->specialityRepository->findOneBy(array('name' => trim($speciality)));

            if (!$speciality instanceof Speciality) {
                continue;
            }

            $response->addSpeciality($speciality);
        }
    }
}
