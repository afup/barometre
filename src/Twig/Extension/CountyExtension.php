<?php

declare(strict_types=1);

namespace App\Twig\Extension;

use agallou\Regions\Collection2016 as Collection;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class CountyExtension extends AbstractExtension
{
    protected Collection $regions;
    protected TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->regions = new Collection();
        $this->translator = $translator;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('county_label', [$this, 'countyLabel']),
        ];
    }

    public function countyLabel($code)
    {
        try {
            return $this->regions->get($code, true)->getLabel();
        } catch (\InvalidArgumentException $e) {
            return $this->translator->trans('report.company_county.unknown');
        }
    }
}
