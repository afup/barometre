<?php

namespace Afup\Barometre\Report;

use Doctrine\ORM\QueryBuilder;

/**
 * Report on Speciality
 */
class SpecialityReport implements ReportInterface
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
            ->select('speciality.name as specialityName')
            ->addSelect('COUNT(DISTINCT response.id) as nbResponse')
            ->addGroupBy('speciality.name');

        return $this->queryBuilder->getQuery()->getArrayResult();
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
