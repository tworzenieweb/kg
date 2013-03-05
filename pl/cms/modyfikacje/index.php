<?php

require_once( '../class/config.php' );



if ( $session->get('AID') ) {

	if ( isset($_GET['navigate']) ) { 
		$nav = trim($_GET['navigate']); 
	} else { 
		if ( isset($_POST['navigate']) ) $nav = trim($_POST['navigate']); 
	}	
	//echo $nav;
	switch ($nav) {	
	case 'site_edit':  
		include_once("site_edit.php");
		break;	
	case 'site_page':  
		include_once("site_page.php");
		break;			
	case 'site_menu':  
		include_once("site_menu.php");
		break;	
	default:
		//include_once("../template/eletter.php");
		include_once("home.php");
	}	
	
} else {

	header("Locate: ../");

}

?>