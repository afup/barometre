<?php

declare(strict_types=1);

namespace App\Report;

use App\Enums\MeetupParticipationEnums;

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

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('campaign.name')
            ->addSelect('response.meetupParticipation')
            ->addSelect('response.numberMeetupParticipation')
            ->join('response', 'campaign', 'campaign', 'response.campaign_id = campaign.id')
        ;

        $data = [];
        $reportData = [];
        $allStatus = [];

        foreach ($this->queryBuilder->fetchAllAssociative() as $response) {
            if (null === $response['meetupParticipation'] && null === $response['numberMeetupParticipation']) {
                continue;
            }

            $meetupParticipation = $response['meetupParticipation'] ?? $this->computeMeetupParticipation($response);

            if (null === $meetupParticipation) {
                continue;
            }

            $allStatus[$meetupParticipation] = 0;
            if (!isset($reportData[$response['name']][$meetupParticipation])) {
                $reportData[$response['name']][$meetupParticipation] = 0;
            }

            ++$reportData[$response['name']][$meetupParticipation];
        }

        foreach ($reportData as $campaignId => $values) {
            $reportData[$campaignId] = $values + $allStatus;
            ksort($reportData[$campaignId]);
        }

        ksort($allStatus);

        if (\count($reportData)) {
            $this->data = [
                'data' => $reportData,
                'columns' => array_keys($allStatus),
            ];
        }
    }

    private function computeMeetupParticipation(array $response): ?int
    {
        if (null === $response['numberMeetupParticipation']) {
            return null;
        }

        if (0 === $response['numberMeetupParticipation']) {
            return MeetupParticipationEnums::NEVER;
        }

        if ($response['numberMeetupParticipation'] < 12) {
            return MeetupParticipationEnums::ONE_PER_QUARTER;
        }

        return MeetupParticipationEnums::ONE_PER_MONTH;
    }
}
