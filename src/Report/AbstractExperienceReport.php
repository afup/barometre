<?php

declare(strict_types=1);

namespace App\Report;

use App\Trait\ExperienceComputer;

abstract class AbstractExperienceReport extends AbstractReport
{
    use ExperienceComputer;

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.experience')
            ->addSelect('response.experienceInYear')
            ->addSelect('response.'.$this->getColumn())
        ;

        $data = $this->queryBuilder->fetchAllAssociative();

        $reportData = [];

        foreach ($data as $response) {
            $experience = $this->computeExperience($response);

            if (!isset($reportData[$experience])) {
                $reportData[$experience] = [];
            }
            $reportData[$experience][] = $response[$this->getColumn()];
        }

        foreach ($reportData as $experience => $dataInColumn) {
            if (\count($dataInColumn) <= $this->minResult) {
                continue;
            }

            $this->data[] = [
                'experience' => $experience,
                $this->getColumn() => array_sum($dataInColumn) / \count($dataInColumn),
                'nbResponse' => \count($dataInColumn),
            ];
        }

        if (null === $this->data) {
            $this->data = [];
        }

        uasort($this->data, static function (array $experienceA, array $experienceB): int {
            return $experienceA['experience'] <=> $experienceB['experience'];
        });
    }

    abstract protected function getColumn(): string;
}
