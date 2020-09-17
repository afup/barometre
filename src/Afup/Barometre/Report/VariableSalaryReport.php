<?php

declare(strict_types=1);

namespace Afup\Barometre\Report;

class VariableSalaryReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.experience')
            ->addSelect('AVG(response.grossAnnualSalary) as grossAnnualSalary')
            ->addSelect('AVG(response.variableAnnualSalary) as variableAnnualSalary')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->having('nbResponse >= :minResult')
            ->setParameter(':minResult', $this->minResult)
            ->groupBy('response.experience');

        $this->data = $this->queryBuilder->execute();
    }

    /**
     * The report name (used for url)
     *
     * @return string
     */
    public function getName()
    {
        return 'variable_salary';
    }

    /**
     * report weight
     *
     * @return int
     */
    public function getWeight()
    {
        return -20;
    }
}
