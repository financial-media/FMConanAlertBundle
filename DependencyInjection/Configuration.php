<?php

namespace FM\ConanAlertBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('fm_conan_alert');

        $rootNode
            ->children()
                ->arrayNode('alert_service')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('translation_domain')
                            ->defaultValue('alerts')
                            ->info('The domain used for translating alert messages')
                            ->example('alerts')
                        ->end()
                        ->scalarNode('translation_locale')
                            ->defaultValue('%locale%')
                            ->info('The locale used for translating alert messages')
                            ->example('en')
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
