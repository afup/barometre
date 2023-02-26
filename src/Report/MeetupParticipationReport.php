<?php

declare(strict_types=1);

namespace App\Report;

use App\Enums\MeetupParticipationEnums;

class MeetupParticipationReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.meetupParticipation')
            ->addSelect('response.numberMeetupParticipation')
        ;

        $data = $this->queryBuilder->fetchAllAssociative();

        $reportData = [];

        foreach ($data as $response) {
            $meetupParticipation = $response['meetupParticipation'] ?? $this->computeMeetupParticipation($response);

            if (null === $meetupParticipation) {
                continue;
            }

            if (!isset($reportData[$meetupParticipation])) {
                $reportData[$meetupParticipation] = 0;
            }

            ++$reportData[$meetupParticipation];
        }

        foreach ($reportData as $meetupParticipation => $count) {
            if ($count <= $this->minResult) {
                continue;
            }

            $this->data[] = [
                'meetupParticipation' => $meetupParticipation,
                'nbResponse' => $count,
            ];
        }

        uasort($this->data, static function (array $experienceA, array $experienceB): int {
            return $experienceB['meetupParticipation'] <=> $experienceA['meetupParticipation'];
        });
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

    private function computeMeetupParticipation(array $response): ?int
    {
        if (null === $response['numberMeetupParticipation']) {
            return null;
        }

        if (0 === $response['numberMeetupParticipation']) {
            return MeetupParticipationEnums::NEVER;
        }

        if ($response['numberMeetupParticipation'] < 6) {
            return MeetupParticipationEnums::ONE_PER_QUARTER;
        }

        return MeetupParticipationEnums::ONE_PER_MONTH;
    }
}
