<?php

namespace Afup\Barometre\Filter;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\DBAL\Query\QueryBuilder;

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
        $builder->add($this->getName(), Select2MultipleFilterType::class, [
            'label'    => 'filter.company_type',
            'choices'  => array_flip($this->companyTypes->getChoices()),
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
            ->andWhere($queryBuilder->expr()->in('response.companyType', $values[$this->getName()]));
    }

    /**
     * {@inheritdoc}
     */
    public function convertValuesToLabels($value)
    {
        return array_map(function ($value) {
            return $this->companyTypes->getLabelById($value);
        }, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'company_type';
    }

    /**
     * Filter weight
     *
     * @return int
     */
    public function getWeight()
    {
        return 6;
    }
}
