<?php

require_once( '../class/config.php' );
require_once( 'class/class.mail_template.php' );
require_once( 'class/class.messagemail.php' );
//require_once( 'class/class.templatelib.php' );

if ( $session->get('AID') ) {

	$db = &new Database( USER, PASSWORD, DATABASE, HOST );
	$mailtemplate = new MailTemplate( $db );	
	$messagemail  = new MessageMail( $db );
	
			
	$record = $mailtemplate->getRowId( $_GET['template_id'] );
	if (is_array($record)) { 
		foreach( $record as $object )							
		$temp_name        = ($object->name);
		$temp_visible     = ($object->visible); 
		$temp_template    = ($object->template); 
		$temp_create_date = ($object->create_date); 
		$temp_update_date = ($object->update_date); 			
	}		
	
	$record = $messagemail->getRow( $_GET['message_id'] );	
	if ( is_array($record) ) { 
		foreach( $record as $object )							
		$mes_title       = $object->title;
		$mes_context     = $object->context; 
		$mes_sender      = $object->sender; 
		$mes_comment     = $object->comment; 
		$mes_template_id = $object->template_id;
		$mes_create_date = $object->create_date;	
		$mes_update_date = $object->update_date;					
	}





	$template = str_replace('{context}',$mes_context,$temp_template); 

	//$tem->template_code = $template;	
	//$tem->setVariable("context", "Tekst przyk³adowy");
	//$tem->setVariable(array("moj_wiek" => "17", "moje_imie" => "Wojtek"));
	//echo $message_id.'<br>';
	//echo $template_id.'<br>';
	echo $template;


} else {
	
	header("Locate: ../");
		
}	
	
?>	
