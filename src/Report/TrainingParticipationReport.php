<?php

declare(strict_types=1);

namespace App\Report;

class TrainingParticipationReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.hasRecentTraining')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->having('nbResponse >= :minResult')
            ->setParameter('minResult', $this->minResult)
            ->groupBy('response.hasRecentTraining')
            ->orderBy('nbResponse', 'desc')
        ;

        foreach ($this->queryBuilder->fetchAllAssociative() as $row) {
            $this->data['has_training'][$row['hasRecentTraining']] = $row['nbResponse'];
        }

        $this->queryBuilder
            ->select('response.isRecentTrainingHadSalaryImpact as isTrainingHadSalaryImpact')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->where('hasRecentTraining = 1')
            ->having('nbResponse >= :minResult')
            ->setParameter('minResult', $this->minResult)
            ->groupBy('response.isRecentTrainingHadSalaryImpact')
            ->orderBy('nbResponse', 'desc')
        ;

        foreach ($this->queryBuilder->fetchAllAssociative() as $row) {
            $this->data['is_training_has_salary_impact'][$row['isTrainingHadSalaryImpact']] = $row['nbResponse'];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'training_participation';
    }

    /**
     * report weight.
     *
     * @return int
     */
    public function getWeight()
    {
        return -30;
    }
}
