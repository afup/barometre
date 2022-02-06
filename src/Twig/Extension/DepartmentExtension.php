<?php

declare(strict_types=1);

namespace App\Twig\Extension;

use agallou\Departements\Collection;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class DepartmentExtension extends AbstractExtension
{
    protected Collection $departements;
    protected TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->departements = new Collection();
        $this->translator = $translator;
    }

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
