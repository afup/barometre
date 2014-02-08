<?php

namespace Afup\Barometre\Report;

use Doctrine\ORM\QueryBuilder;

/**
 * Report on company size
 */
class CompanySizeReport implements ReportInterface
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
            ->select('response.companySize as companySize')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->addGroupBy('response.companySize');

        return $this->queryBuilder->getQuery()->getArrayResult();
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
        return "report.company_size.label";
    }
}
