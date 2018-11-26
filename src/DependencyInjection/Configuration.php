<?php

namespace MiguelAlcaino\KushkiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('miguel_alcaino_kushki');

        $rootNode
            ->children()
                ->arrayNode('transaction_record')
                    ->children()
                        ->scalarNode('transaction_record_factory')->isRequired()->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }

}