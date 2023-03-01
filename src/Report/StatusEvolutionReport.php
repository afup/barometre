<?php

declare(strict_types=1);

namespace App\Report;

/**
 * Class StatusEvolutionReport.
 */
class StatusEvolutionReport extends AbstractDistributionEvolutionReport
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'status_evolution';
    }

    /**
     * {@inheritdoc}
     */
    protected function getFieldName()
    {
        return 'status';
    }
}
