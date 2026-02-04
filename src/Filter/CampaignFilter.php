<?php

declare(strict_types=1);

namespace App\Filter;

use App\Entity\Campaign;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class CampaignFilter implements FilterInterface
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), EntityType::class, [
            'label' => 'filter.campaign',
            'class' => Campaign::class,
            'attr' => ['class' => 'select2'],
            'multiple' => true,
            'required' => false,
            'query_builder' => static function (EntityRepository $repository) {
                return $repository
                    ->createQueryBuilder('campaign')
                    ->orderBy('campaign.name', 'ASC');
            },
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

        $campaigns = array_map(static function (Campaign $item) {
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
     * Filter weight.
     *
     * @return int
     */
    public function getWeight()
    {
        return -1;
    }
}
