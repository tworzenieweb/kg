		  <h1 class="context-header"><?=$page->title?></h1>
	      <p><img src="../img/pageicon/wykladowca.gif" width="48" height="48" border="0" class="context-icon" /></p>

		  <?= //'<p>'.$_GET['action'].', '. $_POST['action'].'</p>' ?>
		  <input name="action" type="hidden" value="" />
		  <input name="default_action" type="hidden" value="<?=$page->default_action ?>" />
		  <input name="table_sort_column" type="hidden" value="<?=$_POST['table_sort_column']?>" />
		  <input name="table_sort_type" type="hidden" value="<?=$_POST['table_sort_type']?>" />
		  <input name="boxchecked" value="0" type="hidden" />
		  <input name="changefind" value="0" type="hidden" />
		  <input name="navigate" type="hidden" value="instructors" />
		  <input name="list_start_position"  type="hidden" value="<?=$pagedata->position ?>" />

		  <div class="gray-panel">
		  	<table width="606" border="0" cellspacing="3" cellpadding="0">
			  <tr>
			    <td><span class="balack-bold">Imiê</span></td>
			    <td width="58">&nbsp;</td>
			    <td width="255"><span class="balack-bold">Nazwisko</span></td>
			    <td></td>
		      </tr>
			  <tr>
				<td><input class="inp-style1" type="text" name="first_name" value="<?=$row_data->first_name?>" /></td>
				<td>&nbsp;&nbsp;<img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16" /></td>
				<td><input class="inp-style1" type="text" name="last_name" value="<?=$row_data->last_name?>" /></td>
				<td width="23"><div align="right"><img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16" /></div></td>
			  </tr>
			  <tr>
			    <td width="255"><input name="visible" type="checkbox" value="1" <?=($row_data->visible)?'checked':''?> />Poka¿ na stronie www</td>			      
			    <td colspan="2">&nbsp;</td>
			    <td></td>
		      </tr>
			  <tr>
			    <td colspan="3"><span class="balack-bold">Adres email</span></td>
			    <td></td>
		      </tr>
			  <tr>
			    <td colspan="3"><input class="inp-style1" type="text" name="email" value="<?=$row_data->email?>" /></td>
			    <td><div align="right"><img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16" /></div></td>
		      </tr>
			  <tr>
				<td colspan="3"><span class="balack-bold">Opis wyk³adowcy </span></td>
				<td></td>
			  </tr>
			  <tr>
				<td colspan="3"><textarea class="textareaclass" name="description" rows="15"><?=$row_data->description ?></textarea></td>
				<td><div align="right"><img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16"/></div></td>
			  </tr>
			  <tr>
			    <td colspan="3">&nbsp;</td>
			    <td>&nbsp;</td>
		      </tr>
			  <tr>
				<td colspan="3"><span class="balack-bold">Zdjêcie wyk³adowcy</span></td>
				<td><div align="right"></div></td>
			  </tr>
			  <tr>
			    <td colspan="3"><input class="inp-style1" type="text" name="picture" value="<?=$row_data->picture?>" /></td>
			    <td>&nbsp;</td>
		      </tr>
			  <tr>
				<td colspan="3">&nbsp;</td>
				<td></td>
			  </tr>
			  <tr>
				<td colspan="3">Zmiana kolejno¶ci:
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
					<option value="11" <?=($row_data->sort_order==11)?'selected="selected"':'' ?>>11</option>
					<option value="12" <?=($row_data->sort_order==12)?'selected="selected"':'' ?>>12</option>
					<option value="13" <?=($row_data->sort_order==13)?'selected="selected"':'' ?>>13</option>
					<option value="14" <?=($row_data->sort_order==14)?'selected="selected"':'' ?>>14</option>
					<option value="15" <?=($row_data->sort_order==15)?'selected="selected"':'' ?>>15</option>
					<option value="16" <?=($row_data->sort_order==16)?'selected="selected"':'' ?>>16</option>
					<option value="17" <?=($row_data->sort_order==17)?'selected="selected"':'' ?>>17</option>
					<option value="18" <?=($row_data->sort_order==18)?'selected="selected"':'' ?>>18</option>
					<option value="19" <?=($row_data->sort_order==19)?'selected="selected"':'' ?>>19</option>
					<option value="20" <?=($row_data->sort_order==20)?'selected="selected"':'' ?>>20</option>
					<option value="21" <?=($row_data->sort_order==21)?'selected="selected"':'' ?>>21</option>
					<option value="22" <?=($row_data->sort_order==22)?'selected="selected"':'' ?>>22</option>
					<option value="23" <?=($row_data->sort_order==23)?'selected="selected"':'' ?>>23</option>
					<option value="24" <?=($row_data->sort_order==24)?'selected="selected"':'' ?>>24</option>
					<option value="25" <?=($row_data->sort_order==25)?'selected="selected"':'' ?>>25</option>
					<option value="26" <?=($row_data->sort_order==26)?'selected="selected"':'' ?>>26</option>
					<option value="27" <?=($row_data->sort_order==27)?'selected="selected"':'' ?>>27</option>
					<option value="28" <?=($row_data->sort_order==28)?'selected="selected"':'' ?>>28</option>
					<option value="29" <?=($row_data->sort_order==29)?'selected="selected"':'' ?>>29</option>
					<option value="30" <?=($row_data->sort_order==30)?'selected="selected"':'' ?>>30</option>
                  </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=($record_id > 0)?'Utworzony: '.$row_data->create_date.'&nbsp;&nbsp; Zmodyfikowany: '.$row_data->update_date:'' ?></td>
				<td></td>
			  </tr>
			  <tr>
				<td colspan="3"><input type="hidden" name="find" value="<?=$_POST['find']?>" />
					<input type="hidden" name="filter" value="<?=$_POST['filter']?>" />
					<input type="hidden" name="id" value="<?=$record_id ?>" />
					<?php // echo $_POST['id']?>				</td>      
				<td></td>
			  </tr>
			</table>
		  </div>
