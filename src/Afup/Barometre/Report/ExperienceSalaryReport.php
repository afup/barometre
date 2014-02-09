<?php

namespace Afup\Barometre\Report;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;

class ExperienceSalaryReport implements ReportInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var QueryBuilder
     */
    private $queryBuilder;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function setQueryBuilder(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * Process the query
     *
     * @return array
     */
    public function getData()
    {
        $queryBuilder = $this->queryBuilder->select('DISTINCT response.id');

        $reportQueryBuilder = $this->entityManager->createQueryBuilder();

        $reportQueryBuilder
            ->from('AfupBarometreBundle:Response', 'r')
            ->where(
                $reportQueryBuilder->expr()->in('r.id', $queryBuilder->getDQL())
            )
            ->select('r.experience')
            ->addSelect('AVG(r.annualSalary) as annualSalary')
            ->addSelect('COUNT(r.id) as nbResponse')
            ->groupBy('r.experience');

        return $reportQueryBuilder->getQuery()->getArrayResult();
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
}
