		  <h1 class="context-header"><?=$page->title?><span></span></h1>
	      <p><img src="../img/pageicon/uczestnik.gif" width="48" height="48" border="0" class="context-icon" /></p>

		  <?= //'<p>'.$_GET['action'].', '. $_POST['action'].'</p>' ?>
		  <input name="action" type="hidden" value="" />
		  <input name="default_action" type="hidden" value="<?=$page->default_action ?>" />
		  <input name="table_sort_column" type="hidden" value="<?=$_POST['table_sort_column']?>" />
		  <input name="table_sort_type" type="hidden" value="<?=$_POST['table_sort_type']?>" />
		  <input name="boxchecked" value="0" type="hidden" />
		  <input name="changefind" value="0" type="hidden" />
		  <input name="navigate" type="hidden" value="participant" />
		  <input name="list_start_position"  type="hidden" value="<?=$pagedata->position ?>" />

		  <div class="gray-panel">
		  	<table width="614" border="0" cellspacing="10" cellpadding="0">
              <tr >
                <td width="614" class="ramka2">
				  <table width="577" border="0" cellpadding="0" cellspacing="3">
                  <tr>
                    <td width="94"><span class="balack-bold">Szkolenie</span></td>
                    <td colspan="3">
						<select name="schedule_id" class="inp-style1" >
                        <?php if ( is_array($select_item) ) { 
							foreach( $select_item as $object )	{	
								echo '<option value="'.$object->id.'">('.$object->code.') '.$object->title.' '.$object->training_date.'</option>';								
							}	
						  }
						?>
                      </select>                    </td>
                    <td width="40">&nbsp;<img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
                  </tr>
                  <tr>
                    <td>Cena</td>
                    <td width="140"><input class="inp-style1" type="text" name="price" value="<?=$row_data->price?>" /></td>
                    <td width="156"><div align="center">Data zapisu </div></td>
                    <td width="129"><input class="inp-style1" type="text" name="create_date" value="<?=$row_data->create_date?>" /></td>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td class="ramka2"><table width="577" border="0" cellpadding="0" cellspacing="3">
                  <tr>
                    <td colspan="2"><span class="balack-bold">Dane uczestnika szkolenia </span></td>
                    <td>&nbsp;</td>
                    <td colspan="3"><input name="accept" type="checkbox" value="1" <?=($row_data->accept)?'checked':''?> />
                        <?=($row_data->accept)?'Uzytkownik potwierdzi³ zg³oszenie':'<BLINK><span class="red-bold">Uzytkownik nie potwierdzi³ zg³oszenia</span></BLINK>'?>
                  </tr>
                  <tr>
                    <td colspan="6"></td>
                  </tr>
                  <tr>
                    <td width="94">Imiê</td>
                    <td width="144"><input class="inp-style1" type="text" name="first_name" value="<?=$row_data->first_name?>" /></td>
                    <td width="40">&nbsp;<img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16"/></td>
                    <td width="94">Nazwisko</td>
                    <td width="144"><input class="inp-style1" type="text" name="last_name" value="<?=$row_data->last_name?>" /></td>
                    <td width="40">&nbsp;<img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16"/></td>
                  </tr>
                  <tr>
                    <td colspan="6"></td>
                  </tr>
                  <tr>
                    <td>Stanowisko</td>
                    <td><input class="inp-style1" type="text" name="position" value="<?=$row_data->position?>" /></td>
                    <td>&nbsp;<img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16"/></td>
                    <td>Dzia³</td>
                    <td><input class="inp-style1" type="text" name="department" value="<?=$row_data->department?>" /></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="6"></td>
                  </tr>
                  <tr>
                    <td>Adres e-mail&nbsp;<a href="mailto:<?=$row_data->email?>"><img src="../img/small/send_mail.gif" alt="Wy¶lij maila" title="Wy¶lij maila" /></a></td>
                    <td colspan="4"><input class="inp-style1" type="text" name="email" value="<?=$row_data->email?>" /></td>
                    <td>&nbsp;<img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16" /></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td class="ramka2"><table width="577" border="0" cellpadding="0" cellspacing="3">
                  <tr>
                    <td colspan="6"><span class="balack-bold">Dane osoby zajmujacej siê szkoleniami</span> </td>
                  </tr>
                  <tr>
                    <td colspan="6"></td>
                  </tr>
                  <tr>
                    <td width="94">Imiê</td>
                    <td width="144"><input class="inp-style1" type="text" name="s_first_name" value="<?=$row_data->s_first_name?>" /></td>
                    <td width="40">&nbsp;</td>
                    <td width="94">Nazwisko</td>
                    <td width="144"><input class="inp-style1" type="text" name="s_last_name" value="<?=$row_data->s_last_name?>" /></td>
                    <td width="40"></td>
                  </tr>
                  <tr>
                    <td colspan="6"></td>
                  </tr>
                  <tr>
                    <td>Stanowisko</td>
                    <td><input class="inp-style1" type="text" name="s_position" value="<?=$row_data->s_position?>" /></td>
                    <td>&nbsp;</td>
                    <td>E-mail&nbsp;&nbsp;<a href="mailto:<?=$row_data->s_email?>"><img src="../img/small/send_mail.gif" alt="Wy¶lij maila" title="Wy¶lij maila" /></a></td>
                    <td><input class="inp-style1" type="text" name="s_email" value="<?=$row_data->s_email?>" /></td>
                    <td></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td class="ramka2"><table width="577" border="0" cellpadding="0" cellspacing="3">
                  <tr>
                    <td colspan="6"><span class="balack-bold">Dane firmy</span></td>
                  </tr>
                  <tr>
                    <td colspan="6"></td>
                  </tr>
                  <tr>
                    <td width="94">Firma</td>
                    <td width="144"><input class="inp-style1" type="text" name="company" value="<?=$row_data->company?>" /></td>
                    <td width="40">&nbsp;<img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16"/></td>
                    <td width="94">NIP</td>
                    <td width="144"><input class="inp-style1" type="text" name="nip" value="<?=$row_data->nip?>" /></td>
                    <td width="40">&nbsp;<img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16"/></td>
                  </tr>
                  <tr>
                    <td colspan="6"></td>
                  </tr>
                  <tr>
                    <td>Bran¿a</td>
                    <td><input class="inp-style1" type="text" name="brange" value="<?=$row_data->brange?>" /></td>
                    <td>&nbsp;</td>
                    <td>E-mail&nbsp;&nbsp;<a href="mailto:<?=$row_data->comp_email?>"><img src="../img/small/send_mail.gif" alt="Wy¶lij maila" title="Wy¶lij maila" /></a></td>
                    <td><input class="inp-style1" type="text" name="comp_email" value="<?=$row_data->comp_email?>" /></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan="6"></td>
                  </tr>
                  <tr>
                    <td>Miejscowo¶æ</td>
                    <td><input class="inp-style1" type="text" name="city" value="<?=$row_data->city?>" /></td>
                    <td>&nbsp;<img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16"/></td>
                    <td>Ulica</td>
                    <td><input class="inp-style1" type="text" name="street" value="<?=$row_data->street?>" /></td>
                    <td>&nbsp;<img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16"/></td>
                  </tr>
                  <tr>
                    <td colspan="6"></td>
                  </tr>
                  <tr>
                    <td>Kod pocztowy </td>
                    <td><input class="inp-style1" type="text" name="post_code" value="<?=$row_data->post_code?>" /></td>
                    <td>&nbsp;<img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16"/></td>
                    <td>Skrytka poczt.</td>
                    <td><input class="inp-style1" type="text" name="post_box" value="<?=$row_data->post_box?>" /></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan="6"></td>
                  </tr>
                  <tr>
                    <td>Telefon</td>
                    <td><input class="inp-style1" type="text" name="comp_phone" value="<?=$row_data->comp_phone?>" /></td>
                    <td>&nbsp;<img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16"/></td>
                    <td>Faks</td>
                    <td><input class="inp-style1" type="text" name="fax" value="<?=$row_data->fax?>" /></td>
                    <td></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td class="ramka2"><table width="577" border="0" cellpadding="0" cellspacing="3">
                  <tr>
                    <td width="556"><span class="balack-bold">Komentarz</span></td>
                  </tr>
                  <tr>
                    <td><textarea class="inp-style2" name="participant_comment" rows="5"><?=$row_data->participant_comment ?></textarea></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td class="ramka2"><input name="accept_ad" type="checkbox" value="1" <?=($row_data->accept_ad)?'checked':''?> />
Uzytkownik wyrazi³ zgodê na otrzymywanie informacji reklamowych
  <input type="hidden" name="find" value="<?=$_POST['find']?>" />
  <input type="hidden" name="filter" value="<?=$_POST['filter']?>" />
  <input type="hidden" name="id" value="<?=$record_id ?>" />
&nbsp;</td>
              </tr>
              <tr>
                <td>
                  <div align="right">
                    <?=($record_id > 0)?'Utworzony: '.$row_data->create_date.'&nbsp;&nbsp; Zmodyfikowany: '.$row_data->update_date:'' ?>
                  </div></td>
              </tr>
            </table>
</div>
