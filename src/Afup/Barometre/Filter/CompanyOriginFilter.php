<?php

namespace Afup\Barometre\Filter;

use Afup\Barometre\Form\Type\Select2MultipleFilterType;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class CompanyOriginFilter implements FilterInterface
{

    /**
     * Add specific filter for this filter
     *
     * @param FormBuilderInterface $builder
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), new Select2MultipleFilterType(), [
            'label'    => 'filter.company_origin',
            'choices'  => [], // TODO retrieve choice from answers
        ]);
    }

    /**
     * Build the query with active filters
     *
     * @param QueryBuilder $queryBuilder
     * @param array $values
     */
    public function buildQuery(QueryBuilder $queryBuilder, array $values = array())
    {
        if (!array_key_exists($this->getName(), $values) || 0 === count($values[$this->getName()])) {
            return;
        }

        $queryBuilder
            ->andWhere($queryBuilder->expr()->in('response.companyOrigin', $values[$this->getName()]));
    }

    /**
     * Convert the given values to the corresponding labels
     *
     * @param array $value
     */
    public function convertValuesToLabels($value)
    {
        // TODO: Implement convertValuesToLabels() method.
    }

    /**
     * The filter name
     *
     * @return string
     */
    public function getName()
    {
        return 'company_origin';
    }

    /**
     * The filter weight - minimum mean on top of the list
     *
     * @return mixed
     */
    public function getWeight()
    {
        return 500;
    }
}
