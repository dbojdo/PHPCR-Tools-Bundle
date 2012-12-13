<?php
namespace Webit\Bundle\PHPCRToolsBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Webit\Bundle\PHPCRToolsBundle\DependencyInjection\Compiler\JMSSerializerFileLocatorPass;

class WebitPHPCRToolsBundle extends Bundle {
	public function build(ContainerBuilder $container) {
		parent::build($container);
		$container->addCompilerPass(new JMSSerializerFileLocatorPass());
	}
}
?>
