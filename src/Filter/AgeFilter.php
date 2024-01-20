<?php

declare(strict_types=1);

namespace App\Filter;

use App\Form\Type\AgeFilterType;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Filter on Age Min & max.
 */
class AgeFilter implements FilterInterface
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add('age', AgeFilterType::class, [
                'label' => 'filter.age',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery(QueryBuilder $queryBuilder, array $values = [])
    {
        if (!\array_key_exists('age', $values)) {
            return;
        }

        // Switch min and max age if user has inverted the fields
        if (isset($values['age']['min'])
            && isset($values['age']['max'])
            && $values['age']['max'] < $values['age']['min']
        ) {
            list($values['age']['min'], $values['age']['max']) =
                [$values['age']['max'], $values['age']['min']];
        }

        if (isset($values['age']['min'])) {
            $queryBuilder
                ->andWhere('response.age >= :minAge')
                ->setParameter('minAge', $values['age']['min']);
        }

        if (isset($values['age']['max'])) {
            $queryBuilder
                ->andWhere('response.age <= :maxAge')
                ->setParameter('maxAge', $values['age']['max']);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function convertValuesToLabels($value)
    {
        // Switch min and max if user has inverted the fields
        if (isset($value['min']) && isset($value['max']) && $value['max'] < $value['min']) {
            list($value['max'], $value['min']) = [$value['min'], $value['max']];
        }

        $labels = [];
        if (isset($value['min'])) {
            $labels['min'] = '>= '.$value['min'].' ans';
        }

        if (isset($value['max'])) {
            $labels['max'] = '<= '.$value['max'].' ans';
        }

        return $labels;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'age';
    }

    /**
     * Filter weight.
     *
     * @return int
     */
    public function getWeight()
    {
        return 11;
    }
}
