<?php

namespace Afup\BarometreBundle\Twig\Extension;

use agallou\Departements\Collection;
use Symfony\Component\Translation\TranslatorInterface;

class DepartmentExtension extends \Twig_Extension
{
    /**
     * @var Collection
     */
    protected $departements;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->departements = new Collection();
        $this->translator   = $translator;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('department_label', [$this, 'departmentLabel']),
        ];
    }

    public function departmentLabel($code)
    {
        try {
            return $this->departements->getLabel($code, true);
        } catch (\InvalidArgumentException $e) {
            return $this->translator->trans('report.company_departement.unknown');
        }
    }
}
