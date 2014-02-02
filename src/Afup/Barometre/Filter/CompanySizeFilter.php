<?php

namespace Afup\Barometre\Filter;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Connection;

use Afup\BarometreBundle\Enums\CompanySizeEnums;
use Afup\Barometre\Form\Type\Select2MultipleFilterType;

class CompanySizeFilter implements FilterInterface
{
    private $companySizes;

    /**
     * __construct
     *
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
        $builder->add($this->getName(), new Select2MultipleFilterType(), [
            'label'    => "Taille de l'entreprise",
            'choices'  => $this->companySizes->getChoices()
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
            ->andWhere('response.companySize IN(:company_size)')
            ->setParameter('company_size', $values[$this->getName()], Connection::PARAM_INT_ARRAY);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'company_size';
    }
}
