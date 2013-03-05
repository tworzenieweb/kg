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
	case 'mycompany':  //informacje o szkoleniu
		include_once("mycompany.php");
		break;	
	case 'cms_user':  //harmonogram szkoleñ
		include_once("cmsuser.php");
		break;	
	default:
		//include_once("../template/eletter.php");
		include_once("home.php");
	}	

	
} else {

	header("Locate: ../");

}

?>