<?php

namespace Afup\Barometre\Report;

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
            ->addSelect('response.compagnySize as companySize')
            ->addGroupBy('response.compagnySize');

        return $this->queryBuilder->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'company_size'
    }
}
