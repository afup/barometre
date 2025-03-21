<?php

declare(strict_types=1);

namespace App\Filter;

use App\Enums\JobTitleEnums;
use App\Form\Type\Select2MultipleFilterType;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class JobTitleFilter implements FilterInterface
{
    /**
     * @var JobTitleEnums
     */
    private $jobTitles;

    public function __construct(JobTitleEnums $jobTitles)
    {
        $this->jobTitles = $jobTitles;
    }

    /**
     * Add specific filter for this filter.
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), Select2MultipleFilterType::class, [
            'label' => 'filter.job_title',
            'choices' => array_flip($this->jobTitles->getChoices()),
        ]);
    }

    /**
     * Build the query with active filters.
     */
    public function buildQuery(QueryBuilder $queryBuilder, array $values = [])
    {
        if (!\array_key_exists($this->getName(), $values) || 0 === \count($values[$this->getName()])) {
            return;
        }

        $filterValue = $values[$this->getName()];

        $filterValue = $this->supportOldValues($filterValue);

        $queryBuilder->andWhere($queryBuilder->expr()->in('response.jobTitle', $filterValue));
    }

    private function supportOldValues(array $values): array
    {
        $mapping = [
            JobTitleEnums::DEV_JUNIOR,
            JobTitleEnums::DEV_CONFIRME,
            JobTitleEnums::DEV_SENIOR,
            JobTitleEnums::DEV_EXPERT,
        ];

        $oldTitle = [
            JobTitleEnums::DEVELOPPEUR,
            JobTitleEnums::LEAD_DEVELOPPEUR,
        ];

        if ([] !== array_intersect($values, $mapping)) {
            $values = array_merge($values, $oldTitle);
        }

        return $values;
    }

    /**
     * {@inheritdoc}
     */
    public function convertValuesToLabels($value)
    {
        return array_map(function ($value) {
            return $this->jobTitles->getLabelById($value);
        }, $value);
    }

    /**
     * The filter name.
     *
     * @return string
     */
    public function getName()
    {
        return 'job_title';
    }

    /**
     * Filter weight.
     *
     * @return int
     */
    public function getWeight()
    {
        return 0;
    }
}
