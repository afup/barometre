<?php

namespace Afup\Barometre\Filter;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\DBAL\Query\QueryBuilder;

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
    public function buildQuery(QueryBuilder $queryBuilder, array $values = array());

    /**
     * Convert the given values to the corresponding labels
     *
     * @param array $values
     */
    public function convertValuesToLabels($value);

    /**
     * The filter name
     *
     * @return string
     */
    public function getName();
}
