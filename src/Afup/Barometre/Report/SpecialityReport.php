<?php

namespace Afup\Barometre\Report;

use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;

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
     * @var array|null
     */
    private $data;

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
            ->select('count(distinct response.id) as nbResponse')
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
            ->addSelect('speciality.name as specialityName')
            ->addGroupBy('specialityName');

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
        return "speciality";
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return "report.speciality.label";
    }

    /**
     * {@inheritdoc}
     */
    public function hasResults()
    {
        return count($this->getData());
    }
}
