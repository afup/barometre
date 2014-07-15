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
    protected function getBaseMenu()
    {
        $menu = $this->factory->createItem('menu');

        $menu->addChild(
            'A propos du baromètre',
            [
                'route' => 'afup_barometre_about',
            ]
        );

        return $menu;
    }

    /**
     * @return ItemInterface
     */
    public function createMenu()
    {
        $menu = $this->getBaseMenu();

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

        $this->addReportsMenuItems($menu['Rapports']);

        $menu->addChild(
            'Campagne 2014',
            [
                'uri' => 'http://afup.org/ask/barometre/2014.html',
            ]
        );

        return $menu;
    }

    /**
     * @return ItemInterface
     */
    public function createSimpleMenu()
    {
        $menu = $this->getBaseMenu();

        $this->addReportsMenuItems($menu);

        return $menu;
    }

    /**
     * @param ItemInterface $menu
     */
    protected function addReportsMenuItems(ItemInterface $menu)
    {
        $filters = $this->context->getParameters();

        foreach ($this->reports as $report) {

            $routeParameters = ['reportName' => $report->getName()];

            if (count($filters) > 0) {
                $routeParameters['filter'] = $filters;
            }

            $menu->addChild(
                $report->getLabel(),
                [
                    'route'           => 'afup_barometre_report',
                    'routeParameters' => $routeParameters,
                ]
            );
        }

    }
}
