<?php

class Invoice extends Main
{

	function Invoice(&$dao) 
	{
		$this->Main(&$dao);
	}	
					
	function &getList( $post, $input_sort_column ='table_sort_column',$input_sort_type ='table_sort_type' ) 
	{
		$sort_column = (!isset( $post[$input_sort_column] ) or ( trim($post[$input_sort_column]) == '' )) ? 'id' : trim($post[$input_sort_column]);
		$sort_type   = (!isset( $post[$input_sort_type] ) or ( trim($post[$input_sort_type]) == '' )) ? 'ASC' : trim($post[$input_sort_type]);
		$filter		 = $post['filter'];
		$find        = trim($post['find']);
		
		switch ( $filter ) { 
		case 1:
			$filter_sql = ""; break;			
		default :
			$filter_sql = 'and (oplacona=0)';
		}	
				
		$column = 'ORDER BY `'.$sort_column.'` '.$sort_type;						
		$sql = "SELECT count(id) as 'value' FROM `asp_training_invoice` WHERE (numer_faktury like '%$find%' or osoba_zamawiajaca like '%$find%' or sposob_zaplaty like '%$find%' or n_nazwa_firmy like '%$find%' or n_kod_pocztowy like '%$find%' or n_skrytka_pocztowa like '%$find%' or n_miasto like '%$find%' or n_adres like '%$find%' or n_nip like '%$find%' or n_telefon like '%$find%' or nazwa_uslugi like '%$find%' or komentarz like '%$find%') $filter_sql";

		$rec_count = $this->dao->query( $sql );				
				
		if (is_array($rec_count)) { foreach( $rec_count as $object ) $this->record_count = $object->value; }			
									
		$this->SetPageParameter($post);
				
		$sql = "SELECT * FROM `asp_training_invoice` WHERE (numer_faktury like '%$find%' or osoba_zamawiajaca like '%$find%' or sposob_zaplaty like '%$find%' or n_nazwa_firmy like '%$find%' or n_kod_pocztowy like '%$find%' or n_skrytka_pocztowa like '%$find%' or n_miasto like '%$find%' or n_adres like '%$find%' or n_nip like '%$find%' or n_telefon like '%$find%' or nazwa_uslugi like '%$find%' or komentarz like '%$find%') $filter_sql $column ".$this->sql_limitString();
		//echo $sql;
		return $this->dao->query( $sql );				
	}
	

	function &getRow( $id ) {			
		 return $this->getRecord( 'asp_training_invoice', $id );	
	}

