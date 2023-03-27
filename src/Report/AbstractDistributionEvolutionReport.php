<?php

declare(strict_types=1);

namespace App\Report;

use App\RequestModifier\RequestModifierCollection;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AbstractDistributionEvolutionReport.
 */
abstract class AbstractDistributionEvolutionReport extends AbstractReport implements AlterableReportInterface
{
    /**
     * @param int $minResult
     */
    public function __construct(private readonly RequestModifierCollection $requestModifierCollection, $minResult = 10)
    {
        parent::__construct($minResult);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.'.$this->getFieldName())
            ->addSelect('campaign.name')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->add('where', 'response.'.$this->getFieldName().' is not null')
            ->join('response', 'campaign', 'campaign', 'response.campaign_id = campaign.id')
            ->having('nbResponse >= :minResult')
            ->setParameter('minResult', $this->minResult)
            ->groupBy('response.campaign_id')
            ->addGroupBy('response.'.$this->getFieldName())
            ->addOrderBy('campaign.name')
            ->addOrderBy('response.'.$this->getFieldName(), 'asc')
        ;

        $data = [];

        $allStatus = [];
        foreach ($this->queryBuilder->fetchAllAssociative() as $row) {
            $allStatus[$row[$this->getFieldName()]] = 0;
            $data[$row['name']][$row[$this->getFieldName()]] = $row['nbResponse'];
        }

        ksort($allStatus);

        foreach ($data as $campaignId => $values) {
            $data[$campaignId] = $values + $allStatus;
            ksort($data[$campaignId]);
        }

        if (\count($data)) {
            $this->data = [
                'data' => $data,
                'columns' => array_keys($allStatus),
            ];
        }
    }

    public function alterRequest(Request $request)
    {
        $this->requestModifierCollection->getModifier('filter_on_all_campaigns')->alterRequest($request);
    }

    abstract protected function getFieldName();
}
