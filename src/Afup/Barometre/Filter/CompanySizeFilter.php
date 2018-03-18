<?php

namespace Afup\Barometre\Filter;

use Afup\Barometre\Form\Type\Select2MultipleFilterType;
use Afup\BarometreBundle\Enums\CompanySizeEnums;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class CompanySizeFilter implements FilterInterface
{
    /**
     * @var CompanySizeEnums
     */
    private $companySizes;

    /**
     * @param CompanySizeEnums $companySizes
     */
    public function __construct(CompanySizeEnums $companySizes)
    {
        $this->companySizes = $companySizes;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), Select2MultipleFilterType::class, [
            'label' => 'filter.company_size',
            'choices' => array_flip($this->companySizes->getChoices()),
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

        $queryBuilder
            ->andWhere($queryBuilder->expr()->in('response.companySize', $values[$this->getName()]));
    }

    /**
     * {@inheritdoc}
     */
    public function convertValuesToLabels($value)
    {
        return array_map(function ($value) {
            return $this->companySizes->getLabelById($value);
        }, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'company_size';
    }

    /**
     * Filter weight
     *
     * @return int
     */
    public function getWeight()
    {
        return 7;
    }
}
