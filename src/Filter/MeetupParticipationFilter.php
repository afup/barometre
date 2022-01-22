<?php

declare(strict_types=1);

namespace App\Filter;

use App\Enums\MeetupParticipationEnums;
use App\Form\Type\Select2MultipleFilterType;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class MeetupParticipationFilter implements FilterInterface
{
    /**
     * @var MeetupParticipationEnums
     */
    private $meetupParticipationEnums;

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
            'label' => 'filter.meetup_participation',
            'choices' => array_flip($this->meetupParticipationEnums->getChoices()),
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
