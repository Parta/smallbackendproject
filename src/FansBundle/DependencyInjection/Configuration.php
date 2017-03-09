<?php
namespace FansBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fans');

        $rootNode
            ->children()
            ->arrayNode('facebook')
            ->children()
            ->integerNode('client_id')->end()
            ->scalarNode('client_secret')->end()
            ->scalarNode('facebook_url')->end()
            ->end()
            ->end() // twitter
            ->end()
        ;

        return $treeBuilder;
    }
}