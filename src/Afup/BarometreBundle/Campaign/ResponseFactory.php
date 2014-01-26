<?php

namespace Afup\BarometreBundle\Campaign;

use Afup\BarometreBundle\Entity\Campaign;
use Afup\BarometreBundle\Entity\Response;
use Afup\BarometreBundle\Enums\EnumsCollection;
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
     * @param NumberFormatter $numberFormatter
     * @param EnumsCollection $enums
     */
    public function __construct(NumberFormatter $numberFormatter, EnumsCollection $enums)
    {
        $this->numberFormatter = $numberFormatter;
        $this->enums           = $enums;
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
        $response->setSalarySatisfaction(
            $this->numberFormatter->parse($data["salary_satisfaction"])
        );

        $response->setStatus(
            $this->enums->getEnums('status')->getIdByLabel($data["status"])
        );
        $response->setInitialTraining(
            $this->enums->getEnums('initial_training')->getIdByLabel($data["initial_training"])
        );
        $response->setCompagnyType(
            $this->enums->getEnums('company_type')->getIdByLabel($data["company_type"])
        );
        $response->setCompagnySize(
            $this->enums->getEnums('company_size')->getIdByLabel($data["company_size"])
        );
        $response->setCompagnyDepartment(
            $data["company_department"]
        );
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
            "oui" === $data["has_formation"]
        );
        $response->setIsRecentTrainingHadSalaryImpact(
            "oui" === $data["formation_impact"]
        );

        // TODO certification, spécialité

        return $response;
    }
}
