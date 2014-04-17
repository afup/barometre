<?php

namespace Afup\Barometre\Report;

use Doctrine\DBAL\Query\QueryBuilder;

abstract class AbstractReport implements ReportInterface
{
    /**
     * @var array|null
     */
    protected $data;

    /**
     * @var QueryBuilder
     */
    protected $queryBuilder;

    /**
     * @var integer
     */
    protected $minResult;

    /**
     * @param integer $minResult
     */
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
    public function getData()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return "report." . $this->getName() . ".label";
    }

    /**
     * {@inheritdoc}
     */
    public function hasResults()
    {
        return count($this->getData());
    }
}
