		  <h1 class="context-header"><?=$page->title?></h1>
	      <p><img src="../img/pageicon/addusers.png" width="48" height="48" border="0" class="context-icon" /></p>

		  <input name="action" type="hidden" value="" />
		  <input name="default_action" type="hidden" value="<?=$page->default_action ?>" />
		  <input name="table_sort_column" type="hidden" value="<?=$_POST['table_sort_column']?>" />
		  <input name="table_sort_type" type="hidden" value="<?=$_POST['table_sort_type']?>" />
		  <input name="boxchecked" value="0" type="hidden" />
		  <input name="changefind" value="0" type="hidden" />
		  <input name="navigate" type="hidden" value="cms_user" />
		  <input name="list_start_position"  type="hidden" value="<?=$pagedata->position ?>" />

<div class="gray-panel">
		  	<table width="362" border="0" cellspacing="3" cellpadding="0">
			  <tr>
			    <td colspan="2"><span class="balack-bold">Imiê</span></td>
			    <td colspan="2"><span class="balack-bold">Nazwisko</span></td>
		      </tr>
			  <tr>
				<td width="144"><input class="inp-style1" type="text" name="first_name" value="<?=$row_data->first_name?>" /></td>
				<td width="35">&nbsp;&nbsp;<img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16" /></td>
				<td width="144"><input class="inp-style1" type="text" name="last_name" value="<?=$row_data->last_name?>" /></td>
				<td width="24"><div align="right"></div></td>
			  </tr>
			  <tr>
			    <td colspan="3"><input name="active" type="checkbox" value="1" <?=($row_data->active)?'checked':''?> />Poka¿ na stronie www</td>			      
			    <td></td>
		      </tr>
			  <tr>
			    <td><span class="balack-bold">Login</span></td>
			    <td>&nbsp;</td>
			    <td><span class="balack-bold">Has³o</span></td>
			    <td></td>
		      </tr>
			  <tr>
			    <td><input class="inp-style1" type="text" name="login" value="<?=$row_data->login?>" /></td>
			    <td>&nbsp;&nbsp;<img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
			    <td><input class="inp-style1" type="password" name="password" value="<?=$row_data->password?>" /></td>
			    <td><div align="right"><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></div></td>
		      </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			    <td><span class="balack-bold">Potwierd¼ has³o</span></td>
			    <td></td>
		      </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			    <td><input class="inp-style1" type="password" name="picture32" value="<?=$row_data->password?>" /></td>
			    <td><div align="right"><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane"/></div></td>
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
				<td colspan="3">
			    <div align="right"><?='Zmodyfikowany: '.$row_data->update_date ?></div></td>
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
