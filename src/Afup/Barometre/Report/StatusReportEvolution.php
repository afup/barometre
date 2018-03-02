<?php

namespace Afup\Barometre\Report;

use Afup\Barometre\RequestModifier\RequestModifierCollection;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class StatusReportEvolution
 * @package Afup\Barometre\Report
 */
class StatusReportEvolution extends AbstractReport implements AlterableReportInterface
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
            ->select('response.status')
            ->addSelect('campaign.name')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->add('where', 'response.status is not null')
            ->join('response', 'campaign', 'campaign', 'response.campaign_id = campaign.id')
            ->having('nbResponse >= :minResult')
            ->setParameter(':minResult', $this->minResult)
            ->groupBy('response.campaign_id')
            ->addGroupBy('response.status')
            ->addOrderBy('campaign.name')
        ;

        $data = [];

        $allStatus = [];
        foreach ($this->queryBuilder->execute()->fetchAll() as $row) {
            $allStatus[$row['status']] = 0;
            $data[$row['name']][$row['status']] = $row['nbResponse'];
        }

        ksort($allStatus);

        foreach ($data as $campaignId => $values) {
            $data[$campaignId] = $values + $allStatus;
            ksort($data[$campaignId]);
        }

        if (count($data)) {
            $this->data = [
                'data' => $data,
                'columns' => array_keys($allStatus),
            ];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'status_evolution';
    }

    /**
     * @param Request $request
     */
    public function alterRequest(Request $request)
    {
        $this->requestModifierCollection->getModifier('filter_on_all_campaigns')->alterRequest($request);
    }
}
