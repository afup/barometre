<?php

namespace Afup\Barometre\Filter;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\DBAL\Query\QueryBuilder;

use Afup\BarometreBundle\Enums\JobTitleEnums;
use Afup\Barometre\Form\Type\Select2MultipleFilterType;

class JobTitleFilter implements FilterInterface
{
    /**
     * @var JobTitleEnums
     */
    private $jobTitle;

    /**
     * @param JobTitleEnums $jobTitle
     */
    public function __construct(JobTitleEnums $jobTitle)
    {
        $this->jobTitle = $jobTitle;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), new Select2MultipleFilterType(), [
            'label'    => 'filter.job_title',
            'choices'  => $this->jobTitle->getChoices()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery(QueryBuilder $queryBuilder, array $values = array())
    {
        if (!array_key_exists($this->getName(), $values) || 0 === count($values[$this->getName()])) {
            return;
        }

        $queryBuilder
            ->andWhere($queryBuilder->expr()->in('response.jobTitle', $values[$this->getName()]));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'job_title';
    }
}
