		  <h1 class="context-header"><?=$page->title?></h1>
	      <p><img src="../img/pageicon/fv48.gif" width="48" height="48" border="0" class="context-icon" /></p>

		  <?= //'<p>'.$_GET['action'].', '. $_POST['action'].'</p>' ?>
		  <input name="action" type="hidden" value="" />
		  <input name="default_action" type="hidden" value="<?=$page->default_action ?>" />
		  <input name="table_sort_column" type="hidden" value="<?=$_POST['table_sort_column']?>" />
		  <input name="table_sort_type" type="hidden" value="<?=$_POST['table_sort_type']?>" />
		  <input name="boxchecked" value="0" type="hidden" />
		  <input name="changefind" value="0" type="hidden" />
		  <input name="navigate" type="hidden" value="invoice" />
		  <input name="list_start_position"  type="hidden" value="<?=$pagedata->position ?>" />

		  <div class="gray-panel">
		  	<table width="650" border="0" cellspacing="10" cellpadding="0">
			  <tr>
                <td colspan="2" class="ramka2">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td width="106">Numer faktury</td>
						<td width="144"><input class="inp-style1" type="text" name="numer_faktury" value="<?=$row_data->numer_faktury?>" /></td>
						<td width="25"><div align="right"><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></div></td>
						<td width="423"><div align="right"><?=($record_id > 0)?'Utworzony: '.$row_data->create_date.'&nbsp;&nbsp; Zmodyfikowany: '.$row_data->update_date:'' ?></div></td>
					  </tr>
					</table>				</td>
			  </tr>	
              <tr>
                <td colspan="2" class="ramka2"><table width="100%" border="0" cellspacing="6" cellpadding="0">
                    <tr>
                      <td colspan="2" ><strong>Nazwa us³ugi </strong></td>
                      <td colspan="2">Cena netto </td>
                      <td colspan="2">VAT</td>
                    </tr>
                    <tr>
                      <td width="570">
					  <?php if ($record_id > 0) { ?>
					  	<input type="hidden" name="usluga_id" value="<?=$row_data->usluga_id ?>"  />
						<input class="inp-style1" type="text" name="nazwa_uslugi" value="<?=$row_data->nazwa_uslugi ?>" />
					  <?php } else { ?>
					  	<select name="usluga_id" class="inp-style1">
						<?php if ( is_array($select_item) ) { 
							foreach( $select_item as $object )	{	
								$checked = ($row_data->usluga_id == $object->id)?'selected="selected"':''; 
								echo '<option value="'.$object->id.'" '.$checked.' >('.$object->code.') '.$object->title.' '.date('d-m-Y',strtotime($object->training_date)).'</option>';								
							}
						}
						?>
                      	</select>
					  <?php } ?>					  </td>
                      <td width="16"><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
                      <td width="60"><input class="inp-style1" type="text" name="cena_netto" value="<?=$row_data->cena_netto?>" /></td>
                      <td width="16"><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
                      <td width="30"><input class="inp-style1" type="text" name="vat" value="<?=$row_data->vat?>" /></td>
                      <td width="16"><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
                    </tr>
					<tr>
					  <td colspan="5">Kwota s³ownie</td>
				  </tr>
					<tr>
						<td colspan="5"><input class="inp-style1" type="text" name="cena_slownie" value="<?=$row_data->cena_slownie?>" /></td>
					</tr>
                  </table></td>
              </tr>
              <tr>
                <td width="325" valign="top" class="ramka2">
				<strong>Informacje:				</strong>
				<table width="100%" border="0" cellspacing="6" cellpadding="0">
                  <tr>
                    <td width="39%">Data sprzeda¿y </td>
                    <td width="61%"><input class="inp-style1" type="text" name="data_sprzedazy" value="<?=$row_data->data_sprzedazy?>" /></td>
                    <td width="61%"><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
                  </tr>
				  <?php /*
                  <tr>
                    <td>Data p³atno¶ci </td>
                    <td><input class="inp-style1" type="text" name="data_platnosci" value="<?=$row_data->data_platnosci?>" /></td>
                    <td><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
                  </tr>
				  */ ?>
                  <tr>
                    <td>Sposób zap³aty </td>
                    <td>
                      <select name="sposob_zaplaty" class="inp-style1">
                        <option value="gotówka"<?=($row_data->sposob_zaplaty=='gotówka')?' selected="selected"':''?>>gotówka</option>
                        <option value="przelew"<?=($row_data->sposob_zaplaty=='przelew')?' selected="selected"':''?>>przelew</option>
                      </select>					</td>
                    <td><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
                  </tr>
                  <tr>
                    <td>Osoba up. do odb.</td>
                    <td><input class="inp-style1" type="text" name="osoba_zamawiajaca" value="<?=$row_data->osoba_zamawiajaca?>" /></td>
                    <td><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
                  </tr>
                  <tr>
                    <td>Adres e-mail <img src="../img/small/a_no_send.png" alt="Adres na który zostanie wys³ana faktura" title="Adres na który zostanie wys³ana faktura"width="12" height="12" /></td>
                    <td><input class="inp-style1" type="text" name="mail_osoba_zamwiajaca" value="<?=$row_data->mail_osoba_zamwiajaca?>" /></td>
                    <td><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
                  </tr>
				  <?php if (!($record_id > 0)) { ?>
                  <tr>				  	
                    <td>Uczestnik szkolenia </td>
                    <td><input class="inp-style1" type="text" name="uczestnik_szkolenia" value="<?=$row_data->uczestnik_szkolenia?>" /></td>
                    <td>&nbsp;</td>					
                  </tr>
				  <?php } ?>
                </table></td>
                <td width="325" valign="top" class="ramka2"><strong>Dane nabywcy:
                  </strong>
                  <table width="100%" border="0" cellspacing="6" cellpadding="0">
                    <tr>
                      <td width="39%">Nazwa firmy  </td>
                      <td colspan="2"><input class="inp-style1" type="text" name="n_nazwa_firmy" value="<?=$row_data->n_nazwa_firmy?>" /></td>
                      <td width="61%"><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
                    </tr>
                    <tr>
                      <td>Kod poczt./miasto </td>
                      <td width="15%"><input class="inp-style1" type="text" name="n_kod_pocztowy" value="<?=$row_data->n_kod_pocztowy?>" /></td>
                      <td width="41%"><input class="inp-style1" type="text" name="n_miasto" value="<?=$row_data->n_miasto?>" /></td>
                      <td><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
                    </tr>
                    <tr>
                      <td>Poczta</td>
                      <td colspan="2"><input class="inp-style1" type="text" name="n_skrytka_pocztowa" value="<?=$row_data->n_skrytka_pocztowa?>" /></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>Ulica/numer domu </td>
                      <td colspan="2"><input class="inp-style1" type="text" name="n_adres" value="<?=$row_data->n_adres?>" /></td>
                      <td><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
                    </tr>
                    <tr>
                      <td>NIP</td>
                      <td colspan="2"><input class="inp-style1" type="text" name="n_nip" value="<?=$row_data->n_nip?>" /></td>
                      <td><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="2" class="ramka2"><b>Komenatarz</b>
                  <p><textarea class="inp-style2" name="komentarz" rows="6"><?=$row_data->komentarz ?></textarea></p>
				</td>
              </tr>
              <tr>
                <td colspan="2" class="ramka2"><input name="oplacona" type="checkbox" value="1" <?=($row_data->oplacona)?'checked':''?> />                  
                Faktura op³acona </td>
              </tr>
              <tr>
                <td><input type="hidden" name="find" value="<?=$_POST['find']?>" />
                  <input type="hidden" name="filter" value="<?=$_POST['filter']?>" />
                  <input type="hidden" name="id" value="<?=$record_id ?>" />
                  <?php // echo $_POST['id']?></td>
                <td>&nbsp;</td>
              </tr>
            </table>
</div>
