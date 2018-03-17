<?php

namespace Afup\Barometre\Filter;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Connection;
use agallou\Regions\Collection2016 as Regions;

use Afup\Barometre\Form\Type\Select2MultipleFilterType;

class DistrictFilter implements FilterInterface
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), Select2MultipleFilterType::class, [
            'label'    => 'filter.district',
            'choices'  => $this->getChoices(),
        ]);
    }

    /**
     * @return array
     */
    protected function getChoices()
    {
        $choices = array();

        foreach (new Regions() as $number => $label) {
            $choices[$number] = sprintf('%s - %s', $number, $label->getLabel());
        }

        return $choices;
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery(QueryBuilder $queryBuilder, array $values = array())
    {

        if (!array_key_exists($this->getName(), $values) || 0 === count($values[$this->getName()])) {
            return;
        }

        $values = $values[$this->getName()];
        $codes = [];

        $regions = new Regions();

        foreach ($values as $value) {
            $codes = array_merge(
                $codes,
                $regions->get($value)->getCodesDepartements()
            );
        }

        if (count($codes)) {
            $queryBuilder
                ->setParameter('department', $codes, Connection::PARAM_STR_ARRAY)
                ->andWhere('response.companyDepartment IN(:department)')
            ;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function convertValuesToLabels($value)
    {
        $choices = $this->getChoices();
        return array_map(function ($code) use ($choices) {
            return $choices[$code];
        }, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'district';
    }

    /**
     * Filter weight
     *
     * @return int
     */
    public function getWeight()
    {
        return 45;
    }
}
