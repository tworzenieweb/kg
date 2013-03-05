<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<title><?=(isset($_GET['view']))?$pageinfo->title_m:$pageinfo->title ?></title>
<link href="../res/css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../res/js/main.js"></script>
</head>
<body id="body-page" onload="MM_preloadImages('../res/pic/menu-w/s-oferta.jpg','../res/pic/menu-w/s-doswiadczenie.jpg','../res/pic/menu-w/s-wyklady.jpg','../res/pic/menu-w/s-kontakt.jpg')">
	<div id="header">
		<div id="header-left" class="arrow-en"><a href="?home" class="home-page">HOME PAGE</a></div>
		<div id="header-right"><a href="../pl/?page=<?=$_GET['page']-4 ?>" class="english">Wersja polska</a></div>
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
		<p>&nbsp;</p>
</div>
	<div id="menu">
	  <div id="logo-en"></div>	
	  <ul>
	    <li><?=($_GET['page']==5)?'<img src="../res/pic/menu-w/s-offer.jpg" alt="Oferta" />':'<a href="?page=5" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(\'offer\',\'\',\'../res/pic/menu-w/s-offer.jpg\',1)"><img src="../res/pic/menu-w/n-offer.jpg" alt="Offer" name="offer" width="116" height="11" border="0" id="offer" /></a>' ?></li>
		<li><?=($_GET['page']==6)?'<img src="../res/pic/menu-w/s-experience.jpg" alt="Doświadczenie" />':'<a href="?page=6" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(\'experience\',\'\',\'../res/pic/menu-w/s-experience.jpg\',1)"><img src="../res/pic/menu-w/n-experience.jpg" alt="Experience" name="experience" width="116" height="11" border="0" id="experience" /></a>' ?></li>
		<li><?=($_GET['page']==7)?'<img src="../res/pic/menu-w/s-lectures.jpg" alt="Wykłady" />':'<a href="?page=7" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(\'lectures\',\'\',\'../res/pic/menu-w/s-lectures.jpg\',1)"><img src="../res/pic/menu-w/n-lectures.jpg" alt="Lectures" name="lectures" width="116" height="11" border="0" id="lectures" /></a>' ?></li>
		<li><?=($_GET['page']==8)?'<img src="../res/pic/menu-w/s-contact.jpg" alt="Kontakt" />':'<a href="?page=8" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(\'contact\',\'\',\'../res/pic/menu-w/s-contact.jpg\',1)"><img src="../res/pic/menu-w/n-contact.jpg" alt="Contact" name="contact" width="116" height="11" border="0" id="contact" /></a>' ?></li>
      </ul>
	  <div id="line"></div>
	  <div id="napisz"><a href="?page=8">Feedback</a></div>
    </div>
	<div id="footer">	
		<div id="sadkosoft"><a href="http://www.sadkosoft.com.pl/?soure=grotowski" target="_blank">Created by Sadkosoft</a></div>
		<div id="copyright">Copyright &copy; Konrad Grotowski</div>
		<div id="kgr"></div>
	</div>
	<div id="footer-shadow"></div>
</body>
</html>
