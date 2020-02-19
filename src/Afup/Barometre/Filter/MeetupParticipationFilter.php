<?php

namespace Afup\Barometre\Filter;

use Afup\Barometre\Form\Type\Select2MultipleFilterType;
use Afup\BarometreBundle\Enums\MeetupParticipationEnums;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\DBAL\Query\QueryBuilder;

class MeetupParticipationFilter implements FilterInterface
{
    /**
     * @var MeetupParticipationEnums
     */
    private $meetupParticipationEnums;

    /**
     * @param MeetupParticipationEnums $meetupParticipationEnums
     */
    public function __construct(MeetupParticipationEnums $meetupParticipationEnums)
    {
        $this->meetupParticipationEnums = $meetupParticipationEnums;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), Select2MultipleFilterType::class, [
            'label'    => 'filter.meetup_participation',
            'choices'  => array_flip($this->meetupParticipationEnums->getChoices()),
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
            ->andWhere($queryBuilder->expr()->in('response.meetupParticipation', $values[$this->getName()]));
    }

    /**
     * {@inheritdoc}
     */
    public function convertValuesToLabels($value)
    {
        return array_map(function ($value) {
            return $this->meetupParticipationEnums->getLabelById($value);
        }, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'meetup_participation';
    }

    /**
     * Filter weight
     *
     * @return int
     */
    public function getWeight()
    {
        return 210;
    }
}
