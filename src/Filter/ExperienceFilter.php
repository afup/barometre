<?php

declare(strict_types=1);

namespace App\Filter;

use App\Enums\ExperienceEnums;
use App\Form\Type\Select2MultipleFilterType;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class ExperienceFilter implements FilterInterface
{
    /**
     * @var ExperienceEnums
     */
    private $experience;

    public function __construct(ExperienceEnums $experience)
    {
        $this->experience = $experience;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), Select2MultipleFilterType::class, [
            'label' => 'filter.experience',
            'choices' => array_flip($this->experience->getChoices()),
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
            ->andWhere($queryBuilder->expr()->in('response.experience', $values[$this->getName()]));
    }

    /**
     * {@inheritdoc}
     */
    public function convertValuesToLabels($value)
    {
        return array_map(function ($value) {
            return $this->experience->getLabelById($value);
        }, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'experience';
    }

    /**
     * Filter weight
     *
     * @return int
     */
    public function getWeight()
    {
        return 1;
    }
}
