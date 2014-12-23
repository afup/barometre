<?php

namespace Afup\Barometre\Filter;

use Afup\BarometreBundle\Entity\Campaign;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\DBAL\Query\QueryBuilder;

class CampaignFilter implements FilterInterface
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), 'entity', [
            'label'    => 'filter.campaign',
            'class'    => 'Afup\BarometreBundle\Entity\Campaign',
            'attr'     => ['class' => 'select2'],
            'multiple' => true,
            'required' => false,
            'query_builder' => function (EntityRepository $repository) {
                return $repository
                    ->createQueryBuilder('campaign')
                    ->orderBy('campaign.name', 'ASC');
            }
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery(QueryBuilder $queryBuilder, array $values = [])
    {
        if (!array_key_exists($this->getName(), $values) || 0 === count($values[$this->getName()])) {
            return;
        }

        $campaigns = array_map(function (Campaign $item) {
            return $item->getId();
        }, $values[$this->getName()]->toArray());

        $queryBuilder
            ->andWhere($queryBuilder->expr()->in('response.campaign_id', $campaigns));
    }

    /**
     * {@inheritdoc}
     */
    public function convertValuesToLabels($value)
    {
        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'campaign';
    }

    /**
     * Filter weight
     *
     * @return int
     */
    public function getWeight()
    {
        return -1;
    }
}
