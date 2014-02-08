<?php

namespace Afup\Barometre\Filter;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\QueryBuilder;

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
        $builder->add($this->getName(), new Select2MultipleFilterType(), [
            'label'    => 'filter.php_version',
            'choices'  => $this->phpVersions->getChoices()
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
    public function getName()
    {
        return 'php_version';
    }
}
