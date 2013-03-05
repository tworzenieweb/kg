<?php

$name    = $_POST['imie'] ; 
$to     = "konrad.grotowski@grotowski.pl";
$from    = $_POST['email'];
$subject = "Informacja z formularza (www.grotowski.pl)";
$phone   = $_POST['telefon'];
 
$headers = "MIME-Version: 1.0\r\n".
   "Content-type: text/html; charset=iso-8859-2\r\n".
   "From: \"www.grotowski.pl - Formularz\" <".$to.">\r\n".
   "To: \"Konrad Grotowski\" <".$to.">\r\n".
   "Date: ".date("r")."\r\n".
   "Subject: ".$subject."\r\n";

 
$message = 
'<html><head>'.
'<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />'.
'</head><body>'.
'<p>Pan/i '.$name.' w dniu '.date("r").' napisał/a:</p>'.$_POST['wiadomosc'].
'<p><br /><br />Adres email: <a href="mailto:'.$_POST['email'].'">'.$_POST['email'].'</a></p>'.
'<p>Telefon: '.$phone.' </p>'.
'</body>'.
'</html>';

 mail($to,  $subject, $message, $headers);

  if ( isset($_GET['en']) ) {
   	 header("Location: http://www.grotowski.pl/en/info.php?id=1");
  } 
  header("Location: http://www.grotowski.pl/pl/info.php?id=1");
?>