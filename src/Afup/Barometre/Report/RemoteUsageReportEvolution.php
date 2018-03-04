<?php

namespace Afup\Barometre\Report;

use Afup\Barometre\RequestModifier\RequestModifierCollection;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RemoteUsageReportEvolution
 * @package Afup\Barometre\Report
 */
class RemoteUsageReportEvolution extends AbstractReport implements AlterableReportInterface
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
            ->select('response.remoteUsage')
            ->addSelect('campaign.name')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->add('where', 'response.remoteUsage is not null')
            ->join('response', 'campaign', 'campaign', 'response.campaign_id = campaign.id')
            ->having('nbResponse >= :minResult')
            ->setParameter(':minResult', $this->minResult)
            ->groupBy('response.campaign_id')
            ->addGroupBy('response.remoteUsage')
            ->addOrderBy('campaign.name')
        ;

        $data = [];

        $allUsage = [];
        foreach ($this->queryBuilder->execute()->fetchAll() as $row) {
            $allUsage[$row['remoteUsage']] = 0;
            $data[$row['name']][$row['remoteUsage']] = $row['nbResponse'];
        }

        ksort($allUsage);

        foreach ($data as $campaignId => $values) {
            $data[$campaignId] = $values + $allUsage;
            ksort($data[$campaignId]);
        }

        if (count($data)) {
            $this->data = [
                'data' => $data,
                'columns' => array_keys($allUsage),
            ];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'remote_usage_evolution';
    }

    /**
     * @param Request $request
     */
    public function alterRequest(Request $request)
    {
        $this->requestModifierCollection->getModifier('filter_on_all_campaigns')->alterRequest($request);
    }
}
