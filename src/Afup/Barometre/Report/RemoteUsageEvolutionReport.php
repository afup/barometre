<?php

namespace Afup\Barometre\Report;

/**
 * Class RemoteUsageEvolutionReport
 * @package Afup\Barometre\Report
 */
class RemoteUsageEvolutionReport extends AbstractDistributionEvolutionReport
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'remote_usage_evolution';
    }

    /**
     * {@inheritdoc}
     */
    protected function getFieldName()
    {
        return 'remoteUsage';
    }
}
