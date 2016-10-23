<?php

namespace Afup\Barometre\Report;

use Afup\Barometre\RequestModifier\RequestModifierCollection;
use Symfony\Component\HttpFoundation\Request;

class GenderSalaryEvolutionReport extends AbstractReport implements AlterableReportInterface
{
    /**
     * @var RequestModifierCollection
     */
    private $requestModifierCollection;

    /**
     * @param RequestModifierCollection $requestModifierCollection
     * @param int $minResult
     */
    public function __construct(RequestModifierCollection $requestModifierCollection, $minResult = 10)
    {
        $this->requestModifierCollection = $requestModifierCollection;
        parent::__construct($minResult);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->addSelect('response.gender as gender')
            ->addSelect('AVG(annualSalary) as averageSalary')
            ->addSelect('campaign.name as campaign_name')
            ->join('response', 'campaign', 'campaign', 'response.campaign_id = campaign.id')
            ->addGroupBy('campaign_name')
            ->addGroupBy('response.gender')
            ->addOrderBy('campaign_name', 'asc')
            ->addOrderBy('response.gender', 'asc')
            ->having('COUNT(*) >= :minResult')
            ->setParameter(':minResult', $this->minResult)
        ;

        $data = [];

        foreach ($this->queryBuilder->execute() as $row) {
            $data[$row['campaign_name']][$row['gender']] = round($row['averageSalary']);
        }

        $this->data = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'gender_salary_evolution';
    }

    /**
     * report weight
     *
     * @return int
     */
    public function getWeight()
    {
        return -20;
    }

    /**
     * @param Request $request
     */
    public function alterRequest(Request $request)
    {
        $this->requestModifierCollection->getModifier('filter_on_all_campaigns')->alterRequest($request);
    }
}
