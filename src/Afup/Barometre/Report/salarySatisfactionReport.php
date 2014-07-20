<?php
/**
 * Salary satisfaction
 */

namespace Afup\Barometre\Report;

class salarySatisfactionReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $results =  $this->queryBuilder
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
}
