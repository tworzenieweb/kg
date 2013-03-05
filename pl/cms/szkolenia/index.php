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
	case 'training_info':  //informacje o szkoleniu
		include_once("training_info.php");
		break;	
	case 'schedule':  //harmonogram szkoleñ
		include_once("schedule.php");
		break;	
	case 'instructors': //wyk³adowcy
		include_once("instructors.php");
		break;	
	case 'participant': //uczestnicy szkoleñ
		include_once("participant.php");
		break;	
	case 'invoice': //faktury
		include_once("invoice.php");
		break;			
	default:
		//include_once("../template/eletter.php");
		include_once("home.php");
	}	

	
} else {

	header("Locate: ../");

}

?>