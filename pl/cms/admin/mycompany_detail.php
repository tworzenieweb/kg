		  <h1 class="context-header">Szkolenia <span>[<?=$page->title?>]</span></h1>
	      <p><img src="../img/pageicon/frontpage.png" width="48" height="48" border="0" class="context-icon" /></p>

		  <input name="action" type="hidden" value="" />
		  <input name="default_action" type="hidden" value="<?=$page->default_action ?>" />
		  <input name="table_sort_column" type="hidden" value="<?=$_POST['table_sort_column']?>" />
		  <input name="table_sort_type" type="hidden" value="<?=$_POST['table_sort_type']?>" />
		  <input name="boxchecked" value="0" type="hidden" />
		  <input name="changefind" value="0" type="hidden" />
		  <input name="navigate" type="hidden" value="mycompany" />
		  <input name="list_start_position"  type="hidden" value="<?=$pagedata->position ?>" />

<div class="gray-panel">
  <table width="546" border="0" cellspacing="10" cellpadding="0">
    <tr >
      <td width="526" class="ramka2"><table border="0" cellspacing="6" cellpadding="0" width="470" >
        <tr>
          <td width="120">Nazwa firmy </td>
          <td colspan="2"><input class="inp-style1" type="text" name="name" value="<?=$row_data->name?>" /></td>
          <td width="19"><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
        </tr>
        <tr>
          <td>Nazwa skrócona </td>
          <td width="151"><input class="inp-style1" type="text" name="short_name" value="<?=$row_data->short_name?>" /></td>
          <td width="150">&nbsp;</td>
          <td><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td class="ramka2"><table border="0" cellspacing="6" cellpadding="0" width="470" >
        <tr>
          <td width="120">Kod poczt./miasto </td>
          <td width="100"><input class="inp-style1" type="text" name="post_code" value="<?=$row_data->post_code?>" /></td>
          <td width="230"><input class="inp-style1" type="text" name="city" value="<?=$row_data->city?>" /></td>
          <td width="20"><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
        </tr>
        <tr>
          <td>Poczta</td>
          <td colspan="2"><input class="inp-style1" type="text" name="post_box" value="<?=$row_data->post_box?>" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Ulica/numer domu </td>
          <td colspan="2"><input class="inp-style1" type="text" name="adress" value="<?=$row_data->adress?>" /></td>
          <td><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
        </tr>

      </table></td>
    </tr>
    <tr>
      <td class="ramka2"><table border="0" cellspacing="6" cellpadding="0" width="470" >
        <tr>
          <td width="120">Telefon/Faks</td>
          <td><input class="inp-style1" type="text" name="phone" value="<?=$row_data->phone?>" /></td>
          <td><input class="inp-style1" type="text" name="fax" value="<?=$row_data->fax?>" /></td>
          <td width="19"><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
        </tr>
        <tr>
          <td>Tel. komórkowy </td>
          <td width="151"><input class="inp-style1" type="text" name="phone_mobile" value="<?=$row_data->phone_mobile?>" /></td>
          <td width="150">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Adres e-mail </td>
          <td colspan="2"><input class="inp-style1" type="text" name="email" value="<?=$row_data->email?>" /></td>
          <td><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
        </tr>
        <tr>
          <td>www</td>
          <td colspan="2"><input class="inp-style1" type="text" name="www" value="<?=$row_data->www?>" /></td>
          <td><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td class="ramka2"><table border="0" cellspacing="6" cellpadding="0" width="470" >
        <tr>
          <td width="120">Regon/NIP</td>
          <td width="151"><input class="inp-style1" type="text" name="regon" value="<?=$row_data->regon?>" /></td>
          <td width="150"><input class="inp-style1" type="text" name="nip" value="<?=$row_data->nip?>" /></td>
          <td width="19"><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td class="ramka2"><table border="0" cellspacing="6" cellpadding="0" width="470" >
        <tr>
          <td width="120">Nazwa banku </td>
          <td width="301"><input class="inp-style1" type="text" name="bank_name" value="<?=$row_data->bank_name?>" /></td>
          <td width="19"><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
        </tr>
        <tr>
          <td>Numer konta </td>
          <td><input class="inp-style1" type="text" name="bank_account" value="<?=$row_data->bank_account?>" /></td>
          <td><img src="../img/small/wymagane.png" alt="Wymagane" width="16" height="16" title="Wymagane" /></td>
        </tr>
      </table></td>
    </tr>

    <tr>
      <td><div align="right">
          <?='Zmodyfikowany: '.$row_data->update_date ?>
      </div></td>
    </tr>
  </table>
</div>
