<?php

namespace Afup\Barometre\Report;

use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Report on company Type
 */
class CompanyTypeReport implements ReportInterface
{
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
            ->select('count(distinct response.id) as count')
            ->addSelect('response.companyType as companyType')
            ->addGroupBy('response.companyType');

        return $this->queryBuilder->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'company_type';
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return "Distribution des types d'entreprises";
    }
}
