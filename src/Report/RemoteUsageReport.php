<?php

declare(strict_types=1);

namespace App\Report;

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
            ->setParameter('minResult', $this->minResult)
            ->groupBy('response.remoteUsage')
            ->orderBy('nbResponse', 'desc');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'remote_usage';
    }

    /**
     * report weight.
     */
    public function getWeight(): int
    {
        return -40;
    }
}
