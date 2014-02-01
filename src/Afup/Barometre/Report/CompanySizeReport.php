<?php

namespace Afup\Barometre\Report;

use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Report on company size
 */
class CompanySizeReport implements ReportInterface
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
            ->addSelect('response.companySize as companySize')
            ->addGroupBy('response.companySize');

        return $this->queryBuilder->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'company_size';
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return "Distribution des tailles d'entreprises";
    }
}
