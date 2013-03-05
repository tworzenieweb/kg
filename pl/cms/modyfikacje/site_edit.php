<?php

require_once( '../class/config.php' );
require_once( 'class/class.site_page.php' );
require_once( 'class/class.site_menu.php' );

if ( $session->get('AID') ) {

	$db = &new Database( USER, PASSWORD, DATABASE, HOST );
	$pagedata = new SitePage( $db );	
	$sitemenu = new SiteMenu( $db );
	$page = new Page( $db );
	
	$page_info_list = 48;
	$page_info_new  = 49;
	$page_info_edit = 49;	
	
	$page_info = $page_info_list;
				
	if 	( isset( $_GET['action'] )) {
		$action = $_GET['action'];
		$record_id = (isset( $_GET['id'] )) ? $_GET['id'] : 0;  
		//echo 'a';
	} else {
		$action = $_POST['action'];
		if (isset( $_POST['id'] )) { 
			$record_id = $_POST['id'];
			//echo 'b';
		} else {
			if (isset( $_POST['cid'] )) {
				$a = $_POST['cid'];		
				$record_id = $a[0];
				//echo 'c';
				//echo $record_id;
			} else {
				$record_id = 0;
				//echo 'd';
			}
		}			
	}	

	function set_post_row ( $record ) {
		if ( is_array($record) ) { 
			foreach( $record as $object )		
				return $object;
		}
	}
	
	//echo $record_id;
	switch ( $action ) {	
	case 'edit':
		$group_page_list = $pagedata->group_page_list();
		if ($record_id) { 	// formularz nowego rekordu (ustawienia pocz±tkowe)			
			$row_data = set_post_row ($pagedata->getRow($record_id));
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
		$group_page_list = $pagedata->group_page_list();
		$pagedata->publish($record_id);
		$row_data = set_post_row($pagedata->getRow($record_id));		
		$page_info = $page_info_edit;
		break;		
	case 'unpublish':
		if ($record_id) { 	// aktualizacja (update)
			//$pagedata->updateRow($_POST); 			 			
		} else {			// dodanie (insert)
			$pagedata->addRow($_POST); 
			$record_id  = $pagedata->lastId;			
		}	
		$pagedata->unpublish($record_id);
		$group_page_list = $pagedata->group_page_list();
		$row_data = set_post_row($pagedata->getRow($record_id));		
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
			$sitemenu->changeVisible2($_POST); 
			break;
		case 'change_intro_visible':	
			$pagedata->changeIntroVisible($_POST); 
			break;			
		case 'change_introduction':	
			$pagedata->changeIntroduction($_POST); 
			break;			
		case 'change_special':	
			$pagedata->changeSpecial($_POST); 
			break;						
		case 'change_sort_order':	
			$pagedata->changeSortOrder($_POST); 
			break;						
		case 'publish':	
			$pagedata->publish($record_id); 
			break;									
		case 'change_order':	
			$pagedata->changeOrder($_POST); 
			break;												
		case 'delete':	
			$pagedata->deleteRows($_POST['cid']); 
			break;
		case 'change_limit':
			//zmiana limitu
		}	
		
		$list_resoults = &$sitemenu->getList($_POST); 
		$page_info = $page_info_list;		
		
	}
	

	$page->setPageInfo( $page_info );
	include_once("../template/".$page->template_file_name);	    						
		
} else {
	
	header("Locate: ../");
		
}

?>