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
        $dataProcessorFactoryDefinition = new Definition('AppBundle\Chart\Data\DataFactory');
        if (! $container->hasDefinition('app.chart.data.processor_factory')) {
            $container->setDefinition('app.chart.data.processor_factory', $dataProcessorFactoryDefinition);
        }

        $dataProcessors = $container->findTaggedServiceIds('app.chart.data.processor');

        foreach ($dataProcessors as $id => $tags) {
            $dataProcessorFactoryDefinition->addMethodCall('addDataProcessor', array(new Reference($id)));
        }
    }
}