<?php

declare(strict_types=1);

namespace App\Report;

class MeetupParticipationReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.meetupParticipation')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->having('nbResponse >= :minResult')
            ->setParameter('minResult', $this->minResult)
            ->groupBy('response.meetupParticipation')
            ->orderBy('nbResponse', 'desc');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'meetup_participation';
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
