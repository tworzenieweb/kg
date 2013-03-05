<?php
	require_once( '../class/config.php' );
	require_once( 'class/class.shipping.php' );
	
	$db = &new Database( USER, PASSWORD, DATABASE, HOST );	
	$pagedata = new Shipping( $db );
	$page = new Page( $db );
	
	$page->setPageInfo( 15 );
	
	if 	( isset( $_GET['id'] )) {
		$id = $_GET['id'];
	} else {
		$id = $_POST['id'];
	}	

	
	
	$list_resoults = &$pagedata->getReportList($_POST,$id); 
	
	include_once("../template/report.php");

?>