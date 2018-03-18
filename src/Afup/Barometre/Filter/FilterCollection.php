<?php

namespace Afup\Barometre\Filter;

use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * A collection of filter
 */
class FilterCollection
{
    /**
     * @param iterable|FilterInterface[] $filters
     */
    public function __construct($filters)
    {
        foreach ($filters as $filter) {
            $this->filters[$filter->getWeight()] = $filter;
        }

        ksort($this->filters);
    }

    /**
     * @var FilterInterface[]
     */
    private $filters = [];

    /**
     * Get a filter by its name
     *
     * @param string $name
     */
    public function getFilter($name)
    {
        return isset($this->filters[$name]) ? $this->filters[$name] : null;
    }

    /**
     * Build Form
     *
     * @param FormBuilderInterface $builder
     *
     * @return FormInterface
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        foreach ($this->filters as $filter) {
            $filter->buildForm($builder);
        }
    }

    /**
     * Build the query with active filters
     *
     * @param QueryBuilder $queryBuilder
     * @param array        $values
     */
    public function buildQuery(QueryBuilder $queryBuilder, array $values = [])
    {
        foreach ($this->filters as $filter) {
            $filter->buildQuery($queryBuilder, $values);
        }
    }

    public function convertValuesToLabels($value)
    {
        $labels = [];
        foreach ($this->filters as $filter) {
            $name = $filter->getName();
            if (isset($value[$name])) {
                $labels[$name] = $filter->convertValuesToLabels($value[$name]);
            }
        }

        return $labels;
    }

    public function getName()
    {
        return 'collection';
    }
}
