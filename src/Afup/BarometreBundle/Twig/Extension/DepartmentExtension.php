<?php

namespace Afup\BarometreBundle\Twig\Extension;

use agallou\Departements\Collection;

class DepartmentExtension extends \Twig_Extension
{
    /**
     * @var Collection
     */
    protected $departements;

    /**
     *
     */
    public function __construct()
    {
        $this->departements = new Collection();
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            'department_label' => new \Twig_Filter_Method($this, 'departmentLabel'),
        );
    }

    public function departmentLabel($code)
    {
        try {
            return $this->departements->getLabel($code, true);
        } catch (\InvalidArgumentException $e) {
            return $code;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'department';
    }
}
