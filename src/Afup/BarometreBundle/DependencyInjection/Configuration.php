<?php

namespace Afup\BarometreBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('afup_barometre');

        $rootNode
            ->children()
                ->scalarNode('min_results_for_display')->defaultValue(100)->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
