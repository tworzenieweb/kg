		  <h1 class="context-header"><?=$page->title?> <span></span></h1>
	      <p><img src="../img/pageicon/generic.png" width="48" height="48" border="0" class="context-icon" /></p>

		  <input name="action" type="hidden" value="" />
		  <input name="default_action" type="hidden" value="<?=$page->default_action ?>" />
		  <input name="table_sort_column" type="hidden" value="<?=$_POST['table_sort_column']?>" />
		  <input name="table_sort_type" type="hidden" value="<?=$_POST['table_sort_type']?>" />
		  <input name="boxchecked" value="0" type="hidden" />
		  <input name="changefind" value="0" type="hidden" />
		  <input name="navigate" type="hidden" value="site_page" />
		  <input name="list_start_position"  type="hidden" value="<?=$pagedata->position ?>" />

		  <div class="gray-panel">
		  	<table width="841" border="0" cellspacing="3" cellpadding="0">
			  <tr>
			    <td width="272"><span class="<?=($row_data->title_m==$row_data->title)?'balack-bold':'red-bold'?>">Tytu³</span></td>
			    <td width="536"><div align="right">
			      <?=($record_id > 0)?'Utworzony: '.$row_data->create_date.'&nbsp;&nbsp; Zmodyfikowany: '.$row_data->update_date:'' ?>
			    </div></td>
			    <td></td>
		      </tr>
			  <tr>
				<td colspan="2"><input class="inp-style1" type="text" name="title_m" value="<?=htmlspecialchars($row_data->title_m)?>" /></td>
				<td width="21"><div align="right"><img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16" /></div></td>
			  </tr>
			  <tr>
			    <td colspan="2"><input name="visible" type="checkbox" value="1" <?=($row_data->visible)?'checked':''?> />
			      <span class="balack-bold"> Poka¿ na stronie www </span> </td>
			    <td></td>
		      </tr>
			  <tr>
			    <td>Grupa</td>
			    <td>&nbsp;</td>
			    <td></td>
		      </tr>
			  <tr>
			    <td>
			      <select  class="inp-style1" name="site_page_group_id">
				  <?php if ( is_array( $group_page_list ) ) { 				
							foreach( $group_page_list as $object ) {
							$status = ($object->id == $row_data->site_page_group_id)?'selected':'';
							echo '<option value="'.$object->id.'"'.$status.'>'.$object->name.'</option>';	
							}
						}	
                	?>
		          </select>
			    </td>
			    <td>&nbsp;</td>
			    <td></td>
		      </tr>
			  <tr>
			    <td colspan="2"><span class="<?=($row_data->context_m==$row_data->context)?'balack-bold':'red-bold'?>">Kontekst strony</span></td>
			    <td>&nbsp;</td>
		      </tr>
			  <tr>
				<td colspan="2"><textarea id="context_m" class="inp-style2" name="context_m" rows="26"><?=$row_data->context_m?></textarea></td>
				<td><div align="right"><img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16" /></div></td>
			  </tr>
			  <tr>
				<td colspan="2">&nbsp;</td>
				<td></td>
			  </tr>
			  <tr>
				<td colspan="2">Zmiana kolejno¶ci:
				     <select name="sort_order">
				        <option value="1"  <?=($row_data->sort_order==1)?'selected="selected"':'' ?>>1</option>
				        <option value="2"  <?=($row_data->sort_order==2)?'selected="selected"':'' ?>>2</option>
				        <option value="3"  <?=($row_data->sort_order==3)?'selected="selected"':'' ?>>3</option>
				        <option value="4"  <?=($row_data->sort_order==4)?'selected="selected"':'' ?>>4</option>
				        <option value="5"  <?=($row_data->sort_order==5)?'selected="selected"':'' ?>>5</option>
				        <option value="6"  <?=($row_data->sort_order==6)?'selected="selected"':'' ?>>6</option>
				        <option value="7"  <?=($row_data->sort_order==7)?'selected="selected"':'' ?>>7</option>
				        <option value="8"  <?=($row_data->sort_order==8)?'selected="selected"':'' ?>>8</option>
				        <option value="9"  <?=($row_data->sort_order==9)?'selected="selected"':'' ?>>9</option>
				        <option value="10" <?=($row_data->sort_order==10)?'selected="selected"':'' ?>>10</option>
                    </select>
				</label></td>
				<td></td>
			  </tr>
			  <tr>
				<td colspan="2">&nbsp;</td>
				<td></td>
			  </tr>
			  <tr>
				<td colspan="2"><input type="hidden" name="find" value="<?=$_POST['find']?>" />
					<input type="hidden" name="filter" value="<?=$_POST['filter']?>" />
					<input type="hidden" name="id" value="<?=$record_id ?>" />
					<?php // echo $_POST['id']?>				</td>      
				<td></td>
			  </tr>
			</table>
		  </div>
