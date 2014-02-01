<?php

namespace Afup\BarometreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ReportCollectionPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('afup.barometre.report_collection');

        foreach ($container->findTaggedServiceIds('barometre.report') as $id => $attributes) {
            $definition->addMethodCall('addReport', array(new Reference($id)));
        }
    }
}
