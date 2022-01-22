<?php

declare(strict_types=1);

namespace App\Report;

class JobTitleReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.jobTitle as jobTitle')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->addGroupBy('response.jobTitle');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'job_title';
    }
}
