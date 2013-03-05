<?php

require_once( '../class/config.php' );
require_once( 'class/class.messagemail.php' );
require_once( 'class/class.mail_template.php' );

if ( $session->get('AID') ) {

	$db = &new Database( USER, PASSWORD, DATABASE, HOST );
	$pagedata = new MessageMail( $db );	
	$page = new Page( $db );
	$mailtemplate = new MailTemplate ( $db );
	
	$page_info_list = 8;
	$page_info_new  = 9;
	$page_info_edit = 10;	
	
	$page_info = $page_info_list;

				
	if 	( isset( $_GET['action'] )) {
		$action = $_GET['action'];
		$record_id = (isset( $_GET['id'] )) ? $_GET['id'] : 0;  
	} else {
		$action = $_POST['action'];
		$record_id = (isset( $_POST['id'] )) ? $_POST['id'] : 0;  
	}	

	function set_post_row( $record ) {
		if ( is_array($record) ) { 
			foreach( $record as $object )							
			$_POST['title']       = $object->title;
			$_POST['context']     = $object->context; 
			$_POST['sender']      = $object->sender; 
			$_POST['comment']     = $object->comment; 
			$_POST['template_id'] = $object->template_id;
			$_POST['create_date'] = $object->create_date;	
			$_POST['update_date'] =	$object->update_date;					
		}
	}
		
	switch ( $action ) {	
	case 'edit':
		if ($record_id) { 	// formularz nowego rekordu (ustawienia pocz±tkowe)
			$_POST['id'] = $rocord_id;
			set_post_row( $pagedata->getRow($_GET['id'])); 
			$page_info = $page_info_edit;		
		} else { 			// formularz edycji
			$_POST['template_id'] = 0;
			$_POST['sender']      = 'Akademia Stosowania Prawa';
			$page_info = $page_info_new;		
		}
		$select_resoults = $mailtemplate->getListToSelect();
		break;
		
	case 'save':
		if ($record_id) { 	// aktualizacja (update)
			//echo 'wybrano update';	
			$pagedata->updateRow($_POST); 				
		} else {			// dodanie (insert)
			//echo 'wybrano insert';
			$pagedata->addRow($_POST); 
			$record_id = $pagedata->lastId;
			$_POST['id'] = $record_id;
		}	
		set_post_row( $pagedata->getRow($_POST['id'])); 
		$select_resoults = $mailtemplate->getListToSelect();		
		$page_info = $page_info_edit;
		break;
				
	default:			
		switch ( $action ) {
		case 'accept':
			if ($record_id) { 	// aktualizacja (update) i przej¶cie do listy
				//echo 'wybrano update';
				$pagedata->updateRow($_POST); 						
			} else {			// dodanie (insert) i przej¶cie do listy
				//echo 'wybrano insert';
				$pagedata->addRow($_POST); 
				$_POST['id'] = $pagedata->lastId;
			}
			set_post_row( $pagedata->getRow($_POST['id'])); 		
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
	
	//echo $page_info;
	$page->setPageInfo( $page_info );
	include("../template/".$page->template_file_name);	    						
		
} else {
	
	header("Locate: ../");
		
}

?>