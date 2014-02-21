<?php

namespace Afup\Barometre\Filter;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\DBAL\Query\QueryBuilder;

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
            ->andWhere($queryBuilder->expr()->in('response.companyDepartment', $values[$this->getName()]));
    }

    /**
     * {@inheritdoc}
     */
    public function convertValuesToLabels($value)
    {
        $departements = new Departments();

        return array_map(function ($code) use ($departements) {
            return $departements->getLabel($code);
        }, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'departement';
    }

    /**
     * Filter weight
     *
     * @return int
     */
    public function getWeight()
    {
        return 2;
    }
}
