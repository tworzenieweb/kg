<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<title>Template</title>
<link href="../css/mainstyle.css" rel="stylesheet" type="text/css" />
</head>
<body id="body-id">
	<div id="page">
	  <div id="page-header"><img src="../img/header_logo.png" alt="EasyCMS" width="233" height="38" border="0" /></div>
		<div id="page-menu">		  
		  <ul>
		    <li><a href="../go" class="active">Strona główna</a></li>
			<li><a href="../modyfikacje">Modyfikacja stron</a></li>
			<li><a href="../admin">Administracja</a></li>
	      </ul>
		  <div id="logout-text"> <a href="../go/?logout=1" class="balack-bold" > Wyloguj</a></div>
	    </div>
		<div id="page-action">
		<p><a href="../go" class="path">Strona główna</a></p>
		  <ul>		    
			<li><a href="/"><img src="../img/action/help_f2.png" alt="Pomoc" /><br/>Pomoc</a></li>
		  </ul>	
	  </div>
	  <div id="page-body-main">
	    <div id="page-title">
	    	<img src="../img/pageicon/cpanel.png" alt="Panel skrótów" width="48" height="48" align="left" />
	    	<h1>Panel skrótów</h1>
		</div>
	    <div id="icon-panel" class="float-left">
		   <ul>
		    
			<li><div class="icon-panel-item"><a href="../modyfikacje"><img src="../img/pageicon/addedit.png" alt="Pomoc" width="48" height="48" /><br/>
			  Modyfikacje stron statycznych</a></div></li>			
			<li><div class="icon-panel-item"><a href="../admin"><img src="../img/pageicon/systeminfo.png" alt="Pomoc" width="48" height="48" /><br/>
			  Administracja serwisem</a></div></li>			
		  </ul>	
		</div>
	    <div id="info-panel">
			<h2>Wiataj<?=' '.$_SESSION['user_login']?>!</h2>
			<p>Dziś jest <?=$pl_date?></p>
			<p>&nbsp;</p>
		</div>
	  </div>
	  <div id="page-footer">
		   <p>Copyright &copy; <a href="http://www.sadkosoft.com.pl" target="_blank"><b>Sadkosoft</b></a></p>
	  </div>
	</div>
</body>
</html>
