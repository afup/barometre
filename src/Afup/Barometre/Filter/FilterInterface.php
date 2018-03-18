<?php

namespace Afup\Barometre\Filter;

use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * A FilterInterface
 */
interface FilterInterface
{
    /**
     * Add specific filter for this filter
     *
     * @param FormBuilderInterface $builder
     */
    public function buildForm(FormBuilderInterface $builder);

    /**
     * Build the query with active filters
     *
     * @param QueryBuilder $queryBuilder
     * @param array        $values
     */
    public function buildQuery(QueryBuilder $queryBuilder, array $values = []);

    /**
     * Convert the given values to the corresponding labels
     *
     * @param array $value
     */
    public function convertValuesToLabels($value);

    /**
     * The filter name
     *
     * @return string
     */
    public function getName();

    /**
     * The filter weight - minimum mean on top of the list
     *
     * @return mixed
     */
    public function getWeight();
}
