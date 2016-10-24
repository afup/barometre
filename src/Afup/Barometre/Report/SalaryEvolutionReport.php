<?php

namespace Afup\Barometre\Report;

use Afup\Barometre\RequestModifier\RequestModifierCollection;
use Symfony\Component\HttpFoundation\Request;

class SalaryEvolutionReport extends AbstractReport implements AlterableReportInterface
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
        $qb = clone $this->queryBuilder;
        $qb
            ->addSelect('AVG(annualSalary) as averageSalary')
            ->addSelect('COUNT(*) as cnt')
            ->addSelect('campaign.name as campaign_name')
            ->addSelect('campaign.id as campaign_id')
            ->join('response', 'campaign', 'campaign', 'response.campaign_id = campaign.id')
            ->addGroupBy('campaign_name')
            ->addOrderBy('campaign_name', 'asc')
            ->having('COUNT(*) >= :minResult')
            ->setParameter(':minResult', $this->minResult);

        $data = [];

        foreach ($qb->execute() as $row) {
            $data[$row['campaign_name']] = [
                'avg' => round($row['averageSalary']),
                'per_90' => round($this->calculatePercentileForYear($row['campaign_id'], $row['cnt'], 90)),
                'per_50' => round($this->calculatePercentileForYear($row['campaign_id'], $row['cnt'], 50)),
            ];
        }

        $this->data = $data;
    }

    /**
     * @param $campaignId
     * @param $campaignCount
     * @param $percentile
     *
     * @return mixed
     */
    protected function calculatePercentileForYear($campaignId, $campaignCount, $percentile)
    {
        $qb = clone $this->queryBuilder;

        $qb->select('response.grossAnnualSalary');

        $qb->andWhere("response.campaign_id = :id");
        $qb->setParameter(':id', $campaignId);

        $qb->orderBy('response.grossAnnualSalary', 'asc');

        $qb->setFirstResult($percentile / 100 * $campaignCount);
        $qb->setMaxResults(1);

        $result = $qb->execute()->fetch();

        return $result['grossAnnualSalary'];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'salary_evolution';
    }

    /**
     * report weight
     *
     * @return int
     */
    public function getWeight()
    {
        return 100;
    }

    /**
     * @param Request $request
     */
    public function alterRequest(Request $request)
    {
        $this->requestModifierCollection->getModifier('filter_on_all_campaigns')->alterRequest($request);
    }
}
