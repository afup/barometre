<?php

namespace Afup\Barometre\Filter;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\DBAL\Query\QueryBuilder;

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
        $salaryBuilder = $builder->create('form');

        $salaryBuilder
            ->add('min', 'number', ['required' => false])
            ->add('max', 'number', ['required' => false]);

        $builder->add($this->getName(), $salaryBuilder);
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery(QueryBuilder $queryBuilder, array $values = array())
    {
        if (!array_key_exists('salary', $values)) {
            return;
        }

        if ($values['min']) {
            $queryBuilder
                ->andWhere('response.grossAnnualSalary >= :minSalary')
                ->setParameter('minSalary', $values['min']);
        }

        if ($values['max']) {
            $queryBuilder
                ->andWhere('response.grossAnnualSalary <= :maxSalary')
                ->setParameter('maxSalary', $values['max']);
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
