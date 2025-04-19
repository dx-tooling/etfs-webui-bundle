<?php

declare(strict_types=1);

namespace EnterpriseToolingForSymfony\WebuiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('etfs_webui');
        $rootNode    = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->arrayNode('assets')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('include_tailwind')->defaultTrue()->end()
                        ->booleanNode('include_stimulus')->defaultTrue()->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
