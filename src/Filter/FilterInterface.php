<?php

declare(strict_types=1);

namespace App\Filter;

use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * A FilterInterface.
 */
interface FilterInterface
{
    /**
     * Add specific filter for this filter.
     */
    public function buildForm(FormBuilderInterface $builder);

    /**
     * Build the query with active filters.
     */
    public function buildQuery(QueryBuilder $queryBuilder, array $values = []);

    /**
     * Convert the given values to the corresponding labels.
     *
     * @param array $value
     */
    public function convertValuesToLabels($value);

    /**
     * The filter name.
     *
     * @return string
     */
    public function getName();

    /**
     * The filter weight - minimum mean on top of the list.
     */
    public function getWeight();
}
