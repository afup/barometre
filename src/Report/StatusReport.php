<?php

declare(strict_types=1);

namespace App\Report;

/*
 * Report on status
 */
class StatusReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.status as status')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->addGroupBy('response.status');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'status';
    }
}
