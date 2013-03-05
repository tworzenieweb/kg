  		  <h1 class="context-header"><?=$page->title?> <span></span></h1>
	      <p><img src="../img/pageicon/addedit.png" width="48" height="48" border="0" class="context-icon" /></p>

		  <input name="action" type="hidden" value="" />
		  <input name="default_action" type="hidden" value="<?=$page->default_action ?>" />
		  <input name="table_sort_column" type="hidden" value="<?=$_POST['table_sort_column']?>" />
		  <input name="table_sort_type" type="hidden" value="<?=$_POST['table_sort_type']?>" />
		  <input name="boxchecked" type="hidden" value="0" />
		  <input name="changefind" type="hidden" value="0" />
		  <input name="navigate" type="hidden" value="site_edit" />
		  <input name="list_start_position"  type="hidden" value="<?=$pagedata->position ?>" />

		  <table border="0" cellspacing="0" cellpadding="0" width="100%">            
               <tr>
                 <td class="tb-find"><label>Filtruj</label>
                   <select name="filter" onchange="submitbutton('find');">
                     <option value="0" <?=($_POST['filter']=='0')?'selected="selected"':''?>>Wszystkie pozycje</option>
                     <option value="1" <?=($_POST['filter']=='1')?'selected="selected"':''?>>Strony niewidoczne</option>
                   </select>
                 </td>
                 <td width="200" class="tb-find"><label>Szukaj</label>
                 <input type="text" name="find" onchange="submitbutton('find');" value="<?=$_POST['find']?>" /></td>
               </tr>
          </table>		 
		  			   		     	      		  
		  <table class="tab" cellpadding="0" cellspacing="0" width="100%">
		  	<col width="3%" />
			<col width="3%" />
			<col width="40%" />
			<col width="3%" />
			<col width="3%" />
			<col width="3%" />
			<col width="3%" />
          	<thead>
            	<tr>
				   <td align="center">Lp</td>
				   <td align="center">Info</td>
				   <td>Strony serwisu</td>
				   <td align="center">Publikuj</td>      
				   <td align="center">Podgl±d</td>      
				   <td align="center">Widoczne</td>
				   <td align="center">Edytuj</td>      
                </tr>
            </thead>
			 <tbody>	  
		  <?php 		  	
		  	$i = 1;	$j = 0;
			$lp = $pagedata->position + 1;
		    if ( is_array( $list_resoults ) ) { 
				foreach( $list_resoults as $object ) { 
						$public_visible = (($object->title != $object->title_m) or ($object->context != $object->context_m))?1:0;
						$pic_public     = ($public_visible)? '<a href="?action=publish&navigate=site_edit&id='.$object->page_id.'"><img src="../img/small/publish_g.png" title="Publikuj" width="12" height="12" /></a>':'&nbsp;';
						$pic_visible    = ($object->visible)?'<img src="../img/small/tick.png" title="Ukryj pozycjê menu" width="12" height="12" />':'<img src="../img/small/no-accept.gif" title="Poka¿ pozycjê menu" width="12" height="12" />';
						$edit_link      = ($object->link=='')?'?navigate=site_edit&action=edit&id='.$object->page_id:$object->link;
						$view_link	    =  '/pl/?page='.$object->page_id;
						
						if ($name != $object->menu_group_name) {
				   			$name = $object->menu_group_name;
							$k++;
				   		echo '<tr class="row"><td colspan="7" > '.$object->menu_group_name.'</td></tr>';						
				   		} 					
						
						echo '<tr class="row'.$i.'">';
	/* Lp */			echo '  <td align="center">'.$lp.'</td>';
	/* Ikona */			echo '  <td align="center"><img src="../img/small/new1.png" alt="Strona serwisu" /></td>'; 
	/* Nazwa menu */	echo '  <td>'.$object->name.'</td>';
	/* Publikuj */		echo '  <td align="center">'.$pic_public.'</td>';
	/* Podgl±d */		echo '  <td align="center"><a href="'.$view_link.'" target="_blank"><img src="../img/small/preview.png" alt="Podgl±d strony" title="Podgl±d strony" width="16" height="16" /></a></td>';		
	/* Widoczno¶æ */	echo '  <td align="center"><a href="?navigate=site_edit&action=change_visible&id='.$object->id.'">'.$pic_visible.'</a></td>';
	/* Edytuj */		echo '  <td align="center"><a href="'.$edit_link.'"><img src="../img/small/edit.png" title="Edytuj" width="16" height="16" /></a></td>';	
						echo '</tr>';
						$i = ($i==1)?0:1;
						$j++; $lp++;
				}
			} 
			 
		  ?>
		  	</tbody>
		<?php if (!$sitemenu->record_count)	{ ?>		
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
                 <td width="200" >Wszystkoch rekordów: # <?=$sitemenu->record_count;?></td>
				 <td ><div align="center"><?=$sitemenu->navigationString();?></div></td>
				 <td width="155" ><div align="right">Ilo¶æ rekordów na stronie:</div></td>
				 <td width="45"><div align="right">
				   <select name="list_limit" class="inp-style1" onchange="submitbutton('change_limit')">
				     <option value="5"  <?=($sitemenu->limit==5)?'selected="selected"':''?>>5</option>
				     <option value="10" <?=($sitemenu->limit==10)?'selected="selected"':''?>>10</option>
				     <option value="15" <?=($sitemenu->limit==15)?'selected="selected"':''?>>15</option>
				     <option value="20" <?=($sitemenu->limit==20)?'selected="selected"':''?>>20</option>
				     <option value="25" <?=($sitemenu->limit==25)?'selected="selected"':''?>>25</option>
				     <option value="30" <?=($sitemenu->limit==30)?'selected="selected"':''?>>30</option>
				     <option value="35" <?=($sitemenu->limit==35)?'selected="selected"':''?>>35</option>
				     <option value="40" <?=($sitemenu->limit==40)?'selected="selected"':''?>>40</option>
				     <option value="50" <?=($sitemenu->limit==50)?'selected="selected"':''?>>50</option>
				     <option value="80" <?=($sitemenu->limit==80)?'selected="selected"':''?>>80</option>
				     <option value="100" <?=($sitemenu->limit==100)?'selected="selected"':''?>>100</option>
				   </select>
				 </div></td>
               </tr>
            </tfoot>
          </table>
