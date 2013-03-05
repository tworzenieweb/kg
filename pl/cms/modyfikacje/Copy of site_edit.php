<?php

require_once( '../class/config.php' );
require_once( 'class/class.site_menu.php' );
require_once( 'class/class.site_page.php' );

if ( $session->get('AID') ) {

	$db = &new Database( USER, PASSWORD, DATABASE, HOST );
	$changepage = new SitePage( $db );	
	$pagedata = new SiteMenu( $db );		
	$page = new Page( $db );
	
	$page_info_list = 48;
	$page_info_edit = 49;	
	
	$page_info = $page_info_list;
				
	if 	( isset( $_GET['action'] )) {
		$action = $_GET['action'];
		$record_id = (isset( $_GET['id'] )) ? $_GET['id'] : 0;  
	} else {
		$action = $_POST['action'];
		if (isset( $_POST['id'] )) { 
			$record_id = $_POST['id'];
		} else {
			if (isset( $_POST['cid'] )) {
				$a = $_POST['cid'];		
				$record_id = $a[0];
			} else {
				$record_id = 0;
			}
		}			
	}	

	function set_post_row ( $record ) {
		if ( is_array($record) ) { 
			foreach( $record as $object )		
				return $object;
		}
	}
	
	switch ( $action ) {	
	case 'edit':
		$group_page_list = $changepage->group_page_list();
		if ($record_id) { 	// formularz nowego rekordu (ustawienia pocz±tkowe)			
			$row_data = set_post_row ($changepage->getRow($record_id));						
			$page_info = $page_info_edit;				
		} else { 			// formularz edycji
			//echo 'wszystko ok';	
			$page_info = $page_info_new;			
		}
		break;		
	case 'save':
		$group_page_list = $pagedata->group_page_list();
		if ($record_id) { 	// aktualizacja (update)
			$pagedata->updateRow($_POST); 			 			
		} else {			// dodanie (insert)
			$pagedata->addRow($_POST); 
			$record_id  = $pagedata->lastId;			
		}	
		$row_data = set_post_row ($pagedata->getRow($record_id));
		$page_info = $page_info_edit;
		break;
	case 'published':
		if ($record_id) { 	// aktualizacja (update)
			$pagedata->updateRow($_POST); 			 			
		} else {			// dodanie (insert)
			$pagedata->addRow($_POST); 
			$record_id  = $pagedata->lastId;			
		}	
		$pagedata->publish($record_id);
		$row_data = set_post_row ($pagedata->getRow($record_id));		
		$page_info = $page_info_edit;
		break;		
	default:			
		switch ( $action ) {
		case 'accept':
			if ($record_id) { 	// aktualizacja (update) i przej¶cie do listy
				$pagedata->updateRow($_POST); 
				set_post_row ($pagedata->getRow($record_id)); 					
			} else {			// dodanie (insert) i przej¶cie do listy
				$pagedata->addRow($_POST); 
				$record_id = $pagedata->lastId;
				set_post_row ($pagedata->getRow($record_id)); 				
			}
			break;
		case 'change_visible':	
			$_POST['id'] = $_GET['id'];
			$pagedata->changeVisible2($_POST); 
			break;	
		case 'change_limit':
			//zmiana limitu
		}	
		
		$list_resoults = &$pagedata->getList($_POST); 
		$page_info = $page_info_list;		
		
	}
	

	$page->setPageInfo( $page_info );
	include_once("../template/".$page->template_file_name);	    						
		
} else {
	
	header("Locate: ../");
		
}

?>