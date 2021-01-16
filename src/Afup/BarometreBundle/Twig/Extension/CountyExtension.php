<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Twig\Extension;

use agallou\Regions\Collection2016 as Collection;
use Symfony\Component\Translation\TranslatorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class CountyExtension extends AbstractExtension
{
    /**
     * @var Collection
     */
    protected $regions;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->regions = new Collection();
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */
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
