<?php

declare(strict_types=1);

namespace App\Report;

class OsDeveloppmentReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.osDeveloppment')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->having('nbResponse >= :minResult')
            ->setParameter('minResult', $this->minResult)
            ->groupBy('response.osDeveloppment')
            ->orderBy('nbResponse', 'desc');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'os_developpment';
    }

    /**
     * report weight.
     */
    public function getWeight(): int
    {
        return -20;
    }
}
