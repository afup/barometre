<?php

declare(strict_types=1);
/**
 * Gender Filter.
 */

namespace App\Filter;

use App\Enums\GenderEnums;
use App\Form\Type\Select2MultipleFilterType;
use Doctrine\DBAL\Query\Expression\CompositeExpression;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class GenderFilter.
 */
class GenderFilter implements FilterInterface
{
    /**
     * @var GenderEnums
     */
    private $gender;

    public function __construct(GenderEnums $gender)
    {
        $this->gender = $gender;
    }

    /**
     * Build the query with active filters.
     */
    public function buildQuery(QueryBuilder $queryBuilder, array $values = [])
    {
        if (!\array_key_exists($this->getName(), $values) || 0 === \count($values[$this->getName()])) {
            return;
        }

        $condition = array_map(
            static function ($value) use ($queryBuilder) {
                if ('' === $value) {
                    return $queryBuilder->expr()->isNull('response.gender');
                }

                return $queryBuilder->expr()->eq('response.gender', $value);
            },
            $values[$this->getName()]
        );

        $queryBuilder->andWhere(
            new CompositeExpression(CompositeExpression::TYPE_OR, $condition)
        );
    }

    /**
     * Add specific filter for this filter.
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), Select2MultipleFilterType::class, [
            'label' => 'filter.gender',
            'choices' => array_flip($this->gender->getChoices()),
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
     * Filter weight.
     *
     * @return int
     */
    public function getWeight()
    {
        return 100;
    }

    /**
     * The filter name.
     *
     * @return string
     */
    public function getName()
    {
        return 'gender';
    }
}
