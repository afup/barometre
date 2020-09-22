<?php

namespace Afup\Barometre\Report;

/**
 * Report on salary
 */
class SalaryReport extends AbstractReport
{

    const SLICE = 5000;

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder->select('count(distinct response.id) as nbResponse');
        $this->queryBuilder->addSelect(sprintf('ROUND(response.grossAnnualSalary / %s)  as salarySlice', self::SLICE));
        $this->queryBuilder->having('nbResponse >= :minResult');
        $this->queryBuilder->setParameter(':minResult', $this->minResult);
        $this->queryBuilder->addGroupBy('salarySlice');

        $results = array();
        foreach ($this->queryBuilder->execute() as $row) {
            $slice = $row['salarySlice'];
            $results[$slice] = array(
                'nbResponse' => $row['nbResponse'],
            );
        }

        if (0 === count($results)) {
            return $results;
        }

        $baseResult = array(
            'count' => 0,
        );

        $min = min(array_keys($results));
        $max = max(array_keys($results));


        if ($max !== $min) {
            $baseResults = array_fill($min, $max - $min, $baseResult);
        } else {
            $baseResults = array();
        }

        $results = $results + $baseResults;
        ksort($results);

        foreach ($results as $key => &$result) {
            $result['salarySliceFrom'] = $key * self::SLICE;
            $result['salarySliceTo'] = ($key + 1) * self::SLICE;
        }

        $this->data = $results;
        $this->data = $this->addPercentResponse($this->data);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'salary';
    }

    /**
     * report weight
     *
     * @return int
     */
    public function getWeight()
    {
        return 100;
    }
}
