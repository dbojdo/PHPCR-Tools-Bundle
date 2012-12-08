<?php
namespace Webit\Bundle\PHPCRToolsBundle\Document;

use Webit\Tools\Text\Slugifier;
use PHPCR\Util\UUIDHelper;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCRODM;
use Doctrine\ODM\PHPCR\Document\Generic as BaseGeneric;

/**
 * @author dbojdo
 * @PHPCRODM\Document()
 */
class Generic extends BaseGeneric {
	/**
	 * 
	 * @param string $name
	 */
	public function setNodename($name) {
		$name = Slugifier::slugify($name);
		if(empty($name)) {
			$name = UUIDHelper::generateUUID();
		};
		
		parent::setNodename($name);
	}
}
?>
