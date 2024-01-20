<?php

declare(strict_types=1);

namespace App\Report;

class RetrainingReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.retraining as retraining')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->addGroupBy('response.retraining');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'retraining';
    }
}
