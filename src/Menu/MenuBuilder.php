<?php

declare(strict_types=1);

namespace App\Menu;

use App\Filtering\Context;
use App\Report\ReportCollection;
use App\Report\ReportInterface;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class MenuBuilder
{
    private FactoryInterface $factory;

    /**
     * @var ReportCollection|ReportInterface[]
     */
    private $reports;

    /**
     * @var Context
     */
    private $context;

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
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

        $menu->addChild(
            'menu.result2021',
            [
                'route' => 'afup_barometre_campaign',
                'routeParameters' => ['campaignName' => 2021],
                'routeAbsolute' => UrlGeneratorInterface::ABSOLUTE_URL,
            ]
        );

        $menu->addChild(
            'menu.press_review',
            [
                'route' => 'afup_barometre_press_review',
                'routeAbsolute' => UrlGeneratorInterface::ABSOLUTE_URL,
            ]
        );

        $menu->addChild(
            'menu.about',
            [
                'route' => 'afup_barometre_about',
                'routeAbsolute' => UrlGeneratorInterface::ABSOLUTE_URL,
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

        $menu->addChild('menu.results', [
            'attributes' => [
                'class' => 'dropdown',
            ],
            'uri' => '#',
            'children_attributes' => [
                'class' => 'dropdown-menu',
            ],
        ]);

        $menu['menu.results']->setLinkAttributes([
            'class' => 'dropdown-toggle',
            'data-toggle' => 'dropdown',
        ]);
        $menu['menu.results']->setChildrenAttribute('class', 'dropdown-menu');

        $this->addReportsMenuItems($menu['menu.results']);

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
     * @return ItemInterface
     */
    public function createReportsMenu()
    {
        $menu = $this->factory->createItem('menu');

        $this->addReportsMenuItems($menu);

        return $menu;
    }

    protected function addReportsMenuItems(ItemInterface $menu)
    {
        $filters = $this->context->getParameters();

        foreach ($this->reports as $report) {
            if (null === $report->getWeight()) {
                continue;
            }

            $routeParameters = ['reportName' => $report->getName()];

            if (\count($filters) > 0) {
                $routeParameters['filter'] = $filters;
            }

            $menu->addChild(
                $report->getLabel(),
                [
                    'route' => 'afup_barometre_report',
                    'routeParameters' => $routeParameters,
                ]
            );
        }
    }
}
