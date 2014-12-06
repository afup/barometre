<?php
/**
 * Gender Filter
 */

namespace Afup\Barometre\Filter;

use Afup\Barometre\Form\Type\Select2MultipleFilterType;
use Afup\BarometreBundle\Enums\GenderEnums;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Form\FormBuilderInterface;


/**
 * Class GenderFilter
 * @package Afup\Barometre\Filter
 */
class GenderFilter implements FilterInterface
{

    /**
     * @var GenderEnums
     */
    private $gender;

    /**
     * @param GenderEnums $gender
     */
    public function __construct(GenderEnums $gender)
    {
        $this->gender = $gender;
    }

    /**
     * Build the query with active filters
     *
     * @param QueryBuilder $queryBuilder
     * @param array        $values
     */
    public function buildQuery(QueryBuilder $queryBuilder, array $values = [])
    {
        $values[$this->getName()] = array_filter($values[$this->getName()], 'strlen' );

        if (!array_key_exists($this->getName(), $values) || 0 === count($values[$this->getName()])) {
            return;
        }

        $queryBuilder->andWhere($queryBuilder->expr()->in('response.gender', $values[$this->getName()]));
    }

    /**
     * Add specific filter for this filter
     *
     * @param FormBuilderInterface $builder
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), new Select2MultipleFilterType(), [
                'label'   => 'filter.gender',
                'choices' => $this->gender->getChoices(),
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function convertValuesToLabels($value)
    {
        return array_map(function ($value) {
                return $this->gender->getLabelById($value);
            }, $value);
    }

    /**
     * Filter weight
     *
     * @return int
     */
    public function getWeight()
    {
        return 100;
    }


    /**
     * The filter name
     *
     * @return string
     */
    public function getName()
    {
        return 'gender';
    }
} 