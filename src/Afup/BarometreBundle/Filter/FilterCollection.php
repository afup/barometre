<?php

namespace Afup\BarometreBundle\Filter;

class FilterCollection
{
    /**
     * @var array
     */
    protected $filters = array();

    /**
     * @param FilterInterface $filter
     * @param string          $alias
     */
    public function addFilter(FilterInterface $filter, $alias)
    {
        $this->filters[$alias] = $filter;
    }

    /**
     * @param $alias
     *
     * @throws \InvalidArgumentException
     *
     * @return FilterInterface
     */
    public function getFilter($alias)
    {
        if (!isset($this->filters[$alias])) {
            throw new \InvalidArgumentException(sprintf("Unknown filter '%s'", $alias));
        }

        return $this->filters[$alias];
    }

    /**
     * @return FilterInterface[]
     */
    public function getAll()
    {
        return $this->filters;
    }
}
