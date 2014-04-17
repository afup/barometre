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
     * @var array|null
     */
    private $data;

    /**
     * @var QueryBuilder
     */
    private $queryBuilder;

    /**
     * @var integer
     */
    private $minResult;

    public function __construct($minResult = 10)
    {
        $this->minResult = $minResult;
    }

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


        if ($max != $min) {
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
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->data;
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

    /**
     * {@inheritdoc}
     */
    public function hasResults()
    {
        return count($this->getData());
    }
}
