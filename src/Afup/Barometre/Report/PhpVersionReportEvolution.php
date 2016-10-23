<?php

namespace Afup\Barometre\Report;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;

class PhpVersionReportEvolution extends AbstractReport implements AlterableReportInterface
{
    /**
     * @var Doctrine
     */
    protected $doctrine;

    /**
     * @param Doctrine $doctrine
     * @param int $minResult
     */
    public function __construct(Doctrine $doctrine, $minResult = 10)
    {
        $this->doctrine = $doctrine;
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
        $campaignIds = [];
        $campaignRepository = $this->doctrine->getManager()->getRepository('AfupBarometreBundle:Campaign');
        foreach ($campaignRepository->findAll() as $campaign) {
            $campaignIds[] = $campaign->getId();
        }

        $filter = $request->get('filter', []);
        $filter['campaign'] = $campaignIds;
        $request->query->set('filter', $filter);
    }
}
