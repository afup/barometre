<?php

namespace Afup\Barometre\Report;

/**
 * Report on Speciality
 */
class SpecialityReport extends AbstractReport
{
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
            ->addGroupBy('specialityName')
            ->addOrderBy('nbResponse', 'desc');

        $this->data = $this->queryBuilder->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return "speciality";
    }


    /**
     * report weight
     *
     * @return int
     */
    public function getWeight()
    {
        return 50;
    }
}
