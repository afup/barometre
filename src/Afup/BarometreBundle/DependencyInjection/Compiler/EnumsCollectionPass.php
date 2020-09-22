<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\DependencyInjection\Compiler;

use Afup\BarometreBundle\Enums\EnumsCollection;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class EnumsCollectionPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $enums = $container->getDefinition(EnumsCollection::class);

        foreach ($container->findTaggedServiceIds('barometre.enums') as $id => $attributes) {
            $enums->addMethodCall('addEnums', [new Reference($id)]);
        }
    }
}
