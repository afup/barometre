<?php

namespace Afup\Barometre\Report;

use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Report on company Type
 */
class CompanyTypeReport implements ReportInterface
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
            ->select('response.companyType as companyType')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->addGroupBy('response.companyType');

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
        return 'company_type';
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return "report.company_type.label";
    }

    /**
     * {@inheritdoc}
     */
    public function hasResults()
    {
        return count($this->getData());
    }
}
