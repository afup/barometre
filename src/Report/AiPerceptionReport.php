<?php

declare(strict_types=1);

namespace App\Report;

class AiPerceptionReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.aiPerception as aiPerception')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->addGroupBy('response.aiPerception')
            ->addOrderBy('response.aiPerception', 'asc');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ai_perception';
    }

    /**
     * report weight.
     */
    public function getWeight(): int
    {
        return 128;
    }
}
