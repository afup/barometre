<?php

namespace Afup\Barometre\Report;

class CompanySizeReport implement ReportInterface
{
    private $queryBuilder;

    public function setQueryBuilder(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    public function getData()
    {
        $this->queryBuilder
            ->select('count(distinct response.id) as count')
            ->addSelect('response.compagnySize as companySize')
            ->addGroupBy('response.compagnySize');

        return $this->queryBuilder->execute();
    }

    public function getName()
    {
        return 'company_size'
    }
}
