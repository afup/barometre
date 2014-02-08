<?php

namespace Afup\Barometre\Filter;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\QueryBuilder;

class SpecialityFilter implements FilterInterface
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), 'entity', [
            'label'    => 'filter.speciality',
            'class'    => 'Afup\BarometreBundle\Entity\Speciality',
            'attr'     => ['class' => 'select2'],
            'multiple' => true,
            'required' => false,
            'query_builder' => function (EntityRepository $repository) {
                return $repository
                    ->createQueryBuilder('speciality')
                    ->orderBy('speciality.name', 'ASC');
            }
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery(QueryBuilder $queryBuilder, array $values = array())
    {
        if (!array_key_exists($this->getName(), $values) || 0 === count($values[$this->getName()])) {
            return;
        }

        $specialities = $values[$this->getName()]->toArray();
        $specialities = array_map(function ($item) {
            return $item->getId();
        }, $specialities);

        $queryBuilder
            ->andWhere($queryBuilder->expr()->in('speciality.id', $specialities));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'specialities';
    }
}
