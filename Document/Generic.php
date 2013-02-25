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
	 * @var string
	 */
	protected $parentId;

	public function getParentId() {
		if (null == $this->parentId && $this->getParent()) {
			$this->parentId = $this->getParent()->getId();
		}

		return $this->parentId;
	}

	/**
	 * Set parent and nodename is the sam time
	 * @param mixed $parent
	 * @param string $name
	 * @return \Webit\Bundle\PHPCRToolsBundle\Document\Generic
	 */
	public function setPosition($parent, $nodename) {
		$this->setParent($parent);
		$this->setNodename($nodename);

		return $this;
	}

	/**
	 * @param string $name
	 */
	public function setNodename($name) {
		$name = Slugifier::slugify($name);
		if (empty($name)) {
			$name = UUIDHelper::generateUUID();
		}

		parent::setNodename($name);
	}
}
?>
