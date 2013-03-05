<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<title>EasyCMS - <?=$page->title ?></title>
<link href="../css/mainstyle.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../js/hint.js"></script>
<script language="javascript" type="text/javascript" src="../js/global.js"></script>
<?php include('scripts.php') ?>
</head>
<body id="body-id" onload="inputFocus('<?=$page->focus ?>')">
  <form action="index.php" name="adminForm" method="post" >
	<div id="page">
	  <div id="page-header"><img src="../img/header-logo.jpg" alt="EasyCMS" width="230" height="42" border="0" /></div>
		<div id="page-menu">		  
		  <ul>
		    <li><a href="../go">Strona główna</a></li>
			<li><a href="../modyfikacje" <?=($page->group_id==4)?'class="active"':'' ?>>Modyfikacja stron</a></li>
			<li><a href="../admin" <?=($page->group_id==3)?'class="active"':'' ?>>Administracja</a></li>
	      </ul>
		  <div id="logout-text"> <a href="../go?logout=1" class="balack-bold" > Wyloguj</a></div>
	    </div>
		<div id="page-action">
		<p><a href="../go" class="path">Strona główna</a> / <a href="<?=$page->menu_link?>" class="path"><?=$page->group_name?></a> / <?= $page->title ?> </p>
		  <?php include('actions.php'); ?>
	  </div>
	  <div id="page-body">	   
	  	  
	  <div id="page-body-context">		  
		<?php	include($page->include_context);  ?>
	  </div>
	  </div>
		<?php include($page->include_submenu); ?>
	  <div id="page-footer">
		   <p>Copyright &copy; <a href="http://www.sadkosoft.com.pl" target="_blank"><b>Sadkosoft</b></a></p>
	  </div>
	</div>
  </form>
</body>
</html>
