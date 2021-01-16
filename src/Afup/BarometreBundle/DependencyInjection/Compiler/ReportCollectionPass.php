<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\DependencyInjection\Compiler;

use Afup\Barometre\Report\ReportCollection;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ReportCollectionPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition(ReportCollection::class);

        foreach ($container->findTaggedServiceIds('barometre.report') as $id => $attributes) {
            $definition->addMethodCall('addReport', [new Reference($id)]);
        }
        $definition->addMethodCall('sortReports');
    }
}
