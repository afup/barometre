<?php

declare(strict_types=1);

namespace App\Filter;

use App\Enums\AiJobImpactEnums;
use App\Form\Type\Select2MultipleFilterType;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class AiJobImpactFilter implements FilterInterface
{
    public function __construct(private AiJobImpactEnums $enums)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), Select2MultipleFilterType::class, [
            'label' => 'filter.ai_job_impact',
            'choices' => array_flip($this->enums->getChoices()),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery(QueryBuilder $queryBuilder, array $values = [])
    {
        if (!\array_key_exists($this->getName(), $values) || 0 === \count($values[$this->getName()])) {
            return;
        }

        $queryBuilder
            ->andWhere($queryBuilder->expr()->in('response.aiJobImpact', $values[$this->getName()]));
    }

    /**
     * {@inheritdoc}
     */
    public function convertValuesToLabels($value)
    {
        return array_map(function ($value) {
            return $this->enums->getLabelById($value);
        }, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ai_job_impact';
    }

    /**
     * Filter weight.
     *
     * @return int
     */
    public function getWeight()
    {
        return 163;
    }
}
