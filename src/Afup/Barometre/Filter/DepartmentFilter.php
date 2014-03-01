<?php

namespace Afup\Barometre\Filter;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Connection;
use agallou\Departements\Collection as Departments;

use Afup\Barometre\Form\Type\Select2MultipleFilterType;

class DepartmentFilter implements FilterInterface
{
    const ALL_BUT_PARIS = 'all_but_paris';

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), new Select2MultipleFilterType(), [
            'label'    => 'filter.department',
            'choices'  => $this->getChoices(),
        ]);
    }

    /**
     * @return array
     */
    protected function getChoices()
    {
        $choices = array();
        $choices[self::ALL_BUT_PARIS] = 'Tous sauf Paris';

        foreach (new Departments() as $number => $label) {
            $choices[$number] = sprintf('%s - %s', $number, $label);
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

        $codes = $values[$this->getName()];

        if (in_array('all_but_paris', $codes)) {
            $departements = new Departments();
            $parisDepartements = array("75");

            unset($codes[array_search('all_but_paris', $codes)]);

            foreach (array_keys($departements->getArrayCopy()) as $code) {
                if (in_array($code, $parisDepartements)) {
                    continue;
                }
                $codes[] = $code;
            }
            $codes = array_unique($codes);
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
        return 'departement';
    }

    /**
     * Filter weight
     *
     * @return int
     */
    public function getWeight()
    {
        return 2;
    }
}
