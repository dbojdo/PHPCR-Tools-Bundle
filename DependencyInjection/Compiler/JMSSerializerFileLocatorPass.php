<?php
namespace Webit\Bundle\PHPCRToolsBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Sets the classes to compile in the cache for the container.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class JMSSerializerFileLocatorPass implements CompilerPassInterface
{

    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $arCfg = $container->getParameter('webit_phpcr.jms_serializer');
        $arDirectories = $container->getDefinition('jms_serializer.metadata.file_locator')->getArgument(0);

        foreach ($arCfg['directories'] as $ns => $dir) {
            if (isset($arDirectories[$ns])) {
                continue;
            }
            $arDirectories[$ns] = $dir;
        }

        $container->getDefinition('jms_serializer.metadata.file_locator')->replaceArgument(0, $arDirectories);
    }
}
