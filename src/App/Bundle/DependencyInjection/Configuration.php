<?php

namespace Xeonys\LoggerExtra\App\Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $rootNode = $treeBuilder->root('xeonys_logger_extra');
        $rootNode
            ->children()
                ->arrayNode('fields')
                    ->isRequired()
                    ->children()
                        ->scalarNode('app_name')->isRequired()->end()
                        ->scalarNode('app_env')->isRequired()->end()
                        ->scalarNode('server_stack')->isRequired()->end()
                    ->end()
                ->end()
            ->end()
            ;

        return $treeBuilder;
    }
}
