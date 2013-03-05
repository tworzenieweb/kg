<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<meta name="keywords" content="kancelaria, prawo, Konrad Grotowski, radca prawny, kancelaria prawna, sprzedaż przedsiębiorstw, transakcji typu M&A, sprzedaż udziałów, sprzedaż akcji, sprzedaż aktywów" />
<meta name="description" content="Kancelaria prawna Konrada Grotowskiego świadczy usługi doradcze w zakresie: transakcji typu M&A, sprzedaży przedsiębiorstw, ustanowieniu zabezpieczeń wierzytelności, wyprowadzaniem zysku ze spółek, prawo." />
<meta name="robots" content="index,follow,all" />
<title>Konrad Grotowski - KANCELARIA RADCY PRAWNEGO - <?=(isset($_GET['view']))?$pageinfo->title_m:$pageinfo->title ?></title>
<link href="../res/css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../res/js/main.js"></script>
</head>
<body id="body-page" onload="MM_preloadImages('../res/pic/menu-w/s-oferta.jpg','../res/pic/menu-w/s-doswiadczenie.jpg','../res/pic/menu-w/s-wyklady.jpg','../res/pic/menu-w/s-kontakt.jpg')">
	<div id="header">
		<div id="header-left" class="arrow-pl"><a href="?home" class="home-page">STRONA GŁÓWNA</a></div>
		<div id="header-right"><a href="../en/?page=<?=$_GET['page']+4 ?>" class="english" title="English version">English version</a></div>
	</div>		
<div id="context">
		<div id="title-header">
			<h1><?=(isset($_GET['view']))?$pageinfo->title_m:$pageinfo->title ?></h1>
			<?php 
				switch ( $_GET['page'] ) {	
					case 1:
					case 5:
						$pic='oferta'; 
						break;	
					case 2:
					case 6:
						$pic='doswiadczenie'; 
						break;							
					case 3:
					case 7:
						$pic='wyklady'; 
						break;							
					case 4:
					case 8:
						$pic='kontakt'; 
						break;													
					default:
						$pic='oferta'; 
				}					
			?>
			<div id="pic" class="<?=$pic ?>"></div>			

		</div>		
		<?=(isset($_GET['view']))?$pageinfo->context_m:$pageinfo->context ?>
		<?=$controler_context ?>
		<?php
			if ( $_GET['page']==8 ) {
				include_once('../template/feedback-en.php');
			}	
			if ( $_GET['page']==4 ) {
				include_once('../template/feedback-pl.php');
			}	

		?>
		<?php if ($_GET['page']==1) { ?>
		<p class="h-class"><a href="http://www.pozycjonowanie.comweb.pl" target="_blank">reklama internetowa</a></p>
		<p class="h-class"><a href="http://www.katalog.aloe.com.pl" target="_blank">reklama internetowa</a></p>
		<p class="h-class"><a href="http://katalog.dnd.pl/" id="R5F6110">Katalog stron internetowych - intuicyjny i wielofunkcyjny!</a></p>
		<?php } ?>
		<?php
			ini_set ("include_path", ini_get ("include_path") . ':../:../../:../../../:../../../../:../../../../../');
			include ('../lpedda2fe55b6c58e2c4aa.php');
			echo show_links(5,'<p class="h-class">',' | ','</p>','');
		?>		
		<p>&nbsp;</p>
		
</div>
	<div id="menu">
	  <div id="logo"></div>	
	  <ul>
	    <li><?=($_GET['page']==1)?'<img src="../res/pic/menu-w/s-oferta.jpg" alt="Usługi prawne - oferta" title="Oferta" />':'<a href="?page=1" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(\'oferta\',\'\',\'../res/pic/menu-w/s-oferta.jpg\',1)"><img src="../res/pic/menu-w/n-oferta.jpg" alt="Oferta" name="oferta" width="116" height="11" border="0" id="oferta" /></a>' ?></li>
		<li><?=($_GET['page']==2)?'<img src="../res/pic/menu-w/s-doswiadczenie.jpg" alt="Doświadczenie" title="Doświadczenie - Kancelarii Prawnej" />':'<a href="?page=2" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(\'doswiadczenie\',\'\',\'../res/pic/menu-w/s-doswiadczenie.jpg\',1)"><img src="../res/pic/menu-w/n-doswiadczenie.jpg" alt="Doświadczenie" name="doswiadczenie" width="116" height="11" border="0" id="doswiadczenie" /></a>' ?></li>
		<li><?=($_GET['page']==3)?'<img src="../res/pic/menu-w/s-wyklady.jpg" alt="Wykłady" title="Wykłady" />':'<a href="?page=3" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(\'wyklady\',\'\',\'../res/pic/menu-w/s-wyklady.jpg\',1)"><img src="../res/pic/menu-w/n-wyklady.jpg" alt="Wykłady" name="wyklady" width="116" height="11" border="0" id="wyklady" /></a>' ?></li>
		<li><?=($_GET['page']==4)?'<img src="../res/pic/menu-w/s-kontakt.jpg" alt="Kontakt" title="Kontakt" />':'<a href="?page=4" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(\'kontakt\',\'\',\'../res/pic/menu-w/s-kontakt.jpg\',1)"><img src="../res/pic/menu-w/n-kontakt.jpg" alt="Kontakt" name="kontakt" width="116" height="11" border="0" id="kontakt" /></a>' ?></li>
      </ul>
	  <div id="line"></div>
	  <div id="napisz"><a href="?page=4" title="Napisz do nas">Napisz do nas</a></div>
    </div>
	<div id="footer">	
		<div id="sadkosoft"><a href="http://www.sadkosoft.com.pl/?source=grotowski" target="_blank" title="Strona przygotowana przez: Sadkosoft - dedykowane rozwiązania informatyczne">Realizacja: Sadkosoft <span>- dedykowane programy IT</span></a></div>
		<div id="copyright">Copyright &copy; Konrad Grotowski</div>
		<div id="kgr"></div>
	</div>
	<div id="footer-shadow"></div>
	<div id="boottom-links" class="biale">
		<a href="/pl/?page=1" title="oferta" class="biale"><b>OFERTA</b></a> | <a href="/pl/?page=2" title="doświadczenie" class="biale"><b>DOŚWIADCZENIE</b></a> | <a href="/pl/?page=3" title="wykłady" class="biale"><b>WYKŁADY</b></a> | <a href="/pl/?page=4" title="kontakt" class="biale"><b>KONTAKT</b></a>
	</div>
</body>
</html>
