<?php

declare(strict_types=1);

namespace App\Report;

/**
 * Report on salary.
 */
class SalaryReport extends AbstractReport
{
    public const SLICE = 5000;

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder->select('count(distinct response.id) as nbResponse');
        $this->queryBuilder->addSelect(sprintf('ROUND(response.grossAnnualSalary / %s)  as salarySlice', self::SLICE));
        $this->queryBuilder->having('nbResponse >= :minResult');
        $this->queryBuilder->setParameter('minResult', $this->minResult);
        $this->queryBuilder->addGroupBy('salarySlice');

        $results = [];
        foreach ($this->queryBuilder->fetchAllAssociative() as $row) {
            $slice = $row['salarySlice'];
            $results[$slice] = [
                'count' => $row['nbResponse'],
            ];
        }

        if (0 === \count($results)) {
            return $results;
        }

        $baseResult = [
            'count' => 0,
        ];

        $min = min(array_keys($results));
        $max = max(array_keys($results));

        if ($max !== $min) {
            $baseResults = array_fill($min, $max - $min, $baseResult);
        } else {
            $baseResults = [];
        }

        $results = $results + $baseResults;
        ksort($results);

        foreach ($results as $key => &$result) {
            $result['salarySliceFrom'] = $key * self::SLICE;
            $result['salarySliceTo'] = ($key + 1) * self::SLICE;
        }

        $this->data = $results;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'salary';
    }

    /**
     * report weight.
     *
     * @return int
     */
    public function getWeight()
    {
        return 100;
    }
}
