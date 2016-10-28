<?php

namespace Afup\Barometre\Report;

use Afup\Barometre\RequestModifier\RequestModifierCollection;
use Symfony\Component\HttpFoundation\Request;

class PhpVersionReportEvolution extends AbstractReport implements AlterableReportInterface
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
            ->select('response.phpVersion')
            ->addSelect('campaign.name')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->add('where', 'response.phpVersion is not null')
            ->join('response', 'campaign', 'campaign', 'response.campaign_id = campaign.id')
            ->having('nbResponse >= :minResult')
            ->setParameter(':minResult', $this->minResult)
            ->groupBy('response.campaign_id')
            ->addGroupBy('response.phpVersion')
            ->addOrderBy('campaign.name')
        ;

        $data = [];

        $allPhpVersions = [];

        foreach ($this->queryBuilder->execute()->fetchAll() as $row) {
            $allPhpVersions[$row['phpVersion']] = 0;
            $data[$row['name']][$row['phpVersion']] = $row['nbResponse'];
        }

        ksort($allPhpVersions);

        foreach ($data as $campaignId => $values) {
            $data[$campaignId] = $values + $allPhpVersions;
            ksort($data[$campaignId]);
        }

        if (count($data)) {
            $this->data = [
                'data' => $data,
                'columns' => array_keys($allPhpVersions),
            ];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'php_version_evolution';
    }

    /**
     * @param Request $request
     */
    public function alterRequest(Request $request)
    {
        $this->requestModifierCollection->getModifier('filter_on_all_campaigns')->alterRequest($request);
    }
}
