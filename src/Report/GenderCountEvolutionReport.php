<?php

declare(strict_types=1);

namespace App\Report;

class GenderCountEvolutionReport extends AbstractDistributionEvolutionReport
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'gender_count_evolution';
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

    /**
     * {@inheritdoc}
     */
    protected function getFieldName()
    {
        return 'gender';
    }
}
