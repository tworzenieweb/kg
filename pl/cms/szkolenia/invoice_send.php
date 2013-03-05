<?php


	$invoice_id  = $_GET['id'];
	$adres_email = $_GET['email'];


	function SendInvoice($messagemail, $mail, $inv_id, $adr_email) {
		
		//echo  'inv_id: '.$inv_id.' adres e-mail:'.$adr_email;
		
		$messageHTML = $messagemail->getMessageInvoice( $inv_id );
		$messageTEXT = 'Akademia Stosowania Prawa - faktura';
			
		//echo $messageHTML;	
		$mail->From     = "info@akademiastosowaniaprawa.pl";
		$mail->FromName = "Akademia Stosowania Prawa";
		$mail->Host     = "akademiastosowaniaprawa.pl";
		$mail->CharSet  = "iso-8859-2";
		$mail->Subject  = "Akademia Stosowania Prawa (newsletter)";
		$mail->Mailer   = "smtp";
		$mail->Username = "mailing@akademiastosowaniaprawa.pl";
		$mail->Password = "noweprawo2002";
		$mail->SMTPAuth = true;
		
		$mail->Body    = $messageHTML;
		$mail->AltBody = $messageTEXT;
		$mail->AddAddress($adr_email, $adr_email);
							
		if(!$mail->Send()) {
			$mail->ClearAddresses();
			return $mail->ErrorInfo;
		} else {
			$mail->ClearAddresses();
			return 0;
		}		
	}



	if (!(isset($_GET['id']))) {

		require_once( '../class/config.php' );
		include_once( '../class/phpmailer/class.phpmailer.php' ); 
		include_once( '../eletter/class/class.messagemail.php' );
	
		$db = &new Database( USER, PASSWORD, DATABASE, HOST );
			
		$messagemail = new MessageMail( $db );
		$mail        = new phpmailer();
			
		$result = SendInvoice($messagemail, $mail, $_POST['invoice_id'], $_POST['adres_email']);
		if ($result == 0) {
			$mes = 'Faktura wys³ana';
		} else {
			$mes = $result;
		}	
	}
	
	
?>
<html>
<head>
<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #F1F3F5;
}	
thead td {
	font-size: 14px;
	font-weight: bolder;
	color: #CCCCCC;
	background-color: #333333;
	padding-top: 5px;
	padding-right: 5px;
	padding-bottom: 5px;
	padding-left: 20px;
	margin: 0px;
	border-bottom-width: 4px;
	border-bottom-style: solid;
	border-bottom-color: #C04C33;
}	

.sinput {
	width: 100%;	
}
-->
</style>
</head>
<body>
	<form action="invoice_send.php" name="form" method="post" >	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <thead>
		  <tr>
			<td colspan="3">
				Wy¶lij fakturê
				<input type="hidden" name="action" value="send"  />
				<input type="hidden" name="invoice_id" value="<?=$invoice_id ?>" />	
			</td>
		  </tr>
	  </thead> 
	  <tbody>
		  <tr>
			<td width="10%">&nbsp;</td>
			<td width="80%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
		  </tr>
		  <?php if (isset($_GET['id'])) { ?>
		  <tr>
			<td>&nbsp;</td>
			<td>Adres email:</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td><input type="text" name="adres_email" value="<?=$adres_email ?>" class="sinput" /></td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td><div align="center">
			  <input type="submit" name="Wy¶lij" title="Wy¶lij" value="Wy¶lij"  />
			</div></td>
			<td>&nbsp;</td>
		  </tr>
		  <?php } else { ?>
		  <tr>
			<td>&nbsp;</td>
			<td><?=$mes; ?></td>
			<td>&nbsp;</td>
		  </tr>		  
		  <?php } ?>
	  </tbody>	  
	</table>
	</form>
</body>
