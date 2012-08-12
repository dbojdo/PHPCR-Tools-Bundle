<?php
namespace Webit\PHPCRTools\Filter;

class NodenameFilter {
	/**
	 * 
	 * @param string $nodename
	 * @return string $nodename filtered nodename
	 */
	static public function filterStatic($nodename) {
		$filter = new self();
		return $filter->filter($nodename);
	}
	
	/**
	 * 
	 * @param string $nodename
	 * @return string $nodename
	 */
	public function filter($nodename) {
		$nodename = preg_replace('/[^A-Za-z0-9_-]/','',$nodename);
		$nodename = mb_strtolower($nodename);
		
		return $nodename;
	}
}
?>
