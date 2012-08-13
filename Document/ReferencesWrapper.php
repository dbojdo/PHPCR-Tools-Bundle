<?php
namespace Webit\Bundle\PHPCRToolsBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCRODM;

/**
 * 
 * @author dbojdo
 * @PHPCRODM\Document
 */
class ReferencesWrapper {
	/**
	 * 
	 * @var string
	 * @PHPCRODM\Id(strategy="parent")
	 */
	protected $id;
	
	/**
   * @PHPCRODM\ParentDocument
	 */
	protected $parent;
	
	/**
	 * 
	 * @PHPCRODM\Nodename
	 */
	protected $name;
	
	/**
	 * 
	 * @var mixed
	 * @PHPCRODM\ReferenceOne
	 */
	protected $referenceOne;
	
	/**
   * @var ArrayCollection
   * @PHPCRODM\ReferenceMany
	 */
	protected $referenceMany;
	
	public function getId() {
		return $this->id;
	}
	
	public function setParent($parent) {
		$this->parent = $parent;
	}
	
	public function getParent() {
		return $this->parent;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function getName() {
		return $this->name;
	}
	
	/**
	 * 
	 * @param mixed $reference
	 */
	public function setReferenceOne($reference) {
		$this->referenceOne = $reference;
	}
	
	/**
	 *  @return mixed
	 */
	public function getReferenceOne() {
		return $this->referenceOne;
	}
	
	/**
	 * 
	 * @param mixed $reference
	 */
	public function addReferenceMany($reference) {
		$this->getReferencesMany()->add($reference);
	}
	
	public function removeReferenceMany($reference) {
		$this->getReferencesMany()->removeElement($reference);
	}
	
	/**
	 * @return ArrayCollection
	 */
	public function getReferencesMany() {
		if(isset($this->referenceMany) == false) {
			$this->referenceMany = new ArrayCollection();
		}
		
		return $this->referenceMany;
	}
}
?>
