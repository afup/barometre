<?php

namespace Afup\Barometre\Filter;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\DBAL\Query\QueryBuilder;

class FilterCollection implements FilterInterface
{
    private $filters = array();

    public function addFilter(FilterInterface $filter)
    {
        $this->filters[$filter->getName()] = $filter;
    }

    public function buildForm(FormBuilderInterface $builder)
    {
        foreach ($this->filters as $filter) {
            $filter->buildForm($formBuilder);
        }

        return $formBuilder->getForm();
    }

    public function buildQuery(QueryBuilder $queryBuilder, array $values = array())
    {
        foreach ($this->filters as $filter) {
            $filter->buildQuery($queryBuilder, $values);
        }
    }

    public function getName()
    {
        return 'collection';
    }
}
