<?php

declare(strict_types=1);

namespace App\Report;

class IncludeAiInProjectReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.includeAiInProject as includeAiInProject')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->addGroupBy('response.includeAiInProject')
            ->addOrderBy('response.includeAiInProject', 'desc');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'include_ai_in_project';
    }

    /**
     * report weight.
     */
    public function getWeight(): int
    {
        return 120;
    }
}
