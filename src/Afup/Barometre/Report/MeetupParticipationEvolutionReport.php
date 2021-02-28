<?php
declare(strict_types=1);

namespace Afup\Barometre\Report;

class MeetupParticipationEvolutionReport extends AbstractDistributionEvolutionReport
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'meetup_participation_evolution';
    }

    /**
     * {@inheritdoc}
     */
    protected function getFieldName()
    {
        return 'meetupParticipation';
    }
}
