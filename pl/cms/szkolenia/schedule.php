<?php

require_once( '../class/config.php' );
require_once( 'class/class.schedule.php' );
require_once( 'class/class.instructors.php' );
require_once( 'class/class.training_info.php' );

if ( $session->get('AID') ) {

	$db = &new Database( USER, PASSWORD, DATABASE, HOST );
	$training_info = new TrainingInfo( $db ); 
	$instructors = new Instructors( $db );
	$pagedata = new Schedule( $db );	
	
	$page = new Page( $db );
	
	$page_info_list = 21;
	$page_info_new  = 22;
	$page_info_edit = 23;	
	
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
		if ($record_id) { 	// formularz nowego rekordu (ustawienia pocz±tkowe)			
			$row_data = set_post_row ($pagedata->getRow($record_id));									
			$page_info = $page_info_edit;				
		} else { 			// formularz edycji
			//echo 'wszystko ok';	
			$page_info = $page_info_new;			
		}
		$training_info_list = $training_info->getTrainingInfo();
		$instructors_list = $instructors->getInscructors($record_id);
		break;
		
	case 'save':
		if ($record_id) { 	// aktualizacja (update)
			$pagedata->updateRow($_POST); 			 			
		} else {			// dodanie (insert)
			$pagedata->addRow($_POST); 
			$record_id = $pagedata->lastId;	
			$_POST['id'] = $record_id; 		
		}			
		$pagedata->addInstructorsHandling($_POST);
		$row_data = set_post_row($pagedata->getRow($record_id));
		$training_info_list = $training_info->getTrainingInfo();
		$instructors_list = $instructors->getInscructors($record_id);
		$page_info = $page_info_edit;
		break;
				
	default:			
		switch ( $action ) {
		case 'accept':
			if ($record_id) { 	// aktualizacja (update) i przej¶cie do listy
				$pagedata->updateRow($_POST); 			
			} else {			// dodanie (insert) i przej¶cie do listy
				$pagedata->addRow($_POST); 
				$record_id = $pagedata->lastId;
				$_POST['id'] = $record_id; 						
			}			
			$pagedata->addInstructorsHandling($_POST);
			set_post_row ($pagedata->getRow($record_id)); 				
			break;
		case 'change_visible':	
			$pagedata->changeVisible($_POST); 
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