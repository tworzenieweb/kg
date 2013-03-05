<?php

require_once( '../class/config.php' );
require_once( 'class/class.mail_template.php' );

if ( $session->get('AID') ) {

	$db = &new Database( USER, PASSWORD, DATABASE, HOST );
	$pagedata = new MailTemplate( $db );	
	$page = new Page( $db );
	
	$page_info_list = 5;
	$page_info_add  = 6;
	$page_info_edit = 7;
	
	$page_info = $page_info_list;
	
	function set_post_row( $record ) {
		
		if (is_array($record)) { 
			foreach( $record as $object )							
			$_POST['name']     = ($object->name);
			$_POST['visible']  = ($object->visible); 
			$_POST['template'] = ($object->template); 
			$_POST['create_date'] = ($object->create_date); 
			$_POST['update_date'] = ($object->update_date); 	
			$_POST['tem_comment'] = ($object->tem_comment); 			
		}		
	}
	
	switch ($_GET['action']) {	
	//akcje dla geta		
	case 'new' :
		$_POST['visible'] = 1;
		$page_info = $page_info_add;
		break;
			
	case 'edit'	:		
		$page_info = $page_info_edit;
		$_POST['id'] = $_GET['id'];
		set_post_row($pagedata->getRowId( $_GET['id'] ));
	}
		
	switch ($_POST['action']) {
	//akcje listy
	case 'change_visible':
		$pagedata->changeVisible($_POST); 
		break;			
	case 'delete':	
		$pagedata->deleteRows($_POST['cid']); 
		break;
	case 'change_limit':	
		//$_SESSION['list_limit']=$_POST['limit'];
		break;
			
	//akcje formularza	
	case 'add_list':	
		$pagedata->addRow($_POST); 
		$_GET = array ();
		break;	
	case 'add':	
		$pagedata->addRow($_POST); 
		$_POST['id'] = $pagedata->lastId;
		$_GET = array ();
		//$_GET['action'] = 'edit';
		$page_info = $page_info_edit;
		break;		
	case 'save':	
		$pagedata->updateRow($_POST); 
		set_post_row($pagedata->getRowId( $_POST['id'] ));
		$page_info = $page_info_edit;
		break;	
	case 'accept':	
		$pagedata->updateRow($_POST); 		
		break;			
	}		

	
	if (!isset( $_GET['action']) && !($_POST['action']=='save') && !($_POST['action']=='add')) {
		$list_resoults = &$pagedata->getList($_POST); 
		$page_info = $page_info_list;	
	}

	$page->setPageInfo( $page_info );
	include("../template/".$page->template_file_name);	    						
		
} else {
	
	header("Locate: ../");
		
}

?>