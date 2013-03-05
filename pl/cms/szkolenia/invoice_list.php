  		  <h1 class="context-header"><?=$page->title?></h1>
	      <p><img src="../img/pageicon/fv48.gif" width="48" height="48" border="0" class="context-icon" /></p>

		  <?= //'<p>'.$_GET['action'].', '. $_POST['action'].'</p>' ?>
		  <input name="action" type="hidden" value="" />
		  <input name="default_action" type="hidden" value="<?=$page->default_action ?>" />
		  <input name="table_sort_column" type="hidden" value="<?=$_POST['table_sort_column']?>" />
		  <input name="table_sort_type" type="hidden" value="<?=$_POST['table_sort_type']?>" />
		  <input name="boxchecked" type="hidden" value="0" />
		  <input name="changefind" type="hidden" value="0" />
		  <input name="navigate" type="hidden" value="invoice" />
		  <input name="list_start_position"  type="hidden" value="<?=$pagedata->position ?>" />

		  <table border="0" cellspacing="0" cellpadding="0" width="100%">            
               <tr>
                 <td class="tb-find"><label>Filtruj</label>
                   <select name="filter" onchange="submitbutton('find');">
                     <option value="0" <?=($_POST['filter']=='0')?'selected="selected"':''?>>Faktury nieop³acone</option>
                     <option value="1" <?=($_POST['filter']=='1')?'selected="selected"':''?>>Wszystkie faktury</option>
                   </select>
                 </td>
                 <td width="200" class="tb-find"><label>Szukaj</label>
                 <input type="text" name="find" onchange="submitbutton('find');" value="<?=$_POST['find']?>" /></td>
               </tr>
          </table>		 
			   		     	      		  
		  <table class="tab" cellpadding="0" cellspacing="0" width="100%">
		  	<col width="3%" />
			<col width="3%" />
			<col width="3%" />
			<col width="15%" />
			<col width="20%" />
			<col width="15%" />
			<col width="10%" />
			<col width="5%" />
			<col width="5%" />
			<col width="5%" />
			<col width="5%" />
			<col width="5%" />
          	<thead>
            	<tr>
				   <td align="center">Lp</td>
                   <td align="center"><input name="toggle" value="" onclick="checkAll(<?=$pagedata->limit ?>);" type="checkbox" /></td>
				   <td align="center"><a href="javascript:columnsort('id');">Info</a></td>
				   <td><a href="javascript:columnsort('numer_faktury');">Numer faktury</a></td>
				   <td><a href="javascript:columnsort('n_nazwa_firmy');">Nazwa firmy</a></td>
                   <td><a href="javascript:columnsort('osoba_zamawiajaca');">Osoba zamawiaj±ca</a></td>
				   <td><a href="javascript:columnsort('n_telefon');">Telefon</a></td>
                   <td align="center"><a href="javascript:columnsort('oplacona');">Zap³acona</a></td>				   
				   <td align="center">Wy¶lij</td>
				   <td align="center">Poka¿</td>
				   <td align="center">Edytuj</td>
                   <td align="center">Usuñ</td>                   
                </tr>
            </thead>
			 <tbody>	  
		  <?php 		  	
		  	$i = 1;	$j = 0;
			$lp = $pagedata->position + 1;
		    if ( is_array( $list_resoults ) ) { 
				foreach( $list_resoults as $object ) { 
						$pic_oplacona = ($object->oplacona)?'<img src="../img/small/tick.png" title="Wpis potwierdzony" width="12" height="12" />':'<img src="../img/small/no-accept.gif" title="Wpis niepotwierdzony" width="12" height="12" />';
						
						echo '<tr class="row'.$i.'">';
	/* Lp */			echo '  <td align="right">'.$lp.'</td>';
	/* Checkbox */		echo '  <td align="center"><input id="cb'.$j.'" name="cid[]" type="checkbox" value="'.$object->id.'" onclick="isChecked(this.checked);" /></td>';					
	/* Info */			echo '  <td><img src="../img/small/con_info.png" title="" width="16" height="16" '.createHint(array('<b>Identyfikator:</b> '.$object->id,'<b>Data zapisu:</b>',$object->update_date),'CAPTION','Informacje dodatkowe').'/></td>';
	/* Numer fv */		echo '  <td>'.$object->numer_faktury.'</td>';
	/* Nazwa firmy */	echo '  <td>'.$object->n_nazwa_firmy.'</td>';
	/* Osoba zamaw. */	echo '  <td><a href="mailto:'.$object->mail_osoba_zamwiajaca.'">'.$object->osoba_zamawiajaca.'</a></td>';
	/* Telefon */		echo '  <td>'.$object->n_telefon.'</td>';
	/* Op³acona */		echo '  <td align="center"><a href="javascript: void(0);" onclick="return listItemTask(\'cb'.$j.'\',\'change_oplacona\')">'.$pic_oplacona.'</a></td>';
	/* Wy¶lij */		echo '  <td align="center"><a href="javascript: openwindow_x(\'invoice_send.php?id='.$object->id.'&email='.$object->mail_osoba_zamwiajaca.'\',350,150);" ><img src="../img/small/send_mail.gif" alt="Wy¶lij fakturê" title="Wy¶lij fakturê" /></a></td>';
	/* Pokaz */			echo '  <td align="center"><a href="javascript: openwindow_x(\'invoice_view.php?id='.$object->id.'\',770,700);" ><img src="../img/small/preview.png" alt="Wy¶wietl fakturê" title="Wy¶wietl fakturê" /></a></td>';
	/* Edytuj */		echo '  <td align="center"><a href="javascript: void(0);" onclick="return listItemTask(\'cb'.$j.'\',\'edit\')"><img src="../img/small/edit.png" title="Edytuj" width="16" height="16" /></a></td>';	
	/* Usuñ */			echo '  <td align="center"><a href="javascript: void(0);" onclick="return listItemTask(\'cb'.$j.'\',\'delete\')"><img src="../img/small/publish_x.png" title="Usuñ" width="12" height="12" /></a></td>';
						echo '</tr>';
						$i = ($i==1)?0:1;
						$j++; $lp++;
				}
			} 
			 
		  ?>
		  	</tbody>
		<?php if (!$pagedata->record_count)	{ ?>
			<table class="tab" border="0" cellspacing="0" cellpadding="0" width="100%">	
				<tbody>
					<tr><td>Nie znaleziono rekorów spe³niaj±cych zadane kryteria</td></tr>
				</tbody>
			</table>
		<?php } ?>
		  </table>
			<table class="tab" border="0" cellspacing="0" cellpadding="0" width="100%">
			<tfoot>
               <tr>
                 <td width="200" >Wszystkoch rekordów: # <?=$pagedata->record_count;?></td>
				 <td ><div align="center"><?=$pagedata->navigationString();?></div></td>
				 <td width="155" ><div align="right">Ilo¶æ rekordów na stronie:</div></td>
				 <td width="45"><div align="right">
				   <select name="list_limit" class="inp-style1" onchange="submitbutton('change_limit')">
				     <option value="5"  <?=($pagedata->limit==5)?'selected="selected"':''?>>5</option>
				     <option value="10" <?=($pagedata->limit==10)?'selected="selected"':''?>>10</option>
				     <option value="15" <?=($pagedata->limit==15)?'selected="selected"':''?>>15</option>
				     <option value="20" <?=($pagedata->limit==20)?'selected="selected"':''?>>20</option>
				     <option value="25" <?=($pagedata->limit==25)?'selected="selected"':''?>>25</option>
				     <option value="30" <?=($pagedata->limit==30)?'selected="selected"':''?>>30</option>
				     <option value="35" <?=($pagedata->limit==35)?'selected="selected"':''?>>35</option>
				     <option value="40" <?=($pagedata->limit==40)?'selected="selected"':''?>>40</option>
				     <option value="50" <?=($pagedata->limit==50)?'selected="selected"':''?>>50</option>
				     <option value="80" <?=($pagedata->limit==80)?'selected="selected"':''?>>80</option>
				     <option value="100" <?=($pagedata->limit==100)?'selected="selected"':''?>>100</option>
				   </select>
				 </div></td>
               </tr>
            </tfoot>
          </table>
