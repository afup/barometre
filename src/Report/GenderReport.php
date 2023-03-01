<?php

declare(strict_types=1);

namespace App\Report;

class GenderReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.experience')
            ->addSelect('response.gender as gender')
            ->addSelect('AVG(annualSalary) as averageSalary')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->having('nbResponse >= :minResult')
            ->setParameter('minResult', $this->minResult)
            ->groupBy('response.gender')
            ->orderBy('nbResponse', 'desc');

        $this->data = $this->queryBuilder->executeQuery()->fetchAllAssociative();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'gender';
    }

    /**
     * report weight.
     *
     * @return int
     */
    public function getWeight()
    {
        return -20;
    }
}
