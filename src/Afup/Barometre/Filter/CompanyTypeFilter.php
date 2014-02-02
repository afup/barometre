<?php

namespace Afup\Barometre\Filter;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Connection;

use Afup\BarometreBundle\Enums\CompanyTypeEnums;
use Afup\Barometre\Form\Type\Select2MultipleFilterType;

class CompanyTypeFilter implements FilterInterface
{
    /**
     * @var CompanyTypeEnums
     */
    private $companyTypes;

    /**
     * @param CompanyTypeEnums $companyTypes
     */
    public function __construct(CompanyTypeEnums $companyTypes)
    {
        $this->companyTypes = $companyTypes;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), new Select2MultipleFilterType(), [
            'label'    => 'filter.company_type',
            'choices'  => $this->companyTypes->getChoices()
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
            ->andWhere('response.companyType IN(:company_type)')
            ->setParameter('company_type', $values[$this->getName()], Connection::PARAM_INT_ARRAY);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'company_type';
    }
}
