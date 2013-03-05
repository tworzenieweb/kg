<?php
	switch ( $_GET['id'] ) {	
		case 1:
			$i_context = '<h3>Wysyłanie wiadomości</h3><p>Twoja wiadomość została wysłana! Dziękujemy.</p>';
			$i_title   = 'Informacja';
		break;	
		case 2:
			$i_context = '<h3>Nieznay adres</h3><p>Nie istnieje strona o podanym adresie!</p>';
			$i_title   = 'Informacja';
		break;			
		default:
			$i_context = '';
			$i_title   = 'Informacja';	
	}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<title>Konrad Grotowski</title>
<link href="../res/css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../res/js/main.js"></script>
</head>
<body id="body-page" onload="MM_preloadImages('../res/pic/menu-w/s-oferta.jpg','../res/pic/menu-w/s-doswiadczenie.jpg','../res/pic/menu-w/s-wyklady.jpg','../res/pic/menu-w/s-kontakt.jpg')">
	<div id="header">
		<div id="header-left" class="arrow-pl"><a href="http://www.grotowski.pl/pl/?home" class="home-page">STRONA GŁÓWNA</a></div>
		<div id="header-right"><a href="../en/?page=<?=$_GET['page']+4 ?>" class="english">English version</a></div>
	</div>		
<div id="context">
		<div id="title-header">
			<h1><?=$i_title ?></h1>
			<div id="pic" class="kontakt"></div>			
		</div>		
		<?=$i_context ?>
		<p>&nbsp;</p>
</div>
	<div id="menu">
	  <div id="logo"></div>	
	  <ul>
	    <li><?=($_GET['page']==1)?'<img src="../res/pic/menu-w/s-oferta.jpg" alt="Oferta" />':'<a href="/pl/?page=1" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(\'oferta\',\'\',\'../res/pic/menu-w/s-oferta.jpg\',1)"><img src="../res/pic/menu-w/n-oferta.jpg" alt="Oferta" name="oferta" width="116" height="11" border="0" id="oferta" /></a>' ?></li>
		<li><?=($_GET['page']==2)?'<img src="../res/pic/menu-w/s-doswiadczenie.jpg" alt="Doświadczenie" />':'<a href="/pl/?page=2" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(\'doswiadczenie\',\'\',\'../res/pic/menu-w/s-doswiadczenie.jpg\',1)"><img src="../res/pic/menu-w/n-doswiadczenie.jpg" alt="Doświadczenie" name="doswiadczenie" width="116" height="11" border="0" id="doswiadczenie" /></a>' ?></li>
		<li><?=($_GET['page']==3)?'<img src="../res/pic/menu-w/s-wyklady.jpg" alt="Wykłady" />':'<a href="/pl/?page=3" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(\'wyklady\',\'\',\'../res/pic/menu-w/s-wyklady.jpg\',1)"><img src="../res/pic/menu-w/n-wyklady.jpg" alt="Wykłady" name="wyklady" width="116" height="11" border="0" id="wyklady" /></a>' ?></li>
		<li><?=($_GET['page']==4)?'<img src="../res/pic/menu-w/s-kontakt.jpg" alt="Kontakt" />':'<a href="/pl/?page=4" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(\'kontakt\',\'\',\'../res/pic/menu-w/s-kontakt.jpg\',1)"><img src="../res/pic/menu-w/n-kontakt.jpg" alt="Kontakt" name="kontakt" width="116" height="11" border="0" id="kontakt" /></a>' ?></li>
      </ul>
	  <div id="line"></div>
	  <div id="napisz"><a href="?page=4">Napisz do nas</a></div>
    </div>
	<div id="footer">	
		<div id="sadkosoft"><a href="http://www.sadkosoft.com.pl" target="_blank">Created by Sadkosoft</a></div>
		<div id="copyright">Copyright &copy; Konrad Grotowski</div>
		<div id="kgr"></div>
	</div>
	<div id="footer-shadow"></div>
</body>
</html>
