<?php

namespace Afup\Barometre\Filter;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Connection;
use agallou\Departements\Collection as Departments;

use Afup\Barometre\Form\Type\Select2MultipleFilterType;

class DepartmentFilter implements FilterInterface
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $choices = array();
        foreach (new Departments() as $number => $label) {
            $choices[$number] = sprintf('%s - %s', $number, $label);
        }
        $builder->add($this->getName(), new Select2MultipleFilterType(), [
            'label'    => 'filter.department',
            'choices'  => $choices,
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

        $queryBuilder
            ->setParameter('department', $values[$this->getName()], Connection::PARAM_STR_ARRAY)
            ->andWhere('response.companyDepartment IN(:department)')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'departement';
    }
}
