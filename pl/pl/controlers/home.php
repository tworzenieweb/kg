<?php
	/*
	if ( is_array( $training_info ) ) { 
		foreach( $training_info as $object ) {
			if ($object->visible==1 and $object->intro_visible) {
				$controler_context.= '<h1>'.$object->title.'</h1>';
				$controler_context.= '<div class="wciecie">'.$object->introduction;
				$controler_context.= '<p><a href="?page=10&amp;id='.$object->id.'" class="link-wiecej">wiêcej</a></p></div>';
			}	
		}
	}	
	*/											
	include_once('../template/home-pl.php');

?>