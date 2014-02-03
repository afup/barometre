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

        if ($values['salary']['min']) {
            $queryBuilder
                ->andWhere('response.grossAnnualSalary >= :minSalary')
                ->setParameter('minSalary', $values['salary']['min']);
        }

        if ($values['salary']['max']) {
            $queryBuilder
                ->andWhere('response.grossAnnualSalary <= :maxSalary')
                ->setParameter('maxSalary', $values['salary']['max']);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'salary';
    }
}
