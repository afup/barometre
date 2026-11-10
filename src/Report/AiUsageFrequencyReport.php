<?php

declare(strict_types=1);

namespace App\Report;

class AiUsageFrequencyReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.aiUsageFrequency as aiUsageFrequency')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->addGroupBy('response.aiUsageFrequency')
            ->addOrderBy('response.aiUsageFrequency', 'asc');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ai_usage_frequency';
    }

    /**
     * report weight.
     */
    public function getWeight(): int
    {
        return 130;
    }
}
