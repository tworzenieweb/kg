<?php

require_once( 'class/config.php' );
require_once( '../cms/modyfikacje/class/class.site_page.php' );
require_once( '../cms/modyfikacje/class/class.site_menu.php' );

	
	$db = new Database( USER, PASSWORD, DATABASE, HOST );
	$sitepage = new SitePage( $db );
	$sitemenu = new SiteMenu( $db );
	
	$main_menu_id  = 1;
	$main_menu     = $sitemenu->getMenu( $main_menu_id );	
	
	//Wyb�r kontrolera	
	$pageinfo = $sitepage->getPageInfo(isset($_GET['page']) ? $_GET['page'] : null);
	
	if (isset($_GET['print'])) {
		$pageinfo->site_template = 'print-template.php';
	}		
	
	if ($pageinfo && $pageinfo->site_controler != '' ) {		
		include_once('controlers/'.$pageinfo->site_controler.'.php');
	} else {
		include_once('controlers/home.php');	//kontroler strony g��wnej
	}
	

?>