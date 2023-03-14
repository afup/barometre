<?php

declare(strict_types=1);

namespace App\Report;

class SalarySatisfactionEvolutionReport extends AbstractDistributionEvolutionReport
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'salary_satisfaction_evolution';
    }

    /**
     * {@inheritdoc}
     */
    protected function getFieldName()
    {
        return 'salarySatisfaction';
    }
}
