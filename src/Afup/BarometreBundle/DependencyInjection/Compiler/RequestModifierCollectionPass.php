<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\DependencyInjection\Compiler;

use Afup\Barometre\RequestModifier\RequestModifierCollection;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class RequestModifierCollectionPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition(RequestModifierCollection::class);

        foreach ($container->findTaggedServiceIds('barometre.request_modifier') as $id => $attributes) {
            $definition->addMethodCall('addModifier', [new Reference($id)]);
        }
    }
}
