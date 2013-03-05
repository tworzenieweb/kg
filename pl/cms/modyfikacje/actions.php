<ul>
<?php if ($page->pageId	== 41) { //Lista stron ?>
	<li><a href="javascript:if (document.adminForm.boxchecked.value != 0){ alert('Aby utorzyæ nowe szkolenie musisz odznaczyæ wszystkie pozycje na li¶cie!'); } else { submitbutton('edit') };"><img src="../img/action/new_f2.png" title="Nowy" width="32" height="32" border="0" /><br/>Nowy</a></li>
	<li><a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Wybierz pozycje które chcesz usunac!'); } else { submitbutton('delete'); }"><img src="../img/action/cancel_f2.png" title="Usuwa wybrane pozycje" width="32" height="32" border="0" /><br/>Usu&#324;</a></li>			
<?php }?>	
<?php if (($page->pageId == 42) or ($page->pageId == 43)){ //Nowy lub edycja ?>
    <li><a href="javascript:submitbutton('published');"><img src="../img/action/upload_f2.png" title="Zapisuje zmiany i publikuje je na stronie" width="32" height="32" border="0" /><br/>Publikuj</a></li>
	<li><a href="javascript:submitbutton('unpublish');"><img src="../img/action/delete_f2.png" title="Przywraca informacje ze strony" width="32" height="32" border="0" /><br/>Wycofaj</a></li>
	<li><a href="javascript:submitbutton('accept');"><img src="../img/action/apply_f2.png" title="Zapisuje zmiany i przechodzi do listy" width="32" height="32" border="0" /><br/>Akceptuj</a></li>
	<li><a href="javascript:submitbutton('save');"><img src="../img/action/save_f2.png" title="Zapisuje zmiany" width="32" height="32" border="0" /><br/>Zapisz</a></li>
	<li><a href="javascript:submitbutton('cancel');"><img src="../img/action/restore_f2.png" title="Powrót do listy" width="32" height="32" border="0" /><br/>Anuluj</a></li>
<?php }?>	
<?php if ($page->pageId == 44) { ?>
	<li><a href="javascript:if (document.adminForm.boxchecked.value != 0){ alert('Aby utorzyæ nowe pozycjê musisz odznaczyæ wszystkie pozycje na li¶cie!'); } else { submitbutton('edit') };"><img src="../img/action/new_f2.png" title="Nowy" width="32" height="32" border="0" /><br/>Nowy</a></li>
	<li><a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Wybierz pozycje które chcesz usunac!'); } else { submitbutton('delete'); }"><img src="../img/action/cancel_f2.png" title="Usuwa wybrane pozycje" width="32" height="32" border="0" /><br/>Usu&#324;</a></li>			
<?php }?>	
<?php if (($page->pageId == 45) or ($page->pageId == 46) ) { ?>
	<li><a href="javascript:submitbutton('accept');"><img src="../img/action/apply_f2.png" title="Zapisuje zmiany i przechodzi do listy" width="32" height="32" border="0" /><br/>Akceptuj</a></li>
	<li><a href="javascript:submitbutton('save');"><img src="../img/action/save_f2.png" title="Zapisuje dane" width="32" height="32" border="0" /><br/>Zapisz</a></li>
	<li><a href="javascript:submitbutton('cancel');"><img src="../img/action/restore_f2.png" title="Powrót do listy" width="32" height="32" border="0" /><br/>Anuluj</a></li>
<?php }?>	
<?php if (($page->pageId == 49)){ ?>
	<li><a href="http://www.grotowski.pl/pl/?view&page=<?=$record_id?>" target="_blank" ><img src="../img/action/preview_f2.png" title="Podgl±d zmian" width="32" height="32" border="0" /><br/>Podgl±d</a></li>
    <li><a href="javascript:submitbutton('published');"><img src="../img/action/upload_f2.png" title="Zapisuje zmiany i publikuje je na stronie" width="32" height="32" border="0" /><br/>Publikuj</a></li>
	<li><a href="javascript:submitbutton('unpublish');"><img src="../img/action/delete_f2.png" title="Przywraca informacje ze strony" width="32" height="32" border="0" /><br/>Wycofaj</a></li>
	<li><a href="javascript:submitbutton('accept');"><img src="../img/action/apply_f2.png" title="Zapisuje zmiany i przechodzi do listy" width="32" height="32" border="0" /><br/>Akceptuj</a></li>
	<li><a href="javascript:submitbutton('save');"><img src="../img/action/save_f2.png" title="Zapisuje zmiany" width="32" height="32" border="0" /><br/>Zapisz</a></li>
	<li><a href="javascript:submitbutton('cancel');"><img src="../img/action/restore_f2.png" title="Powrót do listy" width="32" height="32" border="0" /><br/>Anuluj</a></li>
<?php }?>	
    <li><a href="#" onclick="windowhelp()"><img src="../img/action/help_f2.png" title="Pomoc" border="0" /><br/>Pomoc</a></li>
</ul>	
