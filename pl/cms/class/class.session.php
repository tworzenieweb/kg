<?php

class Session 
{
	function Session() {	
		session_start();
	}
		
	function set( $key, $value = null )	{
		$_SESSION[$key] = $value;
	}
		
	function get( $key ) {
		return $_SESSION[$key];
	}	
}

?>