<?php

namespace Webit\Bundle\PHPCRToolsBundle\DependencyInjection;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface {
	/**
	 * {@inheritDoc}
	 */
	public function getConfigTreeBuilder() {
		$treeBuilder = new TreeBuilder();
		$rootNode = $treeBuilder->root('webit_phpcr_tools');

		$configDir = realpath(__DIR__ . '/../Resources/config/serializer');

		$rootNode->children()
			->arrayNode('jms_serializer')
			->addDefaultsIfNotSet()
				->children()
					->arrayNode('directories')
					->addDefaultsIfNotSet()
						->children()
							->scalarNode('Doctrine\ODM\PHPCR')->defaultValue($configDir . '/PHPCR')->end()
							->scalarNode('Symfony\Cmf\Bundle\RoutingExtraBundle')->defaultValue($configDir . '/CMFRoute')->end()
						->end()
					->end()
				->end()
			->end()
		->end();

		return $treeBuilder;
	}
}
