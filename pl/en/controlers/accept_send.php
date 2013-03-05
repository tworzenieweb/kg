<?php
	include_once( '../cms/class/class.phpmailer.php' ); 
	include_once( '../cms/eletter/class/class.messagemail.php' );
		

	$messagemail = new MessageMail( $db );
	$mail        = new phpmailer();

	function SendMessageAccept($email_id, $email, $messagemail, $mail, $if_eletter=1, $training_name='', $participant_id=0)
	{ 
	
		if ($if_eletter) {
			$messageHTML = $messagemail->getMessageEletter($email_id);
			$messageTEXT = 'Akademia Stosowania Prawa - potwierdzenie rejestracji na newsletter';
		} else {
			$messageHTML = $messagemail->getMessageTraining($email_id, $training_name, $participant_id);
			$messageTEXT = 'Akademia Stosowania Prawa - potwierdzenie rejestracji na szkolenie';		
		}
		
		//echo $messageHTML;
		
		$mail->From     = "mailing@grotowski.pl";
		$mail->FromName = "KGR";
		$mail->Host     = "grotowski.pl";
		$mail->CharSet  = "iso-8859-2";
		$mail->Subject  = "KGR (newsletter)";
		$mail->Mailer   = "smtp";
		$mail->Username = "mailing@grotowski.pl";
		$mail->Password = "noweprawo2002";
		$mail->SMTPAuth = true;
	
		$mail->Body    = $messageHTML;
		$mail->AltBody = $messageTEXT;
		$mail->AddAddress($email, $email);
						
		if(!$mail->Send()) {
			$mail->ClearAddresses();
			return $mail->ErrorInfo;
		} else {
			$mail->ClearAddresses();
			return 0;
		}		
	}	
?>
