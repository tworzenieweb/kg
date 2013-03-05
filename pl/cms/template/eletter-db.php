<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<title>EasyCMS - <?=$page_title?></title>
<link href="../css/mainstyle.css" rel="stylesheet" type="text/css" />
<script language="Javascript" src="../js/hint.js"></script>
<script language="Javascript" src="../js/global.js"></script>
</head>
<body id="body-id" onload="inputFocus('<?=$input_focus ?>')">
  <form action="db.php" name="adminForm" method="post" >
	<div id="page">
	  <div id="page-header"><img src="../img/header-logo.jpg" alt="EasyCMS" width="230" height="42" border="0" /></div>
		<div id="page-menu">		  
		  <ul>
		    <li><a href="../go">Strona główna</a></li>
			<li><a href="../szkolenia">Szkolenia</a></li>
			<li><a href="../modyfikacje">Modyfikacja stron</a></li>
			<li><a href="../eletter" class="active">Newsletter</a></li>
			<li><a href="../admin">Administracja</a></li>
	      </ul>
		  <div id="logout-text"> <a href="../go?logout=1" class="balack-bold" > Wyloguj</a></div>
	    </div>
		<div id="page-action">
		<p><a href="../go" class="path">Strona główna</a> / <a href="" class="path">Newsletter</a> / Baza danych </p>
		  <ul>
		    <?php if (!(($_GET['action']=='new') or ($_GET['action']=='edit') or ($_POST['action']=='new')  or ($_POST['action']=='edit'))) { ?>
			
			<li><a href="db.php?action=new"><img src="../img/action/new_f2.png" alt="Nowy" width="32" height="32" border="0" /><br/>Nowy</a></li>
		    <li><a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Wybierz pozycje którym chcesz zmienić status akceptacji!'); } else { submitbutton('change_accept') };"><img src="../img/action/apply.png" alt="Nowy" width="32" height="32" border="0" /><br/>Potwierdź</a></li>
			<li><a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Wybierz pozycje które chcesz usunąć!'); } else { submitbutton('delete'); }"><img src="../img/action/cancel_f2.png" alt="Usuń" width="32" height="32" border="0" /><br/>Usuń</a></li>			
			<? } else { ?>
			<li><a href="javascript:submitbutton('<?=$accept_action_name?>');"><img src="../img/action/apply_f2.png" alt="Nowy" width="32" height="32" border="0" /><br/>Akceptuj</a></li>
			<li><a href="javascript:submitbutton('<?=$save_action_name?>');"><img src="../img/action/save_f2.png" alt="Nowy" width="32" height="32" border="0" /><br/>Zapisz</a></li>
			<li><a href="db.php"><img src="../img/action/restore_f2.png" alt="Nowy" width="32" height="32" border="0" /><br/>Anuluj</a></li>
			<? } ?>
		    <li><a href="#" onclick="windowhelp()"><img src="../img/action/help_f2.png" alt="Pomoc" border="0" /><br/>Pomoc</a></li>
		  </ul>	
	  </div>
	  <div id="page-body">	   
	  	  
	    <div id="page-body-context">
		  <h1 class="context-header">Newsletter <span>[<?=$page_title?>]</span></h1>
	      <p><img src="../img/pageicon/message_config.png" width="48" height="48" border="0" class="context-icon" /></p>
		  <?= //'<p>'.$_GET['action'].', '. $_POST['action'].'</p>' ?>
		  <input type="hidden" name="action" value="<?=$default_action ?>" />
		  <input type="hidden" name="table_sort_column" value="<?=$_POST['table_sort_column']?>" />
		  <input type="hidden" name="table_sort_type" value="<?=$_POST['table_sort_type']?>" />
		  <input name="boxchecked" value="0" type="hidden" />
		  <input name="changefind" value="0" type="hidden" />
		  <input name="list_start_position"  type="hidden" value="<?=$eletter->position ?>" />
		  
		  <?php	
		  include($include_page);
		  ?>
		  <?php if (!(($_GET['action']=='new') or ($_GET['action']=='edit') or ($_POST['action']=='new')  or ($_POST['action']=='edit') or ($_POST['action']=='save'))) { ?>
		  <table border="0" cellspacing="0" cellpadding="0" width="100%">            
               <tr>
                 <td class="tb-find"><label>Filtruj</label>
                   <select name="filter" onchange="document.adminForm.submit();">
                     <option value="" <?=($_POST['filter']=='')?'selected="selected"':''?>>Wszystkie pozycje</option>
                     <option value="wpis ręczny" <?=($_POST['filter']=='wpis ręczny')?'selected="selected"':''?>>Wpisy ręczne</option>
                     <option value="formularz rejs." <?=($_POST['filter']=='formularz rejs.')?'selected="selected"':''?>>Wpisy z formularza rejestracyjnego</option>
                     <option value="newsletter" <?=($_POST['filter']=='newsletter')?'selected="selected"':''?>>Wpisy z zapisu na newsletter</option>
					 <option value="import" <?=($_POST['filter']=='import')?'selected="selected"':''?>>Import z plików</option>
                   </select>
                 </td>
                 <td width="200" class="tb-find"><label>Szukaj</label>
                 <input type="text" name="find" onchange="document.adminForm.submit();" value="<?=$_POST['find']?>" /></td>
               </tr>
          </table>		 
			   		     	      		  
		  <table class="tab" cellpadding="0" cellspacing="0" width="100%">
		  	<col width="3%" />
			<col width="3%" />
			<col width="3%" />
			<col width="20%" />
			<col width="30%" />
			<col width="10%" />
			<col width="15%" />
			<col width="10%" />
			<col width="5%" />
			<col width="5%" />
          	<thead>
            	<tr>
				   <td align="center">Lp</td>
                   <td align="center"><input name="toggle" value="" onclick="checkAll(<?=$eletter->limit ?>);" type="checkbox" /></td>
				   <td align="center"><a href="javascript:columnsort('id');">Info</a></td>
				   <td><a href="javascript:columnsort('name');">Imie i nazwisko</a></td>
                   <td><a href="javascript:columnsort('email');">Adres e-mail</a></td>
				   <td align="center"><a href="javascript:columnsort('accept');">Potwierdzone</a></td>
                   <td><a href="javascript:columnsort('source');">Źródło</a></td>				   
				   <td><a href="javascript:columnsort('type');">Typ źródła</a></td>
				   <td align="center">Edytuj</td>
                   <td align="center">Usuń</td>                   
                </tr>
            </thead>
			 <tbody>	  
		  <?php 		  	
		  	$i = 1;	$j = 0;
			$lp = $eletter->position + 1;
		    if ( is_array( $emails_list ) ) { 
				foreach( $emails_list as $object ) { 
						$name_value = ($object->name=='')?'&nbsp;':$object->name;
						$pic_accept = ($object->accept)?'<img src="../img/small/tick.png" alt="Wpis potwierdzony" width="12" height="12" />':'<img src="../img/small/no-accept.gif" alt="save" width="12" height="12" />';
						
						echo '<tr class="row'.$i.'">';
						echo '  <td align="right">'.$lp.'</td>';
						echo '  <td align="center"><input id="cb'.$j.'" name="cid[]" type="checkbox" value="'.$object->id.'" onclick="isChecked(this.checked);" /></td>';					
						echo '  <td><img src="../img/small/con_info.png" alt="" width="16" height="16" '.createHint(array('<b>Identyfikator:</b> '.$object->id,'<b>Data zapisu:</b>',$object->date),'CAPTION','Informacje dodatkowe').'/></td>';
						echo '  <td>'.$name_value.'</td>';
						echo '  <td><a href="mailto:'.$object->email.'">'.$object->email.'</td>';
						echo '  <td align="center"><a href="javascript: void(0);" onclick="return listItemTask(\'cb'.$j.'\',\'change_accept\')">'.$pic_accept.'</a></td>';
						echo '  <td>'.$object->source.'</td>';
						echo '  <td>'.$object->type.'</td>'; 
						echo '  <td align="center"><a href="db.php?action=edit&id='.$object->id.'"><img src="../img/small/publish_g.png" alt="Edytuj" width="12" height="12" /></a></td>';
						echo '  <td align="center"><a href="javascript: void(0);" onclick="return listItemTask(\'cb'.$j.'\',\'delete\')"><img src="../img/small/publish_x.png" alt="Usuń" width="12" height="12" /></a></td>';
						echo '</tr>';
						$i = ($i==1)?0:1;
						$j++; $lp++;
				}
			} 
			 
		  ?>
		  	</tbody>
		  </table>
			<table class="tab" border="0" cellspacing="0" cellpadding="0" width="100%">
			<tfoot>
               <tr>
                 <td width="200" >Wszystkoch rekordów: # <?=$eletter->record_count;?></td>
				 <td ><div align="center"><?=$eletter->navigationString();?></div></td>
				 <td width="155" ><div align="right">Ilość rekordów na stronie:</div></td>
				 <td width="45"><div align="right">
				   <select name="list_limit" class="inp-style1" onchange="submitbutton('change_limit')">
				     <option value="5"  <?=($eletter->limit==5)?'selected="selected"':''?>>5</option>
				     <option value="10" <?=($eletter->limit==10)?'selected="selected"':''?>>10</option>
				     <option value="15" <?=($eletter->limit==15)?'selected="selected"':''?>>15</option>
				     <option value="20" <?=($eletter->limit==20)?'selected="selected"':''?>>20</option>
				     <option value="25" <?=($eletter->limit==25)?'selected="selected"':''?>>25</option>
				     <option value="30" <?=($eletter->limit==30)?'selected="selected"':''?>>30</option>
				     <option value="35" <?=($eletter->limit==35)?'selected="selected"':''?>>35</option>
				     <option value="40" <?=($eletter->limit==40)?'selected="selected"':''?>>40</option>
				     <option value="50" <?=($eletter->limit==50)?'selected="selected"':''?>>50</option>
				     <option value="80" <?=($eletter->limit==80)?'selected="selected"':''?>>80</option>
				     <option value="100" <?=($eletter->limit==100)?'selected="selected"':''?>>100</option>
				   </select>
				 </div></td>
               </tr>
            </tfoot>
          </table>
		 
		  
	      <?php } else { ?> 
		  <div class="gray-panel">
		  	<table width="383" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td width="89">Imię i nazwisko </td>
    <td width="269"><input class="inp-style1" type="text" name="name" value="<?=$_POST['name'] ?>" /></td>
    <td width="25"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr>
    <td>Adres e-mail </td>
    <td><input class="inp-style1" type="text" name="email" value="<?= $_POST['email'] ?>" /></td>
    <td><div align="right"><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16"/></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>Rodzaj wpisu </td>
    <td><input class="inp-style1" type="text" name="source" value="<?=$_POST['source'] ?>" /></td>
    <td><div align="right"><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" /></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr>
    <td>Źródło</td>
    <td><input class="inp-style1" type="text" name="type" value="<?=$_POST['type'] ?>" /></td>
    <td><div align="right"><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" /></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr>
    <td>Potwierdzony</td>
    <td>
		<input name="mail_accept" type="checkbox" value="1" <?=($_POST['mail_accept'])?'checked':''?> />
		<input type="hidden" name="find" value="<?=$_POST['find']?>" />
		<input type="hidden" name="filter" value="<?=$_POST['filter']?>" />
		<input type="hidden" name="id" value="<?=$_POST['id']?>" />
	</td>      
    <td></td>
  </tr>
</table>

		  </div>
	      <?php } ?>
		  
	    </div>
	  </div>
	  <div id="left-menu">	
		 <ul>
		   <li><a href="db.php" class="active">Baza adresów email</a></li>
		   <li><a href="message.php" >Wiadomości</a></li>
		   <li><a href="template.php">Szablony wiadomości</a></li>
		   <li><a href="send.php">Wysyłka</a></li>
		   <li><a href="report.php">Raporty</a></li>
	     </ul>	
		 <div class="menu-line">.</div>	
	  </div>
	  <div id="page-footer">
		   <p>Copyright &copy; <a href="http://www.sadkosoft.com.pl" target="_blank"><b>Sadkosoft</b></a></p>
	  </div>
	</div>
  </form>
</body>
</html>
