<?php

require_once( '../class/config.php' );
require_once( '../class/polish_date.php' );

$_SESSION['list_limit'] = 50;

if ($_GET['logout']) {
    $_GET = array();
    $_SESSION = array(); //wyczyszceznie wszystkich zmiennych sesji
    header("Location: ../"); 
}

	$pl_date = polish_date(1);

if ( $session->get('AID') ) {

		include("../template/homepage.php");
	
} else {

   	$pass      = $_POST['user']['password'];
	$username  = $_POST['user']['login'];

	if (!isset($username)&& !isset($pass)) {	  

		include("../template/login.php");
	
	} else {
	    
		$password = &new Password( new Database( USER, PASSWORD, DATABASE, HOST ));		
		$result = $password->checkPassword( $pass, $username);
	
		if ( $result ) {
		
			$session->set( 'AID', 1 );
			include("../template/homepage.php");
			
		} else {
		    $message = "B³êdne has³o lub u¿ytkownik";
			include("../template/login.php");
		}	
			
	}		
}

?>