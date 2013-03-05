<?php
	
	require_once( '../class/config.php' );
	require_once( '../class/class.mycompany.php' );
	require_once( '../szkolenia/class/class.invoice.php' );
	

	$db = &new Database( USER, PASSWORD, DATABASE, HOST );
	$invoice = new Invoice( $db );	
			
	$mid = $_GET['mid'];
	
	$inv_inf = &$invoice->getRowObjSha($mid);
	if ($inv_inf->numer_faktury != '') {
		
		$inv_arr['numer_faktury']  = $inv_inf->numer_faktury;
		$inv_arr['wystawca']       = $inv_inf->s_nazwa_firmy.'<br />'.$inv_inf->s_adres.'<br />'.$inv_inf->s_kod_pocztowy.' '.$inv_inf->s_miasto.'<br />'.$inv_inf->s_nip;
		$inv_arr['odbiorca']       = $inv_inf->n_nazwa_firmy.'<br />'.$inv_inf->n_adres.'<br />'.$inv_inf->n_kod_pocztowy.' '.$inv_inf->n_miasto.' '.$inv_inf->n_poczta.'<br />'.$inv_inf->n_nip;
		$inv_arr['data_sprzedazy'] = $inv_inf->data_sprzedazy;
		$inv_arr['numer_konta']    = $inv_inf->konto_bankowe;
		$inv_arr['bank']           = $inv_inf->nazwa_banku;
		$inv_arr['usluga']         = $inv_inf->nazwa_uslugi;
		$inv_arr['cena_netto']     = $inv_inf->cena_netto;
		$inv_arr['cena_brutto']    = $inv_inf->cena_netto;
		$inv_arr['slownie']        = $inv_inf->cena_slownie;
		$inv_arr['stopka']         = $inv_inf->s_nazwa_firmy;

		$inv = (object)$inv_arr;

		include_once('../template/template-invoice.php');
		
	} else {	
		echo 'Nieprawid³owy kod wywo³ania!';
	}

?>