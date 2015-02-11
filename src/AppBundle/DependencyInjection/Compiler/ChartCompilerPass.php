<?php

namespace AppBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class ChartCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $dataProccessorFactoryDefinition = new Definition('AppBundle\Chart\Data\DataFactory');
        if (! $container->hasDefinition('app.chart.data.proccessor_factory')) {
            $container->setDefinition('app.chart.data.proccessor_factory', $dataProccessorFactoryDefinition);
        }

        $dataProccessors = $container->findTaggedServiceIds('app.chart.data.proccessor');

        foreach ($dataProccessors as $id => $tags) {
            $dataProccessorFactoryDefinition->addMethodCall('addDataProccessor', array(new Reference($id)));
        }
    }
}