<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\DependencyInjection\Compiler;

use Afup\Barometre\Filter\FilterCollection;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class FilterCollectionPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition(FilterCollection::class);

        foreach ($container->findTaggedServiceIds('barometre.filter') as $id => $attributes) {
            $definition->addMethodCall('addFilter', [new Reference($id)]);
        }
    }
}
