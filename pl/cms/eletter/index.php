<?php

require_once( '../class/config.php' );


if ( $session->get('AID') ) {
	
	if ( isset($_GET['navigate']) ) { 
		$nav = trim($_GET['navigate']); 
	} else { 
		if ( isset($_POST['navigate']) ) $nav = trim($_POST['navigate']); 
	}	
	
	switch ($nav) {	
	case 'emailbase':
		include_once("emailbase.php");
		break;	
	case 'mail_template':
		include_once("mail_template.php");
		break;	
	case 'messagemail':
		include_once("messagemail.php");
		break;	
	case 'shipping':
		include_once("shipping.php");
		break;	
	default:
		//include_once("../template/eletter.php");
		include_once("home.php");
	}	

} else {

	header("Locate: ../");
	
}

?>