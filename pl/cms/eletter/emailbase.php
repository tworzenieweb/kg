<?php

require_once( '../class/config.php' );
require_once( 'class/class.emailbase.php' );

if ( $session->get('AID') ) {

	$db = &new Database( USER, PASSWORD, DATABASE, HOST );
	$pagedata = new MailBase( $db );	
	$page = new Page( $db );
	
	$page_info_list = 1;
	$page_info_new  = 2;
	$page_info_edit = 3;	
	
	$page_info = $page_info_list;
				
	if 	( isset( $_GET['action'] )) {
		$action = $_GET['action'];
		$record_id = (isset( $_GET['id'] )) ? $_GET['id'] : 0;  
	} else {
		$action = $_POST['action'];
		$record_id = (isset( $_POST['id'] )) ? $_POST['id'] : 0;  
	}	

	function set_post_row ( $record ) {
		if ( is_array($record) ) { 
			foreach( $record as $object )							
			$_POST['name']  = $object->name;
			$_POST['email'] = $object->email; 
			$_POST['source']  = $object->source;
			$_POST['type']    = $object->type;				
			$_POST['phone']     = $object->phone;					
			$_POST['user_host'] = $object->user_host;					
			$_POST['mail_accept']  = $object->accept;		
			$_POST['mail_comment'] = $object->mail_comment;					
		}
	}
	
	//echo $record_id;
	switch ( $action ) {	
	case 'edit':
		if ($record_id) { 	// formularz nowego rekordu (ustawienia pocz±tkowe)
			$_POST['id'] = $rocord_id;
			set_post_row ($pagedata->getRow($_GET['id'])); 
			$page_info = $page_info_edit;	
		} else { 			// formularz edycji
			$_POST['mail_accept'] = 1;
			$_POST['source']      = 'wpis rêczny';
			$_POST['type']        = 'cms';		
			$page_info = $page_info_new;			
		}
		break;
		
	case 'save':
		if ($record_id) { 	// aktualizacja (update)
			$pagedata->updateRow($_POST); 
			set_post_row ($pagedata->getRow($_POST['id'])); 			
		} else {			// dodanie (insert)
			$pagedata->addRow($_POST); 
			$record_id  = $pagedata->lastId;
			$_POST['id'] = $record_id;
			set_post_row ($pagedata->getRow($_POST['id'])); 		
		}	
		$page_info = $page_info_edit;
		break;
				
	default:			
		switch ( $action ) {
		case 'accept':
			if ($record_id) { 	// aktualizacja (update) i przej¶cie do listy
				$pagedata->updateRow($_POST); 
				set_post_row ($pagedata->getRow($_POST['id'])); 					
			} else {			// dodanie (insert) i przej¶cie do listy
				$pagedata->addRow($_POST); 
				$_POST['id'] = $pagedata->lastId;
				set_post_row ($pagedata->getRow($_POST['id'])); 				
			}
			break;
		case 'change_accept':	
			$pagedata->changeAccept($_POST); 
			break;
		case 'delete':	
			$pagedata->deleteRows($_POST['cid']); 
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