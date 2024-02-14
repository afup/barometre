<?php

namespace App\Report;

class ExperienceInCurrentJobReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'experience_in_current_job';
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.experienceInCurrentJob')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->having('nbResponse >= :minResult')
            ->setParameter('minResult', $this->minResult)
            ->groupBy('response.experienceInCurrentJob')
            ->orderBy('experienceInCurrentJob', 'asc');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }
}
