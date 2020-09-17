<?php

declare(strict_types=1);

namespace Afup\Barometre\Filter;

use Afup\Barometre\Form\Type\Select2MultipleFilterType;
use Afup\BarometreBundle\Enums\JobTitleEnums;
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
     * Add specific filter for this filter
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), Select2MultipleFilterType::class, [
            'label' => 'filter.job_title',
            'choices' => array_flip($this->jobTitles->getChoices()),
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

        $queryBuilder->andWhere($queryBuilder->expr()->in('response.jobTitle', $values[$this->getName()]));
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
     * The filter name
     *
     * @return string
     */
    public function getName()
    {
        return 'job_title';
    }

    /**
     * Filter weight
     *
     * @return int
     */
    public function getWeight()
    {
        return 0;
    }
}
