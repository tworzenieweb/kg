<?php
require_once( '../class/config.php' );
//require_once( '../class/class.main.php' );
require_once( 'class/class.emailbase.php' );

	if ( isset($_GET['un']) ) 
	{
		$db = &new Database( USER, PASSWORD, DATABASE, HOST );
		$mailbase = new MailBase( $db );	
		$mailbase->unsubscribeEmail( $_GET['un'] );	
		$message = '<p>Tw�j adres email zosta� usuni�ty.</p>';
	} else {
		$message  = '<p>Wyst�pi� problem techniczny i tw�j adres email nie zosta� usuni�ty!</p>';
		$message .= '<p>Prosimy o kontak mailowy w celu usuni�cia adresu.</p>';
		$message .= '<p>Przepraszamy za utrudnienia</p>';
	}
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<title>Usuni�cia adresu z bazy elettera</title>
</head>
	 
<body>
<p>Akademia Stosowania Prawa </p>
<?php echo $message ?>
</body>
</html>
