<?php
require("../class.phpmailer.php");


$mail = new phpmailer();

$mail->SetLanguage("pl");
$mail->From     = "andrzej.sadowski@sadkosoft.com.pl";
$mail->FromName = "List manager";
$mail->Host     = "sadkosoft.com.pl";
$mail->CharSet  = "iso-8859-2";
$mail->Subject  = "Wiadono¶æ testowa";
$mail->Mailer   = "smtp";

    // HTML body
    $body  = "Hello <font size=\"4\">W wersji UNICODE: &#261;&#347;</font>, <p>";
    $body .= "<i>Your</i> personal photograph to this message.<p>";
    $body .= "Sincerely, <br>";
    $body .= "phpmailer List manager";

    // Plain text body (for mail clients that cannot read HTML)
    $text_body  = "Polskie ogonki, \n\n";
    $text_body .= "¡ÊÆ¦¯¬Ñ ±êæ¶¿¼ñ.\n\n";
    $text_body .= "W wersji UNICODE: &#261;&#347;, \n";
    $text_body .= "phpmailer List manager";

    $mail->Body    = $body;
    $mail->AltBody = $text_body;
    //$mail->AddAddress('test@sadkosoft.com.pl', 'Misio fisio');
	$mail->AddAddress('test@sadk.osoft.com.', 'Misio fisio');
	//$mail->AddAddress('iwona.sadowska@pf.pl', 'Misio fisio');
    //$mail->AddStringAttachment($row["photo"], "YourPhoto.jpg");

    if(!$mail->Send()) {
        echo "nieudana wysy³ka test@sadkosoft.com.pl <br>";
		echo $mail->ErrorInfo;
	} else {
	    echo "Is OK";
	}
	if (!$mail->IsError()) {
		echo $mail->ErrorInfo;
	}
    // Clear all addresses and attachments for next loop
    $mail->ClearAddresses();
    $mail->ClearAttachments();


?>