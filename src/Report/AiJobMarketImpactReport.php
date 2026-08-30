<?php

declare(strict_types=1);

namespace App\Report;

class AiJobMarketImpactReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.aiJobMarketImpact as aiJobMarketImpact')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->addGroupBy('response.aiJobMarketImpact')
            ->addOrderBy('response.aiJobMarketImpact', 'asc');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ai_job_market_impact';
    }

    /**
     * report weight.
     */
    public function getWeight(): int
    {
        return 126;
    }
}
