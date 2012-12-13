<?php
namespace Webit\Bundle\PHPCRToolsBundle\Document;

use Doctrine\ODM\PHPCR\ReferrersCollection;

use Doctrine\ORM\Id\UuidGenerator;

use Webit\Tools\Text\Slugifier;
use PHPCR\Util\UUIDHelper;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCRODM;

/**
 * @author dbojdo
 * @PHPCRODM\Document(referenceable=true)
 */
class ReferenceableGeneric extends Generic {
	/**
	 * @var string
	 * @PHPCRODM\Uuid
	 */
	protected $uuid;
		
	public function __construct() {
		$this->uuid = UUIDHelper::generateUUID();
	}
	
	public function getUuid() {
		return $this->uuid;
	}
}
?>
