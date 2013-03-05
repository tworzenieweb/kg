<?php
class PageAction 
{
	var $dao = null;

	function PageAction( &$dao ) {
		$this->dao = $dao;
	}

	function getActionList ($pageId) {
	
		$sql = 'SELECT * FROM asp_cms_action_item INNER JOIN asp_cms_action ON asp_cms_action_item.id = asp_cms_action.action_id WHERE page_id =$pageId ORDER BY sort_order';
		return $this->dao->query( $sql );	
	}

	function getActionString ($pageId) {
	
		$record = getActionList ($pageId);
		if (is_array($record)) { 
			foreach( $record as $object )							
			$object->template;
		}	
		
	}


}

?>