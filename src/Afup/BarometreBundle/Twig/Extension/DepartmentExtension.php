<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Twig\Extension;

use agallou\Departements\Collection;
use Symfony\Component\Translation\TranslatorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class DepartmentExtension extends AbstractExtension
{
    /**
     * @var Collection
     */
    protected $departements;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->departements = new Collection();
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new TwigFilter('department_label', [$this, 'departmentLabel']),
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
