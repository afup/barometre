<?php

declare(strict_types=1);

namespace App\Report;

/**
 * Class RemoteUsageEvolutionReport
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
