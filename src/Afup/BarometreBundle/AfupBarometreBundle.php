<?php

namespace Afup\BarometreBundle;

use Afup\BarometreBundle\DependencyInjection\Compiler\EnumsCollectionPass;
use Afup\BarometreBundle\DependencyInjection\Compiler\FilterCollectionPass;
use Afup\BarometreBundle\DependencyInjection\Compiler\ReportCollectionPass;
use Afup\BarometreBundle\DependencyInjection\Compiler\RequestModifierCollectionPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AfupBarometreBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new EnumsCollectionPass());
        $container->addCompilerPass(new RequestModifierCollectionPass());
    }
}
