<?php

namespace Afup\Barometre\Report;

use Doctrine\ORM\QueryBuilder;

/**
 * Report on company department
 */
class CompanyDepartmentReport implements ReportInterface
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
        $this->queryBuilder
            ->select('response.companyDepartment as companyDepartment')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->addGroupBy('response.companyDepartment');

        return $this->queryBuilder->getQuery()->getArrayResult();
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
}
