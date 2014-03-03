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
     * @var \Symfony\Bundle\FrameworkBundle\Translation\Translator
     */
    protected $translator;

    /**
     *
     */
    public function __construct($translator)
    {

        $this->departements = new Collection();
        $this->translator   = $translator;
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
            return $this->translator->trans('report.company_departement.unknown');
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
