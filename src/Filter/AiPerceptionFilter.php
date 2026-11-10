<?php

declare(strict_types=1);

namespace App\Filter;

use App\Enums\AiPerceptionEnums;
use App\Form\Type\Select2MultipleFilterType;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class AiPerceptionFilter implements FilterInterface
{
    public function __construct(private AiPerceptionEnums $enums)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), Select2MultipleFilterType::class, [
            'label' => 'filter.ai_perception',
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
            ->andWhere($queryBuilder->expr()->in('response.aiPerception', $values[$this->getName()]));
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
        return 'ai_perception';
    }

    /**
     * Filter weight.
     *
     * @return int
     */
    public function getWeight()
    {
        return 162;
    }
}
