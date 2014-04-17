<?php

namespace Afup\Barometre\Report;

use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;

class ExperienceSalaryReport implements ReportInterface
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
            ->select('response.experience')
            ->addSelect('AVG(response.annualSalary) as annualSalary')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->having('nbResponse >= :minResult')
            ->setParameter(':minResult', $this->minResult)
            ->groupBy('response.experience');

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
     * The report name (used for url)
     *
     * @return string
     */
    public function getName()
    {
        return 'experience_salary';
    }

    /**
     * The report label (used for title & menu)
     *
     * @return string
     */
    public function getLabel()
    {
        return "report.experience_salary.label";
    }

    /**
     * {@inheritdoc}
     */
    public function hasResults()
    {
        return count($this->getData());
    }
}
