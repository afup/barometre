<?php
/**
 * Salary satisfaction
 */

namespace Afup\Barometre\Report;

class SalarySatisfactionReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.experience')
            ->addSelect('response.salarySatisfaction as salarySatisfaction')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->having('nbResponse >= :minResult')
            ->setParameter(':minResult', $this->minResult)
            ->groupBy('response.salarySatisfaction')
            ->orderBy('salarySatisfaction', 'desc');

        $this->data = $this->queryBuilder->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'salary_satisfaction';
    }


    /**
     * report weight
     *
     * @return int
     */
    public function getWeight()
    {
        return 5;
    }
}
