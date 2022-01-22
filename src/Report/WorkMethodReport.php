<?php

declare(strict_types=1);

namespace App\Report;

class WorkMethodReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'work_method_report';
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.workMethod')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->having('nbResponse >= :minResult')
            ->setParameter('minResult', $this->minResult)
            ->groupBy('response.workMethod')
            ->orderBy('nbResponse', 'desc');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }
}