	function &getRowObj( $id ) {			
		 return $this->getRecordObj( 'asp_training_invoice', $id );	
	}
	
	
	function addRow( $post )
	{		
		$numer_faktury  	 	= $this->dao->escape(trim($post['numer_faktury']));
		//$data_wystawienia  	 	= $this->dao->escape(trim($post['data_wystawienia']));
		$data_sprzedazy  	  	= $this->dao->escape(trim($post['data_sprzedazy']));
		$data_platnosci  	  	= $this->dao->escape(trim($post['data_platnosci']));
		//$data_oplacenia  	  	= $this->dao->escape(trim($post['data_oplacenia']));
		$oplacona  	  	 		= ( trim( $post['oplacona'] ) )?$this->dao->escape( trim( $post['oplacona'] ) ):'0';
		$konto_bankowe  	  	= $this->dao->escape(trim($post['konto_bankowe']));
		$nazwa_banku  	  		= $this->dao->escape(trim($post['nazwa_banku']));
		$osoba_zamawiajaca  	= $this->dao->escape(trim($post['osoba_zamawiajaca']));
		$mail_osoba_zamwiajaca  = $this->dao->escape(trim($post['mail_osoba_zamwiajaca']));
		$osoba_uprawniona_do_wystawienia  = $this->dao->escape(trim($post['osoba_uprawniona_do_wystawienia']));
		$sposob_zaplaty  	  	= $this->dao->escape(trim($post['sposob_zaplaty']));
		$s_nazwa_firmy  	  	= $this->dao->escape(trim($post['s_nazwa_firmy']));
		$s_kod_pocztowy  	  	= $this->dao->escape(trim($post['s_kod_pocztowy']));
		$s_miasto  	  	 		= $this->dao->escape(trim($post['s_miasto']));
		$s_adres  	  	 		= $this->dao->escape(trim($post['s_adres']));
		$s_nip  	  	 		= $this->dao->escape(trim($post['s_nip']));
		$s_regon  	  	 		= $this->dao->escape(trim($post['s_regon']));
		$s_telefon  	  	 	= $this->dao->escape(trim($post['s_telefon']));
		$n_nazwa_firmy  	  	= $this->dao->escape(trim($post['n_nazwa_firmy']));
		$n_kod_pocztowy  	  	= $this->dao->escape(trim($post['n_kod_pocztowy']));
		$n_skrytka_pocztowa  	= $this->dao->escape(trim($post['n_skrytka_pocztowa']));
		$n_miasto  	  	 		= $this->dao->escape(trim($post['n_miasto']));
		$n_adres  	  	 		= $this->dao->escape(trim($post['n_adres']));
		$n_nip  	  	 		= $this->dao->escape(trim($post['n_nip']));
		$n_telefon  	 		= $this->dao->escape(trim($post['n_telefon']));
		$nazwa_uslugi 	  	 	= $this->dao->escape(trim($post['nazwa_uslugi']));
		$usluga_id 	  	 		= $this->dao->escape(trim($post['usluga_id']));
		$cena_netto  	  	 	= $this->dao->escape(trim($post['cena_netto']));
		$cena_slownie			= $this->dao->escape(trim($post['cena_slownie']));
		$vat  	  	 			= $this->dao->escape(trim($post['vat']));
		$komentarz  			= $this->dao->escape(trim($post['komentarz'])); 
		
		$sql  = "INSERT INTO asp_training_invoice (numer_faktury, data_wystawienia, data_sprzedazy, data_platnosci, oplacona, konto_bankowe, nazwa_banku, osoba_zamawiajaca, mail_osoba_zamwiajaca, osoba_uprawniona_do_wystawienia, sposob_zaplaty, s_nazwa_firmy, s_kod_pocztowy, s_miasto, s_adres, s_nip, s_regon, s_telefon, n_nazwa_firmy, n_kod_pocztowy, n_skrytka_pocztowa, n_miasto, n_adres, n_nip, n_telefon, nazwa_uslugi, usluga_id, cena_netto, cena_slownie, vat, komentarz, create_date, update_date) ";
		$sql .= "VALUES ({$numer_faktury},now(),{$data_sprzedazy},{$data_platnosci},{$oplacona},{$konto_bankowe},{$nazwa_banku},{$osoba_zamawiajaca},{$mail_osoba_zamwiajaca},{$osoba_uprawniona_do_wystawienia},{$sposob_zaplaty},{$s_nazwa_firmy},{$s_kod_pocztowy},{$s_miasto},{$s_adres},{$s_nip},{$s_regon},{$s_telefon},{$n_nazwa_firmy},{$n_kod_pocztowy},{$n_skrytka_pocztowa},{$n_miasto},{$n_adres},{$n_nip},{$n_telefon},{$nazwa_uslugi},{$usluga_id},{$cena_netto},{$cena_slownie},{$vat},{$komentarz},now(),now())";
		//echo $sql;
		$this->dao->query( $sql );		
		$this->lastId = mysql_insert_id();
	}

	
	function updateRow( $post )
	{		
		$id              		= $post['id'];
		$numer_faktury  	 	= $this->dao->escape(trim($post['numer_faktury']));
		//$data_wystawienia  	  	= trim($post['data_wystawienia']);
		$data_sprzedazy  	  	= $this->dao->escape(trim($post['data_sprzedazy']));
		$data_platnosci  	  	= $this->dao->escape(trim($post['data_platnosci']));
		$data_oplacenia  	  	= $this->dao->escape(trim($post['data_oplacenia']));
		$oplacona  	  	 		= ( trim( $post['oplacona'] ) )?$this->dao->escape( trim( $post['oplacona'] ) ):'0';
		$konto_bankowe  	  	= $this->dao->escape(trim($post['konto_bankowe']));
		$nazwa_banku  	  		= $this->dao->escape(trim($post['nazwa_banku']));
		$osoba_zamawiajaca  	= $this->dao->escape(trim($post['osoba_zamawiajaca']));
		$mail_osoba_zamwiajaca  = $this->dao->escape(trim($post['mail_osoba_zamwiajaca']));
		$osoba_uprawniona_do_wystawienia  = $this->dao->escape(trim($post['osoba_uprawniona_do_wystawienia']));
		$sposob_zaplaty  	  	= $this->dao->escape(trim($post['sposob_zaplaty']));
		$s_nazwa_firmy  	  	= $this->dao->escape(trim($post['s_nazwa_firmy']));
		$s_kod_pocztowy  	  	= $this->dao->escape(trim($post['s_kod_pocztowy']));
		$s_miasto  	  	 		= $this->dao->escape(trim($post['s_miasto']));
		$s_adres  	  	 		= $this->dao->escape(trim($post['s_adres']));
		$s_nip  	  	 		= $this->dao->escape(trim($post['s_nip']));
		$s_regon  	  	 		= $this->dao->escape(trim($post['s_regon']));
		$s_telefon  	  	 	= $this->dao->escape(trim($post['s_telefon']));
		$n_nazwa_firmy  	  	= $this->dao->escape(trim($post['n_nazwa_firmy']));
		$n_kod_pocztowy  	  	= $this->dao->escape(trim($post['n_kod_pocztowy']));
		$n_skrytka_pocztowa  	= $this->dao->escape(trim($post['n_skrytka_pocztowa']));
		$n_miasto  	  	 		= $this->dao->escape(trim($post['n_miasto']));
		$n_adres  	  	 		= $this->dao->escape(trim($post['n_adres']));
		$n_nip  	  	 		= $this->dao->escape(trim($post['n_nip']));
		$n_telefon  	 		= $this->dao->escape(trim($post['n_telefon']));
		$nazwa_uslugi 	  	 	= $this->dao->escape(htmlspecialchars(trim($post['nazwa_uslugi'])));
		$usluga_id 	  	 		= $this->dao->escape(trim($post['usluga_id']));
		$cena_netto  	  	 	= $this->dao->escape(trim($post['cena_netto']));
		$cena_slownie  	  	 	= $this->dao->escape(trim($post['cena_slownie']));
		$vat  	  	 			= $this->dao->escape(trim($post['vat']));
		$komentarz  			= $this->dao->escape(trim($post['komentarz'])); 
				
		
		$sql = "UPDATE asp_training_invoice SET ";
		$sql.= "numer_faktury = {$numer_faktury}, ";
		//$sql.= "data_wystawienia = {$data_wystawienia}, ";
		$sql.= "data_sprzedazy = {$data_sprzedazy}, ";
		$sql.= "data_platnosci = {$data_platnosci}, ";
		//$sql.= "data_oplacenia = {$data_oplacenia}, ";
		$sql.= "oplacona = {$oplacona}, ";
		$sql.= "konto_bankowe = {$konto_bankowe}, ";
		$sql.= "nazwa_banku = {$nazwa_banku}, ";
		$sql.= "osoba_zamawiajaca = {$osoba_zamawiajaca}, ";
		$sql.= "mail_osoba_zamwiajaca = {$mail_osoba_zamwiajaca}, ";
		$sql.= "osoba_uprawniona_do_wystawienia = {$osoba_uprawniona_do_wystawienia}, ";
		$sql.= "sposob_zaplaty = {$sposob_zaplaty}, ";
		$sql.= "s_nazwa_firmy = {$s_nazwa_firmy}, ";
		$sql.= "s_kod_pocztowy = {$s_kod_pocztowy}, ";
		$sql.= "s_miasto = {$s_miasto}, ";
		$sql.= "s_adres = {$s_adres}, ";
		$sql.= "s_nip = {$s_nip}, ";
		$sql.= "s_regon = {$s_regon}, ";
		$sql.= "s_telefon = {$s_telefon}, ";
		$sql.= "n_nazwa_firmy = {$n_nazwa_firmy}, ";
		$sql.= "n_kod_pocztowy = {$n_kod_pocztowy}, ";
		$sql.= "n_skrytka_pocztowa = {$n_skrytka_pocztowa}, ";
		$sql.= "n_miasto = {$n_miasto}, ";
		$sql.= "n_adres = {$n_adres}, ";
		$sql.= "n_nip = {$n_nip}, ";
		$sql.= "n_telefon = {$n_telefon}, ";
		$sql.= "nazwa_uslugi = {$nazwa_uslugi}, ";
		$sql.= "usluga_id = {$usluga_id}, ";
		$sql.= "cena_netto = {$cena_netto}, ";
		$sql.= "cena_slownie = {$cena_slownie}, ";		
		$sql.= "vat = {$vat}, ";
		$sql.= "komentarz = {$komentarz}, ";
		$sql.= "update_date = now() ";
		$sql.= "WHERE id=".$id;
		//echo $sql;
		$this->dao->query( $sql );		
	}


	function deleteRows( $ids )
	{
		return $this->DeleteIds('asp_training_invoice',$ids);
	}
	
			
	function changeOplacona ( $post )
	{	
		$ids = $post['cid'];
		$list_id = $this->array_to_string($ids);
		$sql = "UPDATE asp_training_invoice SET oplacona=NOT(oplacona) WHERE id IN ($list_id)";	
		//echo $sql;
		return $this->dao->query( $sql );	
	}

	function getRowObjSha( $sha_id ) {
		$sql = 'SELECT * FROM asp_training_invoice WHERE sha1(id)="'.$sha_id.'"';
		//echo $sql; 
		$record = $this->dao->query( $sql );		
		if ( is_array( $record ) ) { 
			foreach( $record as $object ) { 
				return $object;
			}
		}		

	}
			
}

?>