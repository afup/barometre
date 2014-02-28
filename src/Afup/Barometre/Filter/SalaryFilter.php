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
        if (null !== $value['min']) {
            $value['min'] = '>= '.$value['min'];
        }

        if (null !== $value['max']) {
            $value['max'] = '<= '.$value['max'];
        }

        return $value;
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
