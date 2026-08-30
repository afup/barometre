<?php

declare(strict_types=1);

namespace App\Report;

/**
 * Report on AiUsagePurpose.
 */
class AiUsagePurposeReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('count(distinct response.id) as nbResponse')
            ->join(
                'response',
                'response_aiusagepurpose',
                'response_aiusagepurpose',
                'response.id = response_aiusagepurpose.response_id'
            )
            ->join(
                'response_aiusagepurpose',
                'ai_usage_purpose',
                'ai_usage_purpose',
                'response_aiusagepurpose.aiusagepurpose_id = ai_usage_purpose.id'
            )
            ->addSelect('ai_usage_purpose.name as aiUsagePurposeName')
            ->addGroupBy('aiUsagePurposeName')
            ->addOrderBy('nbResponse', 'desc');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ai_usage_purpose';
    }

    /**
     * report weight.
     */
    public function getWeight(): int
    {
        return 129;
    }
}
