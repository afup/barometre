<?php

declare(strict_types=1);

namespace Afup\Barometre\Report;

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
