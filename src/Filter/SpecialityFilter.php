<?php

declare(strict_types=1);

namespace App\Filter;

use App\Entity\Speciality;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class SpecialityFilter implements FilterInterface
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), EntityType::class, [
            'label' => 'filter.speciality',
            'class' => Speciality::class,
            'attr' => ['class' => 'select2'],
            'multiple' => true,
            'required' => false,
            'query_builder' => function (EntityRepository $repository) {
                return $repository
                    ->createQueryBuilder('speciality')
                    ->orderBy('speciality.name', 'ASC');
            },
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery(QueryBuilder $queryBuilder, array $values = [])
    {
        if (!\array_key_exists($this->getName(), $values) || 0 === \count($values[$this->getName()])) {
            return;
        }

        $specialities = $values[$this->getName()]->toArray();
        $specialities = array_map(function (Speciality $item) {
            return $item->getId();
        }, $specialities);

        $queryBuilder
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
            ->andWhere($queryBuilder->expr()->in('speciality.id', $specialities));
    }

    /**
     * {@inheritdoc}
     */
    public function convertValuesToLabels($value)
    {
        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'specialities';
    }

    /**
     * Filter weight
     *
     * @return int
     */
    public function getWeight()
    {
        return 5;
    }
}
