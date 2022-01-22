<?php

declare(strict_types=1);

namespace App\Filter;

use App\Enums\RemoteUsageEnums;
use App\Form\Type\Select2MultipleFilterType;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class RemoteUsageFilter implements FilterInterface
{
    /**
     * @var RemoteUsageEnums
     */
    private $remoteUsageEnums;

    public function __construct(RemoteUsageEnums $remoteUsageEnums)
    {
        $this->remoteUsageEnums = $remoteUsageEnums;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), Select2MultipleFilterType::class, [
            'label' => 'filter.remote_work',
            'choices' => array_flip($this->remoteUsageEnums->getChoices()),
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
            ->andWhere($queryBuilder->expr()->in('response.remoteUsage', $values[$this->getName()]));
    }

    /**
     * {@inheritdoc}
     */
    public function convertValuesToLabels($value)
    {
        return array_map(function ($value) {
            return $this->remoteUsageEnums->getLabelById($value);
        }, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'remote_usage';
    }

    /**
     * {@inheritdoc}
     */
    public function getWeight()
    {
        return 200;
    }
}
