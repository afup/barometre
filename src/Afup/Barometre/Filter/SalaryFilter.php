<?php

namespace Afup\Barometre\Filter;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\DBAL\Query\QueryBuilder;

use Afup\Barometre\Form\Type\SalaryFilterType;

/**
 * Filter on Salary Min & max
 */
class SalaryFilter implements FilterInterface
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add(
            'salary',
            new SalaryFilterType(),
            [
                'label' => 'filter.salary',
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery(QueryBuilder $queryBuilder, array $values = array())
    {
        if (!array_key_exists('salary', $values)) {
            return;
        }

        //Switch min and max salary if user has inverted the fields
        if (isset($values['salary']['min'])
            && isset($values['salary']['max'])
            && $values['salary']['max'] < $values['salary']['min']
            ) {
            list($values['salary']['min'], $values['salary']['max']) =
                [$values['salary']['max'], $values['salary']['min']];
        }

        if (isset($values['salary']['min'])) {
            $queryBuilder
                ->andWhere('response.grossAnnualSalary >= :minSalary')
                ->setParameter('minSalary', $values['salary']['min']);
        }

        if (isset($values['salary']['max'])) {
            $queryBuilder
                ->andWhere('response.grossAnnualSalary <= :maxSalary')
                ->setParameter('maxSalary', $values['salary']['max']);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function convertValuesToLabels($value)
    {
        //Switch min and max if user has inverted the fields
        if (isset($value['min']) && isset($value['max']) && $value['max'] < $value['min']) {
            list($value['max'], $value['min']) = [$value['min'], $value['max']];
        }

        $labels = [];
        if (isset($value['min'])) {
            $labels['min'] = '>= '.$value['min'];
        }

        if (isset($value['max'])) {
            $labels['max'] = '<= '.$value['max'];
        }

        return $labels;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'salary';
    }

    /**
     * Filter weight
     *
     * @return int
     */
    public function getWeight()
    {
        return 3;
    }
}
