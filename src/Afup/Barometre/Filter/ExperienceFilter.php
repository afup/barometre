<?php

namespace Afup\Barometre\Filter;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\DBAL\Query\QueryBuilder;

use Afup\BarometreBundle\Enums\ExperienceEnums;
use Afup\Barometre\Form\Type\Select2MultipleFilterType;

class ExperienceFilter implements FilterInterface
{
    /**
     * @var ExperienceEnums
     */
    private $experience;

    /**
     * @param ExperienceEnums $experience
     */
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
            'label'    => 'filter.experience',
            'choices'  => array_flip($this->experience->getChoices()),
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
