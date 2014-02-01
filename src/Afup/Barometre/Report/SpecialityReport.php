<?php

namespace Afup\Barometre\Report;

use Doctrine\DBAL\Query\QueryBuilder;

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
            ->select('count(distinct response.id) as count')
            ->join(
                'response',
                'response_speciality',
                'response_speciality',
                'response.id = response_speciality.response_id'
            )
            ->join(
                'response_speciality',
                'speciality',
                'speciality',
                'response_speciality.speciality_id = speciality.id'
            )
            ->addSelect('speciality.name as speciality')
            ->addGroupBy('speciality.name');

        $results = array();

        foreach ($this->queryBuilder->execute() as $row) {
            $results[] = $row;
        }

        return $results;
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
        return "Distribution des spécialités";
    }
}
