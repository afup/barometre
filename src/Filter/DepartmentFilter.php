<?php

declare(strict_types=1);

namespace App\Filter;

use agallou\Departements\Collection as Departments;
use agallou\Regions\Collection as Regions;
use App\Form\Type\Select2MultipleFilterType;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class DepartmentFilter implements FilterInterface
{
    public const ALL_BUT_PARIS = 'all_but_paris';
    public const ALL_BUT_PARIS_REGION_CODE = '11';

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), Select2MultipleFilterType::class, [
            'label' => 'filter.department',
            'choices' => array_flip($this->getChoices()),
        ]);
    }

    /**
     * @return array
     */
    protected function getChoices()
    {
        $choices = [];
        $choices[self::ALL_BUT_PARIS] = 'Tous sauf île-de-France';

        foreach (new Departments() as $number => $label) {
            $choices[$number] = sprintf('%s - %s', $number, $label);
        }

        return $choices;
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery(QueryBuilder $queryBuilder, array $values = [])
    {
        if (!\array_key_exists($this->getName(), $values) || 0 === \count($values[$this->getName()])) {
            return;
        }

        $codes = $values[$this->getName()];

        if (\in_array('all_but_paris', $codes, true)) {
            $departements = new Departments();
            $regions = new Regions();

            unset($codes[array_search('all_but_paris', $codes, true)]);

            $codes = array_merge(
                $codes,
                array_diff(
                    array_keys($departements->getArrayCopy()),
                    $regions->get(self::ALL_BUT_PARIS_REGION_CODE)->getCodesDepartements()
                )
            );
        }

        if (\count($codes)) {
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
     * Filter weight.
     *
     * @return int
     */
    public function getWeight()
    {
        return 2;
    }
}
