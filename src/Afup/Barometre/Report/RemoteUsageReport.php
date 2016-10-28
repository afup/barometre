<?php

namespace Afup\Barometre\Report;

class RemoteUsageReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.remoteUsage')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->having('nbResponse >= :minResult')
            ->setParameter(':minResult', $this->minResult)
            ->groupBy('response.remoteUsage')
            ->orderBy('nbResponse', 'desc');

        $this->data = $this->queryBuilder->execute()->fetchAll();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'remote_usage';
    }

    /**
     * report weight
     *
     * @return int
     */
    public function getWeight()
    {
        return -40;
    }
}
