<?php

namespace Afup\Barometre\Report;

use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Report on salary
 */
class SalaryReport implements ReportInterface
{

    const SLICE = 5000;

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
        $this->queryBuilder->addSelect(sprintf('ROUND(response.grossAnnualSalary / %s)  as salarySlice', self::SLICE));
        $this->queryBuilder->addGroupBy('salarySlice');

        $results = array();
        foreach ($this->queryBuilder->execute() as $row) {
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
            $result['salarySliceFrom'] = $key * self::SLICE;
            $result['salarySliceTo'] = ($key + 1) * self::SLICE;
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
