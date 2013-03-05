<?php

require_once( '../class/phpmailer/class.phpmailer.php' );
require_once( '../class/config.php' );
require_once( 'class/class.shipping.php' );
require_once( 'class/class.messagemail.php' );
require_once( 'class/class.mail_template.php' );


error_reporting(E_ALL);

//if ( $session->get('AID') ) {

	$path_unsubscribe = 'http://www.akademiastosowaniaprawa.pl/pl/cms/eletter/unsubscribe.php';

	if ( isset($_GET['id']) ) {
		$id = $_GET['id'];
	} elseif ( isset($_POST['id']) ) {
		$id = $_POST['id'];
	} else {
		$id = 0;
	}

	if ( $id != 0 ) {

		$db = &new Database( USER, PASSWORD, DATABASE, HOST );			
		$mailtemplate = new MailTemplate( $db );	
		$messagemail  = new MessageMail( $db ); 
		$shipping     = new Shipping( $db );
		$mail         = new phpmailer();
			
		$shipping_id = $id;	
					
		$record = $shipping->getRow( $shipping_id );
		if (is_array($record)) { 
			foreach( $record as $object )							
			$ship_message_id   = $object->message_id;
			$ship_comment      = $object->comment; 
			$ship_sender       = $object->sender;
			$ship_sender_email = $object->sender_email;	
			$ship_shipping     = $object->shipping;					
		}		
	
		$message_id = $ship_message_id;
		//echo 'message_id = '.$message_id.' <br/>';
		
		$record = $messagemail->getRow( $message_id );	
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
		
		$template_id = $mes_template_id;		
		//echo 'template_id = '.$template_id.' <br/>';
					
		$record = $mailtemplate->getRowId( $template_id );
		if (is_array($record)) { 
			foreach( $record as $object )							
			$temp_name        = ($object->name);
			$temp_visible     = ($object->visible); 
			$temp_template    = ($object->template); 
			$temp_create_date = ($object->create_date); 
			$temp_update_date = ($object->update_date); 			
		}		
		
		$messageHTML = str_replace('{context}',$mes_context,$temp_template);
		$messageTEXT = 'Akademia Stosowania Prawa';
		//echo $message;
				
		//$mail->SetLanguage("pl");
		$mail->From     = "mailing@akademiastosowaniaprawa.pl";
		$mail->FromName = "Akademia Stosowania Prawa";
		$mail->Host     = "akademiastosowaniaprawa.pl";
		$mail->CharSet  = "iso-8859-2";
		$mail->Subject  = "Akademia Stosowania Prawa (newsletter)";
		$mail->Mailer   = "smtp";
		$mail->Username = "mailing@akademiastosowaniaprawa.pl";
		$mail->Password = "noweprawo2002";
		$mail->SMTPAuth = true;
		
		//Handling status
		// 0 - Wiadomo¶æ nie wysy³ana
		// 1 - Wiadomo¶æ wys³ana poprawnie
		// 2 - B³±d w czasie wysy³ki
		
		//mail_shipping "shipping"
		// 0 - wysy³ka nierozpoczêta
		// 1 - wysy³ka w trakcie realizacji
		// 2 - wysy³ka zakoñczona
?>		
<html>
	<head>
	<style type="text/css">
<!--
#body-body {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #333333;
	background-color: #FFFFFF;
}
.s-good {
	color: #009900;
}
.s-error {
	color: #FF0000;
}
-->
    </style>
	</head>
	<body id="body-body">
<?php					
		$email_list = $shipping->handlingList ( $shipping_id );	
		$do_wyslania = count($email_list);		
		echo '<b>Do wys³ania:</b> '.$do_wyslania.' <br/>';
		if ($do_wyslania > 0) {
			//$shipping->startShipping( $shipping_id, $temp_template, $mes_context );
			$shipping->startShipping( $shipping_id, $temp_template, $mes_context );
			$dobrych = 0; $bledow=0;
			if ( is_array( $email_list ) ) { 
				foreach( $email_list as $object ) { 
					//wstawienie zmiennych do wyrejestrowania
					$messageHTML = str_replace('{unsubscribe}',$path_unsubscribe.'?un='.sha1( $object->mail_id ),$messageHTML);
					
					//echo $object->id.' <br/>';
					if ($object->email=='') {
						$shipping->updateHandlingStatus ( $object->id, '2', ' - <span class="s-error">Adres email jest pusty lub usuniêty</span><br/>' );
					} elseif ($object->accept==0) {
						$shipping->updateHandlingStatus ( $object->id, '2', ' - <span class="s-error">Brak zgody na wysy³kê (accept=0)</span><br/>' );
					} else {
						$mail->Body    = $messageHTML;
						$mail->AltBody = $messageTEXT;
						$mail->AddAddress($object->email, $object->email);
					
						if(!$mail->Send()) {
							echo ' - <span class="s-error">'.$mail->ErrorInfo.'</span><br/>';
							$shipping->updateHandlingStatus ( $object->id, '2', $mail->ErrorInfo );
							$bledow++;
						} else {
							$dobrych++;
							echo $object->email.' - <span class="s-good">wiadomo¶æ wys³ana</span><br/>';
							$shipping->updateHandlingStatus ( $object->id, '1', 'Wiadomo¶æ wys³ana' );
						}
							
						$mail->ClearAddresses();
					}
				}	
			}
			echo '<br/>';
			echo '<b>Wys³anych wiadomo¶ci: </b>'.$dobrych.' z '.$do_wyslania.'<br/>';
			echo '<b>Niewys³anych: </b>'.$bledow;
			$shipping->endShipping( $shipping_id );
		} else {
			echo 'Nie wybrano odresów do realizacji wysy³ki!';
		}
	} else {
		// nie przypisano id shipping
		echo 'Nie przypisano id shipping!';
	}
?>	
</body>
</html>
<?php

/*
} else {
	
	header("Locate: ../");
		
}
*/
?>