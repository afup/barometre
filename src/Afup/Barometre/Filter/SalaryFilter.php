<?php

namespace Afup\Barometre\Filter;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\DBAL\Query\QueryBuilder;

class SalaryFilter implements FilterInterface
{
    public function buildForm(FormBuilderInterface $builder)
    {
        $salaryBuilder = $builder->create('form');

        $salaryBuilder
            ->add('min', 'number', ['required' => false])
            ->add('max', 'number', ['required' => false]);

        $builder->add($this->getName(), $salaryBuilder);
    }

    public function buildQuery(QueryBuilder $queryBuilder, array $values = array())
    {
        if (array_key_exists('salary', $values)) {
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
    }

    public function getName()
    {
        return 'salary';
    }
}
