<?php

require_once( '../class/config.php' );
require_once( 'class/class.shipping.php' );
require_once( 'class/class.messagemail.php' );

if ( $session->get('AID') ) {

	$db = &new Database( USER, PASSWORD, DATABASE, HOST );		
	$messagemail = new MessageMail( $db ); 
	$pagedata = new Shipping( $db );
	$page = new Page( $db );
	
	$page_info_list = 11;
	$page_info_new  = 12;
	$page_info_edit = 13;	
	$page_info_send = 14;

	
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
			$_POST['message_id']   = $object->message_id;
			$_POST['comment']      = $object->comment; 
			$_POST['sender']       = $object->sender;
			$_POST['sender_email'] = $object->sender_email;	
			$_POST['shipping']     = $object->shipping;					
			
		}
	}
		
	switch ( $action ) {	
	case 'send':
		$page_info = $page_info_send;
		break;	
	case 'edit':
		if ($record_id) { 	// formularz nowego rekordu (ustawienia pocz±tkowe)
			$_POST['id'] = $rocord_id;
			set_post_row ($pagedata->getRow($_GET['id'])); 
			$page_info = $page_info_edit;	
		} else { 			// formularz edycji
			$_POST['sender']        = 'Akademia Stosowania Prawa';
			$_POST['sender_email']  = 'office@akademiastosowaniaprawa.pl';
			$_POST['id'] = 0;
			$page_info = $page_info_new;			
		}
		$list_resoults_email = &$pagedata->getListEmail($_POST); 
		$message_list = $messagemail->getListToSelect();
		break;
		
	case 'save':
		if ($record_id) { 	// aktualizacja (update)
			$pagedata->updateRow($_POST); 						
		} else {			// dodanie (insert)
			$pagedata->addRow($_POST); 
			$_POST['id'] = $pagedata->lastId;
		}	
		set_post_row ($pagedata->getRow($_POST['id'])); 
		$list_resoults_email = &$pagedata->getListEmail($_POST); 
		$message_list = $messagemail->getListToSelect();
		$page_info = $page_info_edit;
		break;
	case 'deleteAllHandling':
		if ($record_id) { 	// aktualizacja (update)
			//$pagedata->updateRow($_POST); 						
			$pagedata->deleteAllHandling($record_id);
		} else {			// dodanie (insert)
			$pagedata->addRow($_POST); 
			$_POST['id'] = $pagedata->lastId;
			$pagedata->deleteAllHandling($_POST['id']);
			set_post_row ($pagedata->getRow($_POST['id'])); 
		}	
		$list_resoults_email = &$pagedata->getListEmail($_POST); 
		$message_list = $messagemail->getListToSelect();
		$page_info = $page_info_edit;	
		break;
	case 'deleteHandling':
		if ($record_id) { 	// aktualizacja (update)
			//$pagedata->updateRow($_POST); 						
			$pagedata->deleteHandling($_POST);
		} else {			// dodanie (insert)
			$pagedata->addRow($_POST); 
			$_POST['id'] = $pagedata->lastId;
			$pagedata->deleteHandling($_POST);
			set_post_row ($pagedata->getRow($_POST['id'])); 
		}	
		$list_resoults_email = &$pagedata->getListEmail($_POST); 
		$message_list = $messagemail->getListToSelect();
		$page_info = $page_info_edit;		
		break;
	case 'addAllHandling':	
		if ($record_id) { 	// aktualizacja (update)
			//$pagedata->updateRow($_POST); 						
			$pagedata->addAllHandling($_POST['id']);
		} else {			// dodanie (insert)
			$pagedata->addRow($_POST); 
			$_POST['id'] = $pagedata->lastId;
			$pagedata->addAllHandling($_POST['id']);
			set_post_row ($pagedata->getRow($_POST['id'])); 
		}			
		$list_resoults_email = &$pagedata->getListEmail($_POST); 
		$message_list = $messagemail->getListToSelect();
		$page_info = $page_info_edit;		
		break;
	case 'addHandling':
		if ($record_id) { 	// aktualizacja (update)
			//$pagedata->updateRow($_POST); 						
			$pagedata->addHandling($_POST);
		} else {			// dodanie (insert)
			$pagedata->addRow($_POST); 
			$_POST['id'] = $pagedata->lastId;
			$pagedata->addHandling($_POST);
			set_post_row ($pagedata->getRow($record_id)); 
		}	
		$list_resoults_email = &$pagedata->getListEmail($_POST); 
		$message_list = $messagemail->getListToSelect();
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
		case 'change_limit2':
			$action='list';
		}	
		
		if ( ($action=='list') or ($action=='next2') or ($action=='prev2') or ($action=='last2') or ($action=='first2')){
			$list_resoults_email = &$pagedata->getListEmail($_POST); 
			$message_list = $messagemail->getListToSelect();
			$page_info = $page_info_edit;	
		} else {
			$list_resoults = &$pagedata->getList($_POST); 
			$page_info = $page_info_list;		
		}
	}
	

	$page->setPageInfo( $page_info );
	include_once("../template/".$page->template_file_name);	    						
		
} else {
	
	header("Locate: ../");
		
}

?>