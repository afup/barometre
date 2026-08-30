<?php

declare(strict_types=1);

namespace App\Report;

class AiJobImpactReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.aiJobImpact as aiJobImpact')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->addGroupBy('response.aiJobImpact')
            ->addOrderBy('response.aiJobImpact', 'asc');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ai_job_impact';
    }

    /**
     * report weight.
     */
    public function getWeight(): int
    {
        return 127;
    }
}
