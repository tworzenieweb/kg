<?php
require_once( '../class/config.php' );
//require_once( '../class/class.main.php' );
require_once( 'class/class.participant.php' );

	if ( isset($_GET['accept']) ) 
	{
		$db = &new Database( USER, PASSWORD, DATABASE, HOST );
		$participant = new Participant( $db );	
		$participant->acceptSubscription( $_GET['accept'] );	
		$message = '<p>Twój udział w szkoleniu został potwierdzony.</p>';
	} else {
		$message  = '<p>Wystąpił problem techniczny i twoje uczestnictwo w szkoleniu nie zostało potwierdzone automatycznie!</p>';
		$message .= '<p>Prosimy o kontak mailowy lub telefoniczny w celu dokończenie akceptacji.</p>';
		$message .= '<p>Przepraszamy za utrudnienia!</p>';
	}
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<title>Akceptacja subskrypcji szkolenia</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style></head>
	 
<body>
<p align="center"><strong>Akademia Stosowania Prawa </strong></p>
<div align="center"><?php echo $message ?>
</div>
</body>
</html>
