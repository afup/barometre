<?php

namespace Afup\Barometre\Filter;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\DBAL\Query\QueryBuilder;

use Afup\BarometreBundle\Enums\PHPVersionEnums;

class PHPVersionFilter implements FilterInterface
{
    private $phpVersions;

    public function __construct(PHPVersionEnums $phpVersions)
    {
        $this->phpVersions = $phpVersions;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), 'choice', [
            'label'    => 'Version de PHP'
            'choices'  => $this->phpVersions->getChoices(),
            'multiple' => true,
            'required' => false,
            'attr'     => array('class' => 'select2')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery(QueryBuilder $queryBuilder, array $values = array())
    {
        if (!array_key_exists($this->getName(), $values)) {
            return;
        }

        $queryBuilder
            ->andWhere('response.phpVersion IN(:php_version)')
            ->setParameter('php_version', $values[$this->getName()], \Doctrine\DBAL\Connection::PARAM_INT_ARRAY)
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'php_version';
    }
}
