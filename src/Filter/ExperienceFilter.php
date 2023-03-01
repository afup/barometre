<?php

declare(strict_types=1);

namespace App\Filter;

use App\Enums\ExperienceEnums;
use App\Form\Type\Select2MultipleFilterType;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class ExperienceFilter implements FilterInterface
{
    public function __construct(private readonly ExperienceEnums $experience)
    {
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

        if (\count($values[$this->getName()]) === \count($this->experience->getChoices())) {
            return;
        }

        $conditions = [];
        foreach ($values[$this->getName()] as $enum) {
            $conditions[] = match ($enum) {
                ExperienceEnums::XP_0_2 => $queryBuilder->expr()->lt('response.experienceInYear', 2),
                ExperienceEnums::XP_2_5 => $queryBuilder->expr()->and($queryBuilder->expr()->gte('response.experienceInYear', 2), $queryBuilder->expr()->lt('response.experienceInYear', 5)),
                ExperienceEnums::XP_5_10 => $queryBuilder->expr()->and($queryBuilder->expr()->gte('response.experienceInYear', 5), $queryBuilder->expr()->lt('response.experienceInYear', 10)),
                ExperienceEnums::XP_10 => $queryBuilder->expr()->gte('response.experienceInYear', 10),
            };
        }
        $queryBuilder->andWhere(
            $queryBuilder->expr()->or(
                $queryBuilder->expr()->isNull('response.experienceInYear'),
                ...$conditions,
            )
        );

        $queryBuilder->andWhere(
            $queryBuilder->expr()->or(
                $queryBuilder->expr()->isNull('response.experience'),
                $queryBuilder->expr()->in('response.experience', $values[$this->getName()])
            )
        );
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
     * Filter weight.
     *
     * @return int
     */
    public function getWeight()
    {
        return 1;
    }
}
