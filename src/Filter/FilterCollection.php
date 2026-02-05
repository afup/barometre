<?php

declare(strict_types=1);

namespace App\Filter;

use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * A collection of filter.
 */
class FilterCollection
{
    /**
     * @var FilterInterface[]
     */
    private $filters = [];

    public function __construct(iterable $filters = [])
    {
        foreach ($filters as $filter) {
            if (isset($this->filters[$filter->getWeight()])) {
                throw new \LogicException('filter of same weight already added');
            }

            $this->filters[$filter->getWeight()] = $filter;
        }
    }

    /**
     * Get a filter by its name.
     *
     * @param string $name
     */
    public function getFilter($name)
    {
        return isset($this->filters[$name]) ? $this->filters[$name] : null;
    }

    /**
     * Build Form.
     */
    public function buildForm(FormBuilderInterface $builder): void
    {
        ksort($this->filters);
        foreach ($this->filters as $filter) {
            $filter->buildForm($builder);
        }
    }

    /**
     * Build the query with active filters.
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
