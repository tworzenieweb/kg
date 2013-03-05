		  <h1 class="context-header"><?=$page->title?><span></span></h1>
	      <p><img src="../img/pageicon/harmonogram2.gif" width="48" height="48" border="0" class="context-icon" /></p>

		  <input name="action" type="hidden" value="" />
		  <input name="default_action" type="hidden" value="<?=$page->default_action ?>" />
		  <input name="table_sort_column" type="hidden" value="<?=$_POST['table_sort_column']?>" />
		  <input name="table_sort_type" type="hidden" value="<?=$_POST['table_sort_type']?>" />
		  <input name="boxchecked" value="0" type="hidden" />
		  <input name="changefind" value="0" type="hidden" />
		  <input name="navigate" type="hidden" value="schedule" />
		  <input name="list_start_position"  type="hidden" value="<?=$pagedata->position ?>" />

		  <div class="gray-panel">
		  	<table width="521" border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="521" class="ramka2"><table width="472" border="0" cellpadding="0" cellspacing="3">
                  <tr>
                    <td width="144"><span class="balack-bold">Kod szkolenia &nbsp;<img src="../img/small/a_no_send.png" title="Nale¿y pamiêtaæ ¿e kod szkolenia musi byæ unikalny. Format kodu: PP01/06" width="12" height="12" /></span></td>
                    <td>&nbsp;</td>
                    <td colspan="2"><span class="balack-bold">Data szkolenia</span> &nbsp;<img src="../img/small/a_no_send.png" title="Format daty: 2006-03-05 12:00:00" width="12" height="12" /></td>
                  </tr>
                  <tr>
                    <td><input class="inp-style1" type="text" name="code" value="<?=$row_data->code?>" /></td>
                    <td width="144">&nbsp;&nbsp;<img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
                    <td width="144"><input class="inp-style1" type="text" name="training_date" value="<?=$row_data->training_date?>" /></td>
                    <td width="25"><div align="right"><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></div></td>
                  </tr>
                  <tr>
                    <td colspan="4"><input name="visible_m" type="checkbox" value="1" <?=($row_data->visible_m)?'checked':''?> />
                      Poka¿ na stronie www </td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td class="ramka2"><table width="472" border="0" cellpadding="0" cellspacing="3">
                  <tr>
                    <td colspan="2"><span class="<?=($row_data->introduction_m==$row_data->introduction)?'balack-bold':'red-bold'?>">Informacja o szkoleniu </span></td>
                  </tr>
                  <tr>
                    <td width="437"><select class="inp-style1" name="training_info_id">
                        <?php if ( is_array($training_info_list) ) { 				
						foreach( $training_info_list as $object ) {
						$status = ($object->id == $row_data->training_info_id)?'selected':'';
						echo '<option value="'.$object->id.'"'.$status.'>('.$object->prefix_code.') '.$object->title.'</option>';	
						}
						}	
                	?>
                      </select>                    </td>
                    <td width="26" colspan="-1"><div align="right"><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane"/></div></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="48" class="ramka2"><table width="472" border="0" cellpadding="0" cellspacing="3">
                  <tr>
                    <td><span class="balack-bold">Wyk³adowcy</span></td>
                  </tr>
                  <tr>
                    <td class="ramka1"><?php 
					if ( is_array($instructors_list) ) { 				
						foreach( $instructors_list as $object ) {
							$checked = ($object->schedule_id)?'checked':'';
				  			echo '<input type="checkbox" name="instructors[]" value="'.$object->id.'"'.$checked.' />'.$object->first_name.' '.$object->last_name.'<br />';
						}
				  	}
				?>                    </td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td class="ramka2"><table width="472" border="0" cellpadding="0" cellspacing="3">
                  <tr>
                    <td><span class="balack-bold">Lokalizacja</span></td>
                  </tr>
                  <tr>
                    <td><textarea class="inp-style2" name="training_location" rows="4"><?=$row_data->training_location ?></textarea></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td class="ramka2"><table width="472" border="0" cellpadding="0" cellspacing="3">
                  <tr>
                    <td width="144"><span class="balack-bold">Cena standardowa</span> </td>
                    <td width="144">&nbsp;</td>
                    <td colspan="2"><span class="balack-bold">Cena promocyjna</span> </td>
                  </tr>
                  <tr>
                    <td><input class="inp-style1" type="text" name="price" value="<?=$row_data->price?>" /></td>
                    <td>&nbsp;&nbsp;<img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16" /></td>
                    <td width="144"><input class="inp-style1" type="text" name="price_promo" value="<?=$row_data->price_promo?>" /></td>
                    <td><div align="right"><img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16" /></div></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td class="ramka2"><table width="472" border="0" cellpadding="0" cellspacing="3">
                  <tr>
                    <td><span class="balack-bold">Komentarz</span>
                      <input type="hidden" name="find" value="<?=$_POST['find']?>" />
                      <input type="hidden" name="filter" value="<?=$_POST['filter']?>" />
                      <input type="hidden" name="id" value="<?=$record_id ?>" />
                      <?php // echo $_POST['id']?></td>
                  </tr>
                  <tr>
                    <td><textarea class="inp-style2" name="schedule_comment" rows="6"><?=$row_data->schedule_comment ?>
                    </textarea></td>
                  </tr>
                  <tr>
                    <td><div align="right"><?=($record_id > 0)?'Utworzony: '.$row_data->create_date.'&nbsp;&nbsp; Zmodyfikowany: '.$row_data->update_date:'' ?></div></td>
                  </tr>
                </table></td>
              </tr>
            </table>
</div>
