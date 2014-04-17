<?php

namespace Afup\Barometre\Report;

use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Report on company department
 */
class CompanyDepartmentReport implements ReportInterface
{
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
        $this->queryBuilder
            ->select('response.companyDepartment as companyDepartment')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->addSelect('AVG(response.annualSalary) as annualSalary')
            ->having('nbResponse >= :minResult')
            ->setParameter(':minResult', $this->minResult)
            ->addGroupBy('response.companyDepartment');

        $this->data = $this->queryBuilder->execute();
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
        return 'company_department';
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return "report.company_departement.label";
    }

    /**
     * {@inheritdoc}
     */
    public function hasResults()
    {
        return count($this->getData());
    }
}
