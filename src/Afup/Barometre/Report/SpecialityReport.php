<?php

namespace Afup\Barometre\Report;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Report on Speciality
 */
class SpecialityReport implements ReportInterface
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
     * {@inheritdoc}
     */
    public function getData()
    {
        $queryBuilder = $this->queryBuilder->select('DISTINCT response.id');

        $reportQueryBuilder = $this->entityManager->createQueryBuilder();

        $reportQueryBuilder
            ->select('s.name as specialityName')
            ->addSelect('COUNT(r.id) as nbResponse')
            ->from('AfupBarometreBundle:Response', 'r')
            ->leftJoin('r.specialities', 's')
            ->where(
                $reportQueryBuilder->expr()->in('r.id', $queryBuilder->getDQL())
            )
            ->groupBy('s.name');

        return $reportQueryBuilder->getQuery()->getArrayResult();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return "speciality";
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return "report.speciality.label";
    }
}
