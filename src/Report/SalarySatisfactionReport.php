<?php

declare(strict_types=1);
/**
 * Salary satisfaction.
 */

namespace App\Report;

class SalarySatisfactionReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.salarySatisfaction as salarySatisfaction')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->having('nbResponse >= :minResult')
            ->setParameter('minResult', $this->minResult)
            ->groupBy('response.salarySatisfaction')
            ->orderBy('salarySatisfaction', 'desc');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'salary_satisfaction';
    }

    /**
     * report weight.
     *
     * @return int
     */
    public function getWeight()
    {
        return 5;
    }
}
