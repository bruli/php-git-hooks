<?php

namespace Infrastructure\QueryBus;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class QueryBusCompilerPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('query.bus')) {
            return;
        }

        $queryBus = $container->findDefinition('bus.options.resolver');
        $queryHandlers = $container->findTaggedServiceIds('query_handler');

        foreach ($queryHandlers as $id => $tags) {
            foreach ($tags as $attributes) {
                $queryBus->addMethodCall('addOption', [$attributes['handles'], $id]);
            }
        }
    }
}
