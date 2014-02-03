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
        $menu = $this->factory->createItem(
            'menu',
            [
                'childrenAttributes' => ['class' => 'sidebar-nav']
            ]
        );

        foreach ($this->reports as $report) {
            $menu->addChild(
                $report->getLabel(),
                [
                    'route'           => 'afup_barometre_report',
                    'routeParameters' => array_merge(
                        ['reportName' => $report->getName()],
                        ['filter' => $this->context->getParameters()]
                    ),
                ]
            );
        }

        return $menu;
    }
}
