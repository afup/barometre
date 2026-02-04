<?php

declare(strict_types=1);

namespace App\Report;

class TechnologicalWatchReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.technologicalWatch')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->having('nbResponse >= :minResult')
            ->setParameter('minResult', $this->minResult)
            ->groupBy('response.technologicalWatch')
            ->orderBy('nbResponse', 'desc');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'technological_watch';
    }

    /**
     * report weight.
     *
     * @return int
     */
    public function getWeight(): int
    {
        return -20;
    }
}
