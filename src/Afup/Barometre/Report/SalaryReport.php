<?php

namespace Afup\Barometre\Report;

use Doctrine\ORM\QueryBuilder;

/**
 * Report on salary
 */
class SalaryReport implements ReportInterface
{
    /**
     * @var QueryBuilder
     */
    private $queryBuilder;

    /**
     * {@inheritdoc}
     */
    public function setQueryBuilder(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $this->queryBuilder->select('count(distinct response.id) as nbResponse');
        $this->queryBuilder->addSelect('ROUND(response.annualSalary / 1000)  as salarySlice');
        $this->queryBuilder->addGroupBy('response.salarySlice');

        $results = array();
        foreach ($this->queryBuilder->getQuery()->getArrayResult() as $row) {
            $slice = $row['salarySlice'];
            $results[$slice] = array(
               'count' => $row['nbResponse']
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
        $baseResults = array_fill($min, $max - $min, $baseResult);

        $results = $results + $baseResults;
        ksort($results);

        foreach ($results as $key => &$result) {
            $result['salarySliceFrom'] = $key * 1000;
            $result['salarySliceTo'] = ($key + 1) * 1000;
        }

        return $results;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'salary';
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return "report.salary.label";
    }
}
