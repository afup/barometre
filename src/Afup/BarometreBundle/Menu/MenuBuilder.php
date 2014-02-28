<?php

namespace Afup\BarometreBundle\Menu;

use Afup\Barometre\Report\ReportCollection;
use Afup\Barometre\Report\ReportInterface;
use Afup\BarometreBundle\Filtering\Context;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

class MenuBuilder
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var ReportCollection|ReportInterface[]
     */
    private $reports;

    /**
     * @var Context
     */
    private $context;

    /**
     * @param FactoryInterface $factory
     * @param ReportCollection $reports
     * @param Context          $context
     */
    public function __construct(FactoryInterface $factory, ReportCollection $reports, Context $context)
    {
        $this->factory = $factory;
        $this->reports = $reports;
        $this->context = $context;
    }

    /**
     * @return ItemInterface
     */
    public function createMenu()
    {
        $menu = $this->factory->createItem('menu');

        $filters = $this->context->getParameters();

        $menu->addChild(
            'A propos du baromètre',
            [
                'route' => 'afup_barometre_about',
            ]
        );

        $menu->addChild('Rapports', [
            'attributes' => [
                'class' => 'dropdown'
            ],
            'uri' => '#',
            'children_attributes' => [
                'class' => 'dropdown-menu',
            ]
        ]);
        $menu['Rapports']->setLinkAttributes([
            'class' => 'dropdown-toggle',
            'data-toggle' => 'dropdown'
        ]);
        $menu['Rapports']->setChildrenAttribute('class', 'dropdown-menu');

        foreach ($this->reports as $report) {

            $routeParameters = ['reportName' => $report->getName()];

            if (count($filters) > 0) {
                $routeParameters['filter'] = $filters;
            }

            $menu['Rapports']->addChild(
                $report->getLabel(),
                [
                    'route'           => 'afup_barometre_report',
                    'routeParameters' => $routeParameters,
                ]
            );
        }

        return $menu;
    }
}
