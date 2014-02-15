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
        $builder->add($this->getName(), new Select2MultipleFilterType(), [
            'label'    => 'filter.experience',
            'choices'  => $this->experience->getChoices()
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
    public function getName()
    {
        return 'experience';
    }
}
