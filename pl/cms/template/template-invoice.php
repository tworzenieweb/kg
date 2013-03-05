
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<title>Faktura vat nr <?=$inv->numer_faktury ?></title>
<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

.tab-header {

}
.invoice-body {
	margin: 0px;
	padding-top: 40px;
	padding-right: 40px;
	padding-bottom: 40px;
	padding-left: 40px;
}
.tab-header {
	font-size: 10px;
	border-top-width: 2px;
	border-bottom-width: 1px;
	border-top-style: solid;
	border-bottom-style: solid;
	border-top-color: #000000;
	border-bottom-color: #000000;
}
.bottom-line {
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #000000;
	font-size: 11px;
}
h1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	font-weight: bolder;
}
.style5 {font-size: 11px}
.style6 {font-size: 10}
.podpis {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->
</style>
</head>

<body>
<table width="751" height="55" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="751" class="invoice-body">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="32%"><img src="../img/pageicon/logo.gif" alt="Logo" width="214" height="93" /></td>
        <td width="68%"><div align="center">
          <h1>FAKTURA VAT nr <?=$inv->numer_faktury ?> <br />
            ORGINAŁ / KOPIA*</h1>
        </div></td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="6%">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td width="41%">&nbsp;</td>
        </tr>
        <tr>
          <td><p>&nbsp;</p>          </td>
          <td colspan="2"><p>WYSTAWCA FAKTURY: </p>          
            <p><strong><?=$inv->wystawca ?></strong></p></td>
          <td><p>ODBIORCA FAKTURY: </p>
            <p><strong><?=$inv->odbiorca ?></strong></p></td>
        </tr>
        <tr>
          <td colspan="4"><p>&nbsp;</p>
          <p>&nbsp;</p></td>
        </tr>
        <tr>
          <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr class="tab-header">
              <td class="bottom-line">&nbsp;</td>
              <td valign="top" class="bottom-line">
			  	Data wystawienia:<br />Data sprzedaży: <br />Termin zapłaty:<br />Sposób zapłaty:
			  </td>
              <td colspan="6" valign="top" class="bottom-line"><strong><?=$inv->data_sprzedazy ?><br />
                <?=$inv->data_sprzedazy ?><br />
                W ciągu pięciu dni od otzrymania faktury <br />
                Przelew na konto o numerze: <?=$inv->numer_konta ?> <br />
                prowadzone przez <?=$inv->bank ?> </strong>
                <p>&nbsp;</p></td>
              </tr>
            <tr class="tab-header">
              <td width="6%" class="tab-header"><div align="center">ILOŚĆ</div></td>
              <td class="tab-header">USŁUGA</td>
              <td width="18%" class="tab-header">&nbsp;</td>
              <td class="tab-header"><div align="center">PKWiU</div></td>
              <td width="13%" class="tab-header"><div align="center">CENA JEDNOSTKOWA NETTO </div></td>
              <td width="12%" class="tab-header"><div align="center">WARTOŚĆ SPRZEDAŻY NETTO  </div></td>
              <td width="9%" class="tab-header"><div align="center">STAWKA PODATEKU<br /> 
                VAT</div></td>
              <td width="10%" class="tab-header"><div align="center">WARTOŚĆ SPRZEDAŻY BRUTTO </div></td>
            </tr>
            <tr>
              <td class="bottom-line"><div align="center">1.</div></td>
              <td colspan="2"  class="bottom-line"><?=$inv->usluga ?></td>
              <td  class="bottom-line"><div align="center">80.42.20-00.00</div></td>
              <td class="bottom-line"><div align="right"><strong><?=$inv->cena_netto ?></strong></div></td>
              <td class="bottom-line"><div align="right"><strong><?=$inv->cena_netto ?></strong></div></td>
              <td class="bottom-line"><div align="center"><strong>Zw</strong>.</div></td>
              <td class="bottom-line"><div align="right"><strong><?=$inv->cena_brutto ?></strong></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
              <td width="13%"></td>
              <td class="bottom-line"><div align="right"><strong>DO ZAPŁATY</strong></div></td>
              <td class="bottom-line"><div align="center">VAT</div></td>
              <td class="bottom-line"><div align="right">&nbsp;</div></td>
              <td class="bottom-line"><div align="center">NETTO</div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="3">&nbsp;</td>
              <td class="bottom-line"><div align="right"><strong><?=$inv->cena_brutto ?></strong></div></td>
              <td class="bottom-line"><div align="center">0</div></td>
              <td class="bottom-line">&nbsp;</td>
              <td class="bottom-line"><div align="right"><strong><?=$inv->cena_brutto ?></strong></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="3">&nbsp;</td>
              <td class="bottom-line">&nbsp;</td>
              <td class="bottom-line"><div align="center">0</div></td>
              <td class="bottom-line"><div align="center">22%</div></td>
              <td class="bottom-line"><div align="center">0</div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="3">&nbsp;</td>
              <td class="bottom-line">&nbsp;</td>
              <td class="bottom-line"><div align="center">0</div></td>
              <td class="bottom-line"><div align="center">7%</div></td>
              <td class="bottom-line"><div align="center">0</div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="3">&nbsp;</td>
              <td class="bottom-line">&nbsp;</td>
              <td class="bottom-line"><div align="center">0</div></td>
              <td class="bottom-line"><div align="center">0%</div></td>
              <td class="bottom-line"><div align="center">0</div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="3">&nbsp;</td>
              <td class="bottom-line"><div align="right"><?=$inv->cena_brutto ?></div></td>
              <td class="bottom-line"><div align="center">0</div></td>
              <td class="bottom-line"><div align="center">Zw.</div></td>
              <td class="bottom-line"><div align="right"><?=$inv->cena_netto ?></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="3">
                <p>&nbsp;</p></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="bottom-line">&nbsp;</td>
              <td width="19%" class="bottom-line"><p>Słownie do zapłaty:</td>
              <td colspan="6" class="bottom-line"><strong><?=$inv->slownie ?></strong></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><p>&nbsp;</p>
            <p align="center">&nbsp;</p>
            <p>&nbsp;</p>
          <p>&nbsp;</p></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><p align="center"><strong><u>Monika Drab-Grotowska</u></strong></p>  
          </td>
          <td><div align="center"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div></td>
          <td><div align="center"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="33%"><p align="center" class="style5">Podpis osoby upoważnionej do<br />
              wystawiania faktur</p>
          <p align="center" class="style6">&nbsp;</p>          </td>
          <td width="20%" valign="top"><div align="center" class="style5">Data</div></td>
          <td valign="top"><p align="center" class="style5">Podpis  osoby upoważnionej <br />
do odbioru faktur i potwierdzenia <br />
wykonania usługi</p>          </td>
        </tr>
        <tr>
          <td><p>&nbsp;</p>
          <p></p></td>
          <td colspan="2">* Niepotrzebne skreślić </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4" class="bottom-line"><p >&nbsp;</p>
          <p>&nbsp;</p></td>
        </tr>
        <tr>
          <td colspan="4"><div align="center"><span class="style5"><?=$inv->stopka ?></span></div></td>
        </tr>
      </table>    </td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
