<?php
namespace Webit\Bundle\PHPCRToolsBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Webit\Tools\Text\Slugifier;
use PHPCR\Util\UUIDHelper;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCRODM;

/**
 * 
 * @author dbojdo
 * @PHPCRODM\Document
 */
class GenericContainer {
	/**
	 * @var string
	 * @PHPCRODM\Id(strategy="parent")
	 */
	protected $id;

	/**
	 * @var string
	 * @PHPCRODM\Nodename
	 */
	protected $nodename;

	/**
	 * @var mixed
	 * @PHPCRODM\ParentDocument
	 */
	protected $parent;

	/**
	 * @var string
	 */
	protected $parentId;
	
	/**
	 * 
	 * @var ArrayCollection
	 * @PHPCRODM\Children(cascade="all")
	 */
	protected $children;

	public function getId() {
		return $this->id;
	}

	public function getNodename() {
		return $this->nodename;
	}

	public function setNodename($nodename) {
		$nodename = Slugifier::slugify($nodename);
		if (empty($nodename)) {
			$nodename = UUIDHelper::generateUUID();
		}
		
		$this->nodename = $nodename;
	}

	public function getParentId() {
		if (null == $this->parentId && $this->getParent()) {
			$this->parentId = $this->getParent()->getId();
		}
	
		return $this->parentId;
	}
	
	public function getParent() {
		return $this->parent;
	}

	public function setParent($parent) {
		$this->parent = $parent;
	}

	/**
	 * Set parent and nodename is the sam time
	 * @param mixed $parent
	 * @param string $name
	 * @return \Webit\Bundle\PHPCRToolsBundle\Document\GenericContainer
	 */
	public function setPosition($parent, $nodename) {
		$this->setParent($parent);
		$this->setNodename($nodename);
	
		return $this;
	}
	
	public function getChildren() {
		if($this->children == null) {
			$this->children = new ArrayCollection();
		}
		return $this->children;
	}

	public function addChild($child) {
		$this->getChildren()->add($child);
	}
}
?>
