<?php

	define( 'USER', '806206HQWV136' );
	define( 'PASSWORD', 'grotowski2006' );
	define( 'DATABASE', '806206HQWV136' );
	define( 'HOST', '127.0.0.1:4000' );
	
	require_once( "../class/class.database.php" );	
	require_once( "../class/class.main.php" );
	require_once( "../class/class.password.php" );
	require_once( "../class/class.session.php" );	
	require_once( "../class/class.page.php" );		
	require_once( "../class/global.function.php" );
	
	$session = &new Session();
	
?>