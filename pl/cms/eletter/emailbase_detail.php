		  <h1 class="context-header"><?=$page->title?></h1>
	      <p><img src="../img/pageicon/message_config.png" width="48" height="48" border="0" class="context-icon" /></p>

		  <?= //'<p>'.$_GET['action'].', '. $_POST['action'].'</p>' ?>
		  <input name="action" type="hidden" value="" />
		  <input name="default_action" type="hidden" value="<?=$page->default_action ?>" />
		  <input name="table_sort_column" type="hidden" value="<?=$_POST['table_sort_column']?>" />
		  <input name="table_sort_type" type="hidden" value="<?=$_POST['table_sort_type']?>" />
		  <input name="boxchecked" value="0" type="hidden" />
		  <input name="changefind" value="0" type="hidden" />
		  <input name="navigate" type="hidden" value="emailbase" />
		  <input name="list_start_position"  type="hidden" value="<?=$pagedata->position ?>" />

		  <div class="gray-panel">
		  	<table width="383" border="0" cellspacing="3" cellpadding="0">
			  <tr>
				<td width="89">Imiê i nazwisko </td>
				<td width="269"><input class="inp-style1" type="text" name="name" value="<?=$_POST['name'] ?>" /></td>
				<td width="25"></td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td></td>
			  </tr>
			  <tr>
				<td>Adres e-mail </td>
				<td><input class="inp-style1" type="text" name="email" value="<?= $_POST['email'] ?>" /></td>
				<td><div align="right"><img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16"/></div></td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td><div align="right"></div></td>
			  </tr>
			  <tr>
				<td>Rodzaj wpisu </td>
				<td><input class="inp-style1" type="text" name="source" value="<?=$_POST['source'] ?>" /></td>
				<td><div align="right"><img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16" /></div></td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td></td>
			  </tr>
			  <tr>
				<td>¬ród³o</td>
				<td><input class="inp-style1" type="text" name="type" value="<?=$_POST['type'] ?>" /></td>
				<td><div align="right"><img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16" /></div></td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td></td>
			  </tr>
			  <tr>
			    <td>Telefon</td>
			    <td><input class="inp-style1" type="text" name="phone" value="<?=$_POST['phone'] ?>" /></td>
			    <td></td>
		      </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			    <td></td>
		      </tr>
			  <tr>
			    <td>Host</td>
			    <td><input class="inp-style1" type="text" name="user_host" value="<?=$_POST['user_host'] ?>" /></td>
			    <td></td>
		      </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			    <td></td>
		      </tr>
			  <tr>
			    <td>Komentarz</td>
			    <td><textarea class="textareaclass" name="mail_comment" rows="6"><?=$_POST['mail_comment'] ?></textarea></td>
			    <td></td>
		      </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			    <td></td>
		      </tr>
			  <tr>
				<td>Potwierdzony</td>
				<td>
					<input name="mail_accept" type="checkbox" value="1" <?=($_POST['mail_accept'])?'checked':''?> />
					<input type="hidden" name="find" value="<?=$_POST['find']?>" />
					<input type="hidden" name="filter" value="<?=$_POST['filter']?>" />
					<input type="hidden" name="id" value="<?=$record_id ?>" />
					<?php // echo $_POST['id']?>				</td>      
				<td></td>
			  </tr>
			</table>
		  </div>
