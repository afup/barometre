<?php

namespace Afup\Barometre\Filter;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\DBAL\Query\QueryBuilder;

use Afup\BarometreBundle\Enums\CompanyTypeEnums;

class CompanyTypeFilter implements FilterInterface
{
    private $companyTypes;

    public function __construct(CompanyTypeEnums $companyTypes)
    {
        $this->companyTypes = $companyTypes;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), 'choice', [
            'label'    => "Type d'entreprise"
            'choices'  => $this->companyTypes->getChoices(),
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
            ->andWhere('response.compagnyType IN(:company_type)')
            ->setParameter('company_type', $values[$this->getName()], \Doctrine\DBAL\Connection::PARAM_INT_ARRAY)
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'company_type';
    }
}
