<?php

namespace Afup\Barometre\Report;

use Doctrine\DBAL\Query\QueryBuilder;

class VariableSalaryReport implements ReportInterface
{
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
     * Process the query
     *
     * @return array
     */
    public function getData()
    {
        return $this->queryBuilder
            ->select('response.experience')
            ->addSelect('AVG(response.grossAnnualSalary) as grossAnnualSalary')
            ->addSelect('AVG(response.variableAnnualSalary) as variableAnnualSalary')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->having('nbResponse >= :minResult')
            ->setParameter(':minResult', $minResult)
            ->groupBy('response.experience')
            ->execute();
    }

    /**
     * The report name (used for url)
     *
     * @return string
     */
    public function getName()
    {
        return 'variable_salary';
    }

    /**
     * The report label (used for title & menu)
     *
     * @return string
     */
    public function getLabel()
    {
        return "report.variable_salary.label";
    }

    /**
     * {@inheritdoc}
     */
    public function hasResults()
    {
        return count($this->getData());
    }
}
