<?php

namespace Afup\Barometre\Filter;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\DBAL\Query\QueryBuilder;

use Afup\BarometreBundle\Enums\PHPVersionEnums;
use Afup\Barometre\Form\Type\Select2MultipleFilterType;

class PHPVersionFilter implements FilterInterface
{
    /**
     * @var PHPVersionEnums
     */
    private $phpVersions;

    /**
     * @param PHPVersionEnums $phpVersions
     */
    public function __construct(PHPVersionEnums $phpVersions)
    {
        $this->phpVersions = $phpVersions;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), Select2MultipleFilterType::class, [
            'label'    => 'filter.php_version',
            'choices'  => array_flip($this->phpVersions->getChoices())
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
            ->andWhere($queryBuilder->expr()->in('response.phpVersion', $values[$this->getName()]));
    }

    /**
     * {@inheritdoc}
     */
    public function convertValuesToLabels($value)
    {
        return array_map(function ($value) {
            return $this->phpVersions->getLabelById($value);
        }, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'php_version';
    }

    /**
     * Filter weight
     *
     * @return int
     */
    public function getWeight()
    {
        return 9;
    }
}
