<?php

require_once( '../class/config.php' );
//require_once( 'class/class.emailbase.php' );

if ( $session->get('AID') ) {

	$db = &new Database( USER, PASSWORD, DATABASE, HOST );
	//$mailbase = new MailBase( $db );	
	$page = new Page( $db );

	$page->setPageInfo( 40 );
	include("../template/".$page->template_file_name);
	
} else {
	
	header("Locate: ../go");
		
}	
?>
