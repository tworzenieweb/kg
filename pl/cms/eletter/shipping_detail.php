  		  <h1 class="context-header"><?=$page->title?></h1>
	      <p><img src="../img/pageicon/massemail.png" width="48" height="48" border="0" class="context-icon" /></p>
			
		<div class="gray-panel">
		  	<table width="705" border="0" cellspacing="3" cellpadding="0">
			  <tr>
				<td width="119">Wiadomo¶æ</td>
				<td width="541">				  
				  <select name="message_id" class="inp-style1">
				    <?php if ( is_array( $message_list ) ) { 
							foreach( $message_list as $object ) { 
							$status = (($object->id) == (trim($_POST['message_id'])))?'selected':'';
							echo '<option value="'.$object->id.'" '.$status.'>('.$object->id.') '.$object->title.' ('.$object->create_date.')</option>';
							}
						}									        
				  	?>
				  	
			      </select>
			    </td>
				<td width="33"><div align="right"><img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16" /></div></td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td></td>
			  </tr>
			  <tr>
				<td>Nadawca</td>
				<td><input class="inp-style1" type="text" name="sender" value="<?= $_POST['sender'] ?>" /></td>
				<td><div align="right"><img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16"/></div></td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td><div align="right"></div></td>
			  </tr>
			  <tr>
				<td>Adres e-mail nadawcy </td>
				<td><input class="inp-style1" type="text" name="sender_email" value="<?=$_POST['sender_email'] ?>" /></td>
				<td><div align="right"><img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16" /></div></td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td></td>
			  </tr>
			  <tr>
				<td>Komentarz</td>
				<td><textarea class="inp-style2" name="comment" rows="5" ><?=$_POST['comment'] ?></textarea></td>
				<td></td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td></td>
			  </tr>
			  <tr>
				<td>Potwierdzony</td>
				<td><input name="mail_accept" type="checkbox" value="1" <?=($_POST['mail_accept'])?'checked':''?> />				</td>      
				<td></td>
			  </tr>
		  </table>
</div>

		  <?php if (isset($_GET['id'])) {
		  	$id = $_GET['id'];
		  }	else {
		  	$id = (isset($_POST['id']))?$_POST['id']:0;
		  }	
		  ?>
		  	
		  <?= //'<p>'.$_GET['action'].', '. $_POST['action'].'</p>' ?>
		  <input name="action" type="hidden" value="list" />
		  <input name="default_action" type="hidden" value="<?=$page->default_action ?>" />
		  <input name="table_sort_column" type="hidden" value="<?=$_POST['table_sort_column']?>" />
		  <input name="table_sort_type" type="hidden" value="<?=$_POST['table_sort_type']?>" />	 
		  <input name="boxchecked" type="hidden" value="0" />
		  <input name="changefind" type="hidden" value="0" />
		  <input name="navigate" type="hidden" value="shipping" />
		  <input name="find" type="hidden" value="<?=$_POST['find']?>" />
		  <input name="filter" type="hidden" value="<?=$_POST['filter']?>" />
		  <input name="id"  type="hidden"value="<?=$id?>" />
		 
		  <input name="list_start_position2"  type="hidden" value="<?=$pagedata->position ?>" />

		  <table border="0" cellspacing="0" cellpadding="0" width="100%">            
               <tr>
                 <td class="tb-find"><label>Filtruj</label>
                   <select name="filter2" onchange="submitbutton('list');">
                     <option value="0" <?=($_POST['filter2']=='0')?'selected="selected"':''?>>Wszystkie pozycje</option>
                     <option value="1" <?=($_POST['filter2']=='1')?'selected="selected"':''?>>Wpisy rêczne</option>
                     <option value="2" <?=($_POST['filter2']=='2')?'selected="selected"':''?>>Wpisy z formularza rejestracyjnego</option>
                     <option value="3" <?=($_POST['filter2']=='3')?'selected="selected"':''?>>Wpisy z zapisu na newsletter</option>
					 <option value="4" <?=($_POST['filter2']=='4')?'selected="selected"':''?>>Import z plików</option>
					 <option value="5" <?=($_POST['filter2']=='5')?'selected="selected"':''?>>Wpisy niepotwierdzone</option>
                   </select>
                 </td>
                 <td width="200" class="tb-find"><label>Szukaj</label>
                 <input type="text" name="find2" onchange="submitbutton('list');" value="<?=$_POST['find2']?>" /></td>
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
          	<thead>
            	<tr>
				   <td align="center">Lp</td>
                   <td align="center"><input name="toggle" value="" onclick="checkAll(<?=$pagedata->limit ?>);" type="checkbox" /></td>
				   <td align="center"><a href="javascript:columnsort('id');">Info</a></td>
				   <td><a href="javascript:columnsort('name');">Imie i nazwisko</a></td>
                   <td><a href="javascript:columnsort('email');">Adres e-mail</a></td>
				   <td align="center"><a href="javascript:columnsort('accept');">Wy¶lij do</a></td>
                   <td><a href="javascript:columnsort('source');">¬ród³o</a></td>				   
				   <td><a href="javascript:columnsort('type');">Typ ¼ród³a</a></td>				   
                   <td align="center">Usuñ</td>                   
                </tr>
            </thead>
			 <tbody>	  
		  <?php 		  	
		  	$i = 1;	$j = 0;
			$lp = $pagedata->position + 1;
		    if ( is_array( $list_resoults_email ) ) { 
				foreach( $list_resoults_email as $object ) { 
						$name_value = ($object->name=='')?'&nbsp;':$object->name;
						$send_mail = ($object->handling)?'<img src="../img/small/tick.png" title="Wpis potwierdzony" width="12" height="12" />':'<img src="../img/small/no-accept.gif" title="save" width="12" height="12" />';
						$deleting  = ($object->handling)?'<a href="javascript: void(0);" onclick="return listItemTask(\'cb'.$j.'\',\'deleteHandling\')"><img src="../img/small/publish_x.png" title="Usuñ" width="12" height="12" /></a>':'';
						echo '<tr class="row'.$i.'">';
						echo '  <td align="right">'.$lp.'</td>';
						echo '  <td align="center"><input id="cb'.$j.'" name="cid[]" type="checkbox" value="'.$object->id.'" onclick="isChecked(this.checked);" /></td>';					
						echo '  <td><img src="../img/small/con_info.png" title="" width="16" height="16" '.createHint(array('<b>Identyfikator:</b> '.$object->id,'<b>Data zapisu:</b>',$object->date),'CAPTION','Informacje dodatkowe').'/></td>';
						echo '  <td>'.$name_value.'</td>';
						echo '  <td><a href="mailto:'.$object->email.'">'.$object->email.'</td>';
						echo '  <td align="center">'.$send_mail.'</td>';
						echo '  <td>'.$object->source.'</td>';
						echo '  <td>'.$object->type.'</td>'; 
						//echo '  <td align="center"><a href="?navigate=emailbase&action=edit&id='.$object->id.'"><img src="../img/small/publish_g.png" title="Edytuj" width="12" height="12" /></a></td>';
						echo '  <td align="center">'.$deleting.'</td>';
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
				 <td ><div align="center"><?=$pagedata->navigationString('2');?></div></td>
				 <td width="155" ><div align="right">Ilo¶æ rekordów na stronie:</div></td>
				 <td width="45"><div align="right">
				   <select name="list_limit2" class="inp-style1" onchange="submitbutton('change_limit2')">
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
