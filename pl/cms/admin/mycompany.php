<?php

require_once( '../class/config.php' );
require_once( '../class/class.mycompany.php' );

if ( $session->get('AID') ) {

	$db = &new Database( USER, PASSWORD, DATABASE, HOST );
	$pagedata = new MyCompany( $db );	
	$page = new Page( $db );
	
	$page_info = 36;
				
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
	

	switch ( $action ) {	
	case 'save':
		$pagedata->updateRow($_POST); 			 					
		break;
		
	}
	
	$row_data = set_post_row ($pagedata->getRow());
	$page->setPageInfo( $page_info );
	include_once("../template/".$page->template_file_name);	    						
		
} else {
	
	header("Locate: ../");
		
}

?>