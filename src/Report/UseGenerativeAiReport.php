<?php

declare(strict_types=1);

namespace App\Report;

class UseGenerativeAiReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.useGenerativeAI as useGenerativeAI')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->addGroupBy('response.useGenerativeAI')
            ->addOrderBy('response.useGenerativeAI', 'desc');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'use_generative_ai';
    }

    /**
     * report weight.
     */
    public function getWeight(): int
    {
        return 100;
    }
}
