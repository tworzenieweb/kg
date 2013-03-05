  		  <h1 class="context-header"><?=$page->title?><span></span></h1>
	      <p><img src="../img/pageicon/uczestnicy.gif" width="48" height="48" border="0" class="context-icon" /></p>

		  <?= //'<p>'.$_GET['action'].', '. $_POST['action'].'</p>' ?>
		  <input name="action" type="hidden" value="" />
		  <input name="default_action" type="hidden" value="<?=$page->default_action ?>" />
		  <input name="table_sort_column" type="hidden" value="<?=$_POST['table_sort_column']?>" />
		  <input name="table_sort_type" type="hidden" value="<?=$_POST['table_sort_type']?>" />
		  <input name="boxchecked" type="hidden" value="0" />
		  <input name="changefind" type="hidden" value="0" />
		  <input name="navigate" type="hidden" value="participant" />
		  <input name="rid" type="hidden" value="" />
		  <input name="list_start_position"  type="hidden" value="<?=$pagedata->position ?>" />

		  <table border="0" cellspacing="0" cellpadding="0" width="100%">            
               <tr>
                 <td class="tb-find"><label>Filtruj</label>
                   <select name="filter" onchange="submitbutton('find');">
                     <option value="0" <?=($_POST['filter']=='0')?'selected="selected"':''?>>Bie¿±ce szkolenia</option>
                     <option value="1" <?=($_POST['filter']=='1')?'selected="selected"':''?>>Wszystkie wpisy</option>
                     <option value="2" <?=($_POST['filter']=='2')?'selected="selected"':''?>>Wpisy na rok 2006</option>
                     <option value="3" <?=($_POST['filter']=='3')?'selected="selected"':''?>>Wpisy na rok 2007</option>
					 <option value="4" <?=($_POST['filter']=='4')?'selected="selected"':''?>>Wpisy na rok 2008</option>
					 <option value="5" <?=($_POST['filter']=='5')?'selected="selected"':''?>>Wpisy na rok 2009</option>
					 <option value="6" <?=($_POST['filter']=='6')?'selected="selected"':''?>>Wpisy na rok 2010</option>
					 <option value="7" <?=($_POST['filter']=='7')?'selected="selected"':''?>>Wpisy na rok 2011</option>
					 <option value="8" <?=($_POST['filter']=='8')?'selected="selected"':''?>>Wpisy na rok 2012</option>
					 <option value="9" <?=($_POST['filter']=='9')?'selected="selected"':''?>>Wpisy na rok 2013</option>
					 <option value="10" <?=($_POST['filter']=='10')?'selected="selected"':''?>>Wpisy na rok 2014</option>
					 <option value="11" <?=($_POST['filter']=='11')?'selected="selected"':''?>>Wpisy na rok 2015</option>
					 <option value="12" <?=($_POST['filter']=='12')?'selected="selected"':''?>>Wpisy niepotwierdzone</option>
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
			<col width="15%" />
			<col width="32%" />
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
				   <td><a href="javascript:columnsort('first_name');">Imiê</a></td>
				   <td><a href="javascript:columnsort('last_name');">Nazwisko</a></td>
                   <td><a href="javascript:columnsort('company');">Nazwa firmy</a></td>
				   <td align="center"><a href="javascript:columnsort('accept');">Potwierdzony</a></td>
                   <td align="center">Faktura</td>				   
				   <td align="center">Email</td>
				   <td align="center">Edytuj</td>
                   <td align="center">Usuñ</td>                   
                </tr>
            </thead>
			 <tbody>	  
		  <?php 		
		  	$k = 0; 	
		    if ( is_array( $list_resoults ) )  {
				foreach( $list_resoults as $object ) { 
					if ($kod != $object->code) {
						$k++;	
						$kod = $object->code;
						$a[$k] = $object->email.'; '; 	
					} else {
						$a[$k].= $object->email.'; '; 
					}
		  		}
			}	
		  	$i = 1;	$j = 0; $k=0; $kod = '';
			$lp = $pagedata->position + 1;
		    if ( is_array( $list_resoults ) ) { 
				foreach( $list_resoults as $object ) { 
					$company = ($object->company=='')?'&nbsp;':$object->company;
				   if ($kod != $object->code) {
				   		$kod = $object->code;
						$k++;
				   		echo '<tr class="row"><td colspan="10" >('.$object->code.') '.$object->title.' '.$object->training_date.'</td><td><a href="mailto:?bcc='.trim($a[$k]).'"><img src="../img/small/send_mail.gif" alt="Wy¶lij mail do wszystkich uczestników szkolenia" title="Wy¶lij mail do wszystkich uczestników szkolenia" /></a></td></tr>';
						
				   } 
						$pic_accept = ($object->accept)?'<img src="../img/small/tick.png" title="Wpis potwierdzony" width="12" height="12" />':'<img src="../img/small/no-accept.gif" title="Wpis niepotwierdzony" width="12" height="12" />';						
						echo '<tr class="row'.$i.'">';
	/* Lp */			echo '  <td align="right">'.$lp.'</td>';
	/* Checkbox */		echo '  <td align="center"><input id="cb'.$j.'" name="cid[]" type="checkbox" value="'.$object->id.'" onclick="isChecked(this.checked);" /></td>';					
	/* Info */			echo '  <td><img src="../img/small/con_info.png" title="" width="16" height="16" '.createHint(array('<b>Identyfikator:</b> '.$object->id,'<b>Data zapisu:</b>',$object->update_date),'CAPTION','Informacje dodatkowe').'/></td>';
	/* Imiê */			echo '  <td>'.$object->first_name.'</td>';
	/* Nazwisko */		echo '  <td>'.$object->last_name.'</td>';
	/* Firma */			echo '  <td>'.$company.'</td>';
	/* Potwierdzony */	echo '  <td align="center"><a href="javascript: void(0);" onclick="return listItemTask(\'cb'.$j.'\',\'change_accept\')">'.$pic_accept.'</a></td>';
	/* Faktura */		echo '  <td align="center"><a href="?navigate=invoice&action=create_invoice&paticipant_id='.$object->id.'"><img src="../img/small/fv.gif" alt="Utwórz fakturê" title="Utwórz fakturê" /></a></td>';
	/* Email */			echo '  <td align="center"><a href="mailto:'.$object->email.'"><img src="../img/small/send_mail.gif" alt="Wy¶lij maila" title="Wy¶lij maila" /></a></td>';
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
