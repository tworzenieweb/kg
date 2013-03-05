<style type="text/css">
<!--
.style1 {
	font-size: 10px;
	color: #999999;
}
-->
</style>
		  <h1 class="context-header"><?=$page->title?></h1>
	      <p><img src="../img/pageicon/inbox.png" width="48" height="48" border="0" class="context-icon" /></p>

		  <?= //'<p>'.$_GET['action'].', '. $_POST['action'].'</p>' ?>
		  <input name="action" type="hidden" value="" />
		  <input name="default_action" type="hidden" value="<?=$page->default_action ?>" />
		  <input name="table_sort_column" type="hidden" value="<?=$_POST['table_sort_column']?>" />
		  <input name="table_sort_type" type="hidden" value="<?=$_POST['table_sort_type']?>" />
		  <input name="boxchecked" value="0" type="hidden" />
		  <input name="changefind" value="0" type="hidden" />
		  <input name="navigate" type="hidden" value="messagemail" />
		  <input name="list_start_position"  type="hidden" value="<?=$pagedata->position ?>" />

		  <div class="gray-panel">
		  	<table width="754" border="0" cellspacing="3" cellpadding="0">
			  <tr>
				<td width="330">Tytu³</td>
				<td colspan="2"><?php if ($_POST['id']){ ?><div align="right"><span class="style1">Utwo¿ony: <?=$_POST['create_date']?>  &nbsp; &nbsp; Zmodyfikowany: <?=$_POST['update_date']?></span></div><?php } ?></td>
				<td width="26"></td>
			  </tr>
			  <tr>
				<td colspan="3"><input class="inp-style1" type="text" name="title" value="<?=$_POST['title'] ?>" /></td>
				<td><div align="right"><img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16"/></div></td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td width="36">&nbsp;</td>
				<td width="347">&nbsp;</td>
				<td valign="top"><div align="right"></div></td>
			  </tr>
			  <tr>
			    <td>Nadawca</td>
			    <td>&nbsp;</td>
			    <td>Szablon</td>
			    <td valign="top">&nbsp;</td>
		      </tr>
			  <tr>
			    <td><input class="inp-style1" type="text" name="sender" value="<?= $_POST['sender'] ?>" /></td>
			    <td><div align="center"><img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16" /></div></td>
			    <td>	      
			      <select class="inp-style1" name="template_id">
				  <?php if ( is_array( $select_resoults ) ) { 
							foreach( $select_resoults as $object ) { 
							$status = (($object->id) == (trim($_POST['template_id'])))?'selected':'';
							echo '<option value="'.$object->id.'" '.$status.'>'.$object->name.'</option>';
							}
						}									        
				  ?>
		          </select>		       </td>
			    <td valign="top"><div align="right"><img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16" /></div></td>
		      </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			    <td valign="top">&nbsp;</td>
		      </tr>
			  <tr>
			    <td>Wiadomo¶æ</td>
			    <td>&nbsp;</td>
			    <td></td>
			    <td valign="top">&nbsp;</td>
		      </tr>
			  <tr>
			    <td colspan="3"><div  class="textareaclass"><textarea class="inp-style2" name="context" rows="25" ><?=$_POST['context'] ?></textarea></div></td>			    
			    <td valign="top"><div align="right"><img src="../img/small/wymagane.png" title="Wymagane" width="16" height="16" /></div></td>
		      </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			    <td></td>
		      </tr>
			  <tr>
			    <td>Komentarz</td>
			    <td>&nbsp;</td>
			    <td><input type="hidden" name="find" value="<?=$_POST['find']?>" />
                  <input type="hidden" name="filter" value="<?=$_POST['filter']?>" />
                  <input type="hidden" name="id" value="<?=$record_id ?>" /></td>
			    <td></td>
		      </tr>
			  <tr>
			    <td colspan="3"><textarea class="inp-style2" name="comment" rows="5" ><?=$_POST['comment'] ?></textarea></td>
			    <td></td>
		      </tr>
			</table>
		  </div>
