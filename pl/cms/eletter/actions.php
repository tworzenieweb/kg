<ul>
<?php if ($page->pageId	== 1) { //Lista adresów email ?>
	<li><a href="?action=edit&navigate=emailbase"><img src="../img/action/new_f2.png" title="Nowy" width="32" height="32" border="0" /><br/>Nowy</a></li>
	<li><a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Wybierz pozycje którym chcesz zmienic status akceptacji!'); } else { submitbutton('change_accept') };"><img src="../img/action/potwierdz.png" title="Zmienia status potwierdzenia" width="32" height="32" border="0" /><br/>
  Potwierd&#378;</a></li>
	<li><a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Wybierz pozycje które chcesz usunac!'); } else { submitbutton('delete'); }"><img src="../img/action/cancel_f2.png" title="Usuwa wybrane pozycje" width="32" height="32" border="0" /><br/>Usu&#324;</a></li>			
<?php }?>	
<?php if (($page->pageId == 2) or  ($page->pageId == 3) ){ //Nowy lub edycja ?>
	<li><a href="javascript:submitbutton('accept');"><img src="../img/action/apply_f2.png" title="Zapisuje zmiany i przechodzi do listy" width="32" height="32" border="0" /><br/>Akceptuj</a></li>
	<li><a href="javascript:submitbutton('save');"><img src="../img/action/save_f2.png" title="Zapisuje zmiany" width="32" height="32" border="0" /><br/>Zapisz</a></li>
	<li><a href="javascript:submitbutton('cancel');"><img src="../img/action/restore_f2.png" title="Powrót do listy" width="32" height="32" border="0" /><br/>Anuluj</a></li>
<?php }?>	
<?php if ($page->pageId	== 5) { //Lista szablonów mailowych ?>
	<li><a href="?action=new&navigate=mail_template"><img src="../img/action/new_f2.png" title="Nowy" width="32" height="32" border="0" /><br/>Nowy</a></li>
	<?php //<li><a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Wybierz pozycje którym chcesz zmienic status widocznosci!'); } else { submitbutton('change_accept') };"><img src="../img/action/apply.png" title="Zmienia status widocznosci" width="32" height="32" border="0" /><br/>Potwierd&#378;</a></li> ?>
	<li><a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Wybierz pozycje które chcesz usunac!'); } else { submitbutton('delete'); }"><img src="../img/action/cancel_f2.png" title="Usuwa wybrane pozycje" width="32" height="32" border="0" /><br/>Usu&#324;</a></li>			
<?php }?>	
<?php if ($page->pageId	== 6) { //Nowy szablon mailowy ?>
	<li><a href="javascript:submitbutton('add_list');"><img src="../img/action/apply_f2.png" title="Zapisuje zmiany i przechodzi do listy" width="32" height="32" border="0" /><br/>Akceptuj</a></li>
	<li><a href="javascript:submitbutton('add');"><img src="../img/action/save_f2.png" title="Zapisuje dane" width="32" height="32" border="0" /><br/>Zapisz</a></li>
	<li><a href="javascript:submitbutton('cancel');"><img src="../img/action/restore_f2.png" title="Powrót do listy" width="32" height="32" border="0" /><br/>Anuluj</a></li>
<?php }?>	
<?php if ($page->pageId	== 7) { //Edycja szablonu mailowego ?>
	<li><a href="javascript:openwindow('mail_template_view.php?message_id=1&template_id=<?=$_POST['id'] ?>');"><img src="../img/action/preview_f2.png" title="Prezentacja szablonu w nowym oknie" width="32" height="32" border="0" /><br/>  Podgl±d</a></li>
	<li><a href="javascript:submitbutton('accept');"><img src="../img/action/apply_f2.png" title="Zapisuje zmiany i przechodzi do listy" width="32" height="32" border="0" /><br/>Akceptuj</a></li>
	<li><a href="javascript:submitbutton('save');"><img src="../img/action/save_f2.png" title="Zapisuje zmiany" width="32" height="32" border="0" /><br/>Zapisz</a></li>
	<li><a href="javascript:submitbutton('cancel');"><img src="../img/action/restore_f2.png" title="Powrót do listy" width="32" height="32" border="0" /><br/>Anuluj</a></li>
<?php }?>	
<?php if ($page->pageId	== 8) { //Lista wiadomo¶ci ?>
	<li><a href="?action=edit&navigate=messagemail"><img src="../img/action/new_f2.png" title="Nowy" width="32" height="32" border="0" /><br/>Nowy</a></li>
	<li><a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Wybierz pozycje którym chcesz zmienic status akceptacji!'); } else { submitbutton('change_accept') };"><img src="../img/action/apply.png" title="Zmienia status potwierdzenia" width="32" height="32" border="0" /><br/>Potwierd&#378;</a></li>
	<li><a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Wybierz pozycje które chcesz usunac!'); } else { submitbutton('delete'); }"><img src="../img/action/cancel_f2.png" title="Usuwa wybrane pozycje" width="32" height="32" border="0" /><br/>Usu&#324;</a></li>			
<?php }?>	
<?php if ($page->pageId	== 9) { //Nowa wiadomo¶æ ?>
	<li><a href="javascript:submitbutton('accept');"><img src="../img/action/apply_f2.png" title="Zapisuje zmiany i przechodzi do listy" width="32" height="32" border="0" /><br/>Akceptuj</a></li>
	<li><a href="javascript:submitbutton('save');"><img src="../img/action/save_f2.png" title="Zapisuje dane" width="32" height="32" border="0" /><br/>Zapisz</a></li>
	<li><a href="javascript:submitbutton('cancel');"><img src="../img/action/restore_f2.png" title="Powrót do listy" width="32" height="32" border="0" /><br/>Anuluj</a></li>
<?php }?>	
<?php if ($page->pageId	== 10) { //Edycja wiadomo¶ci ?>
	<li><a href="javascript:submitbutton('accept');"><img src="../img/action/apply_f2.png" title="Zapisuje zmiany i przechodzi do listy" width="32" height="32" border="0" /><br/>Akceptuj</a></li>
	<li><a href="javascript:submitbutton('save');"><img src="../img/action/save_f2.png" title="Zapisuje zmiany" width="32" height="32" border="0" /><br/>Zapisz</a></li>
	<li><a href="javascript:submitbutton('cancel');"><img src="../img/action/restore_f2.png" title="Powrót do listy" width="32" height="32" border="0" /><br/>Anuluj</a></li>
<?php }?>	
<?php if ($page->pageId	== 11) { //Lista wiadomo¶ci ?>
	<li><a href="?action=edit&navigate=shipping"><img src="../img/action/new_f2.png" title="Nowy" width="32" height="32" border="0" /><br/>Nowy</a></li>
	<li><a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Wybierz pozycje którym chcesz zmienic status akceptacji!'); } else { submitbutton('change_accept') };"><img src="../img/action/apply.png" title="Zmienia status potwierdzenia" width="32" height="32" border="0" /><br/>Potwierd&#378;</a></li>
	<li><a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Wybierz pozycje które chcesz usunac!'); } else { submitbutton('delete'); }"><img src="../img/action/cancel_f2.png" title="Usuwa wybrane pozycje" width="32" height="32" border="0" /><br/>Usu&#324;</a></li>			
<?php }?>	
<?php if (($page->pageId == 12) or ($page->pageId == 13)){ //Lista wiadomo¶ci ?>
	<li><a href="javascript:submitbutton('send');"><img src="../img/action/upload_f2.png" title="Zapisuje dane i przechodzi do wysy³ki" width="32" height="32" border="0" /><br/>Wy¶lij</a></li>
	<li><a href="javascript:submitbutton('addHandling');"><img src="../img/action/add32.png" title="Zapisuje zmiany i przechodzi do listy" width="32" height="32" border="0" /><br/>
  Dodaj</a></li>
	<li><a href="javascript:submitbutton('deleteHandling');"><img src="../img/action/delete3.png" title="Zapisuje zmiany i przechodzi do listy" width="32" height="32" border="0" /><br/>
  Usuñ</a></li>
	<li><a href="javascript:submitbutton('addAllHandling');"><img src="../img/action/add32_2.png" title="Zapisuje zmiany i przechodzi do listy" width="32" height="32" border="0" /><br/>
  (+) wszyst.</a></li>
	<li><a href="javascript:submitbutton('deleteAllHandling');"><img src="../img/action/delete2.png" title="Zapisuje zmiany i przechodzi do listy" width="32" height="32" border="0" /><br/>
  (-) wszyst.</a></li>
	<li><a href="javascript:submitbutton('accept');"><img src="../img/action/apply_f2.png" title="Zapisuje zmiany i przechodzi do listy" width="32" height="32" border="0" /><br/>
  Akceptuj</a></li>
	<li><a href="javascript:submitbutton('save');"><img src="../img/action/save_f2.png" title="Zapisuje zmiany" width="32" height="32" border="0" /><br/>Zapisz</a></li>
	<li><a href="javascript:submitbutton('cancel');"><img src="../img/action/restore_f2.png" title="Powrót do listy" width="32" height="32" border="0" /><br/>Anuluj</a></li>
<?php }?>	

    <li><a href="#" onclick="windowhelp()"><img src="../img/action/help_f2.png" title="Pomoc" border="0" /><br/>Pomoc</a></li>
</ul>	
