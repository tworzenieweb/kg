		  <h1 class="context-header"><?=$page->title?></h1>
	      <p><img src="../img/pageicon/templatemanager.png" width="48" height="48" border="0" class="context-icon" /></p>

		  <?= //'<p>'.$_GET['action'].', '. $_POST['action'].'</p>' ?>
		  <input name="action" type="hidden" value="" />
		  <input name="default_action" type="hidden" value="<?=$page->default_action ?>" />
		  <input name="table_sort_column" type="hidden" value="<?=$_POST['table_sort_column']?>" />
		  <input name="table_sort_type" type="hidden" value="<?=$_POST['table_sort_type']?>" />
		  <input name="boxchecked" value="0" type="hidden" />
		  <input name="changefind" value="0" type="hidden" />
		  <input name="navigate" type="hidden" value="mail_template" />
		  <input name="list_start_position"  type="hidden" value="<?=$pagedata->position ?>" />

		  <div class="gray-panel">
		  	<table width="786" border="0" cellspacing="3" cellpadding="0">
			  <tr>
				<td colspan="4"><b>Nazwa szablonu</b></td>
			  </tr>
			  <tr>
				<td colspan="3"><input class="inp-style1" type="text" name="name" value="<?= stripslashes( $_POST['name'] )?>" /></td>
				<td width="26"><div align="right"><img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16" /></div></td>
			  </tr>
			  <tr>
			    <td colspan="4">&nbsp;</td>
		      </tr>
			  <tr>
			    <td width="268"><b>Data utworzenia:</b> <?= $_POST['create_date'] ?> &nbsp;</td>
			    <td width="299"><b>Data ostatniej modyfikacji:</b>
                  <?= $_POST['update_date'] ?></td>
			    <td width="178"><input name="visible" type="checkbox" value="1" <?=($_POST['visible'])?'checked':''?> />
                  <b>Widoczny na li¶cie</b></td>
			    <td>&nbsp;</td>
		      </tr>
			  <tr>
				<td colspan="4">&nbsp;</td>
			  </tr>
			  <tr>
				<td colspan="4"><b>Szablon</b></td>
			  </tr>
			  <tr>
				<td colspan="3"><textarea class="inp-style2"  name="template" rows="35" ><?=  stripslashes( $_POST['template'] ) ?></textarea></td>
				<td><div align="right"><img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16" align="top" /></div></td>
			  </tr>
			  <tr>
			    <td colspan="4">&nbsp;</td>
		      </tr>
			  <tr>
			    <td colspan="4"><b>Komentarz</b></td>
		      </tr>
			  <tr>
			    <td colspan="3"><textarea class="inp-style2"  name="tem_comment" rows="7" ><?=  stripslashes( $_POST['tem_comment'] ) ?></textarea></td>
		        <td>&nbsp;</td>
			  </tr>
			  <tr>
				<td colspan="4">
					<input type="hidden" name="filter" value="<?=$_POST['filter']?>" />
					<input type="hidden" name="find" value="<?=$_POST['find']?>" />                  	
                  	<input type="hidden" name="id" value="<?=$_POST['id']?>" />				</td>
			  </tr>
			</table>
		  </div>