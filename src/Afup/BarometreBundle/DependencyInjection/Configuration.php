<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('afup_barometre');

        $rootNode
            ->children()
                ->scalarNode('min_result')
                    ->defaultValue(10)
                ->end()
            ->end();

        return $treeBuilder;
    }
}
