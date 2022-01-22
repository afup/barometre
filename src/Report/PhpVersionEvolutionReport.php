<?php

declare(strict_types=1);

namespace App\Report;

class PhpVersionEvolutionReport extends AbstractDistributionEvolutionReport
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'php_version_evolution';
    }

    /**
     * {@inheritdoc}
     */
    protected function getFieldName()
    {
        return 'phpVersion';
    }
}
