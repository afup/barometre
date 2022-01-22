<?php

declare(strict_types=1);

namespace App\Filter;

use App\Enums\StatusEnums;
use App\Form\Type\Select2MultipleFilterType;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class StatusFilter implements FilterInterface
{
    /**
     * @var StatusEnums
     */
    private $status;

    public function __construct(StatusEnums $status)
    {
        $this->status = $status;
    }

    /**
     * Add specific filter for this filter
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), Select2MultipleFilterType::class, [
            'label' => 'filter.status',
            'choices' => array_flip($this->status->getChoices()),
        ]);
    }

    /**
     * Build the query with active filters
     */
    public function buildQuery(QueryBuilder $queryBuilder, array $values = [])
    {
        if (!\array_key_exists($this->getName(), $values) || 0 === \count($values[$this->getName()])) {
            return;
        }

        $queryBuilder->andWhere($queryBuilder->expr()->in('response.status', $values[$this->getName()]));
    }

    /**
     * {@inheritdoc}
     */
    public function convertValuesToLabels($value)
    {
        return array_map(function ($value) {
            return $this->status->getLabelById($value);
        }, $value);
    }

    /**
     * The filter name
     *
     * @return string
     */
    public function getName()
    {
        return 'status';
    }

    /**
     * Filter weight
     *
     * @return int
     */
    public function getWeight()
    {
        return 4;
    }
}
