<?php

namespace Afup\Barometre\Report;

/**
 * Class StatusEvolutionReport
 * @package Afup\Barometre\Report
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
