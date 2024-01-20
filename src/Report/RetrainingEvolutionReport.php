<?php

declare(strict_types=1);

namespace App\Report;

class RetrainingEvolutionReport extends AbstractDistributionEvolutionReport
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'retraining_evolution';
    }

    /**
     * {@inheritdoc}
     */
    protected function getFieldName()
    {
        return 'retraining';
    }
}
