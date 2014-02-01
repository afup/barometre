<?php

namespace Afup\Barometre\Filter;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Connection;

use Afup\BarometreBundle\Enums\PHPVersionEnums;
use Afup\Barometre\Form\Type\Select2MultipleFilterType;

class PHPVersionFilter implements FilterInterface
{
    private $phpVersions;

    /**
     * __construct
     *
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
            'label'    => 'Version de PHP',
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
            ->andWhere('response.phpVersion IN(:php_version)')
            ->setParameter('php_version', $values[$this->getName()], Connection::PARAM_INT_ARRAY);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'php_version';
    }
}
