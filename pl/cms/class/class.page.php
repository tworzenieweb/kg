<?php
class Page 
{
	var $dao = null;
	var $pageId = null;
	var $title = 'EasyCMS';
	var $focus = '';
	var $submenu_activ_item = 0;	
	var $include_context = '';
	var $include_submenu = '';
	var $template_file_name = '';
	var $default_action = '';
	var $group_id = 0;
	var $group_name = '';
	var $menu_link = '';

	
	function Page( &$dao ) {
		$this->dao = $dao;
	}

	function setPageInfo ($pageId) {
	
		$this->pageId = $pageId;		
		
		$sql = "SELECT a.*, b.name as 'group_name', b.menu_link FROM asp_cms_page a LEFT JOIN asp_cms_group_page b ON a.group_id=b.id WHERE a.id=".$pageId;
		$record = $this->dao->query( $sql );	
		if (is_array($record)) { 		
			foreach( $record as $object ) {							
				$this->title = $object->title;
				$this->focus = $object->focus; 
				$this->group_name = $object->group_name; 
				$this->menu_link = $object->menu_link; 
				$this->default_action = $object->default_action; 
				$this->submenu_activ_item = $object->submenu_activ_item;			
				$this->include_context  = $object->include_context;
				$this->include_submenu  = $object->include_submenu;
				$this->template_file_name = $object->template_file_name;	
				$this->group_id = $object->group_id;						
			}
		}	
	
	}


}

?>