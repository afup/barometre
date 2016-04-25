<?php

namespace Afup\BarometreBundle\Twig\Extension;

use agallou\Regions\Collection2016 as Collection;
use Symfony\Component\Translation\TranslatorInterface;

class CountyExtension extends \Twig_Extension
{
    /**
     * @var Collection
     */
    protected $regions;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @param TranslatorInterface $translator
     */
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
            new \Twig_SimpleFilter('county_label', [$this, 'countyLabel']),
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

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'region';
    }
}
