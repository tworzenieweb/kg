<?php

require_once( '../class/config.php' );
require_once( '../class/class.mycompany.php' );
require_once( 'class/class.invoice.php' );
require_once( 'class/class.schedule.php' );
require_once( 'class/class.participant.php' );

if ( $session->get('AID') ) {

	$db = &new Database( USER, PASSWORD, DATABASE, HOST );
	$participant = new Participant( $db );
	$mycompany = new MyCompany( $db );
	$schedule = new Schedule( $db );
	$pagedata = new Invoice( $db );	
	$page = new Page( $db );
	
	$page_info_list = 30;
	$page_info_new  = 31;
	$page_info_edit = 32;	
	
	$page_info = $page_info_list;
				
	if 	( isset( $_GET['action'] )) {
		$action = $_GET['action'];
		$record_id = (isset( $_GET['id'] )) ? $_GET['id'] : 0;  
		//echo 'a';
	} else {
		$action = $_POST['action'];
		if (isset( $_POST['id'] )) { 
			$record_id = $_POST['id'];
			//echo 'b';
		} else {
			if (isset( $_POST['cid'] )) {
				$a = $_POST['cid'];		
				$record_id = $a[0];
				//echo 'c';
				//echo $record_id;
			} else {
				$record_id = 0;
				//echo 'd';
			}
		}			
	}	

	function set_post_row ( $record ) {
		if ( is_array($record) ) { 
			foreach( $record as $object )		
				return $object;
		}
	}
	
	//echo $record_id;
	switch ( $action ) {	
	case 'create_invoice':
		$participant_data = set_post_row ($participant->getRow($_GET['paticipant_id']));		
		$record['usluga_id'] 			 = $participant_data->schedule_id; 
		$record['data_sprzedazy'] 		 = date('Y-m-d',strtotime($participant_data->create_date)); 
		$record['data_platnosci'] 		 = date('Y-m-d',strtotime($participant_data->create_date)); 
		$record['n_kod_pocztowy'] 		 = $participant_data->post_code; 
		$record['n_miasto'] 			 = $participant_data->city; 
		$record['n_skrytka_pocztowa'] 	 = $participant_data->post_box; 
		$record['n_adres'] 				 = $participant_data->street; 
		$record['n_nip'] 				 = $participant_data->nip; 
		$record['cena_netto'] 			 = $participant_data->price; 
		$record['vat'] 					 = 0; 
		$record['osoba_zamawiajaca'] 	 = $participant_data->first_name.' '.$participant_data->last_name; 
		$record['mail_osoba_zamwiajaca'] = $participant_data->email; 
		$record['komentarz'] 			 = ''; 	
		$record['n_nazwa_firmy'] 		 = $participant_data->company;
		$record['nip'] 					 = $participant_data->nip;
		$record['uczestnik_szkolenia']	 = $participant_data->first_name.' '.$participant_data->last_name;
		$row_data = (object)$record;
		$select_item = $schedule->getScheduleList();
		$page_info = $page_info_new;
		break;
	case 'edit':
		if ($record_id) { 	// formularz nowego rekordu (ustawienia pocz±tkowe)			
			$row_data = set_post_row ($pagedata->getRow($record_id));						
			$page_info = $page_info_edit;				
		} else { 			// formularz edycji
			//echo 'wszystko ok';	
			$page_info = $page_info_new;			
		}
		$select_item = $schedule->getScheduleList();
		break;		
	case 'save':
		$company_info = set_post_row ($mycompany->getRow());
		$_POST['s_nazwa_firmy']  = $company_info->name;
		$_POST['s_kod_pocztowy'] = $company_info->post_code;
		$_POST['s_miasto'] 		 = $company_info->city;
		$_POST['s_adres'] 		 = $company_info->adress;
		$_POST['s_nip'] 		 = $company_info->nip;
		$_POST['s_regon'] 		 = $company_info->regon;
		$_POST['s_telefon'] 	 = $company_info->phone;
		$_POST['konto_bankowe']  = $company_info->bank_account;
		$_POST['nazwa_banku']    = $company_info->bank_name;
		$_POST['osoba_uprawniona_do_wystawienia'] = $company_info->invoice_user;
		
		if ($record_id) { 	// aktualizacja (update)		
			$pagedata->updateRow($_POST); 			 			
		} else {			// dodanie (insert)
			$sr = set_post_row($schedule->getScheduleList('WHERE a.id='.$_POST['usluga_id']));			
			$_POST['nazwa_uslugi'] = 'Zap³ata za szkolenie &quot;('.$sr->code.') '.$sr->title.'&quot; uczestnik: '.$_POST['uczestnik_szkolenia'];
			$pagedata->addRow($_POST); 
			$record_id  = $pagedata->lastId;			
		}			
		$row_data = set_post_row ($pagedata->getRow($record_id));
		$select_item = $schedule->getScheduleList();
		$page_info = $page_info_edit;
		break;
				
	default:			
		switch ( $action ) {
		case 'accept':
			$company_info = set_post_row ($mycompany->getRow());
			$_POST['s_nazwa_firmy']  = $company_info->name;
			$_POST['s_kod_pocztowy'] = $company_info->post_code;
			$_POST['s_miasto'] 		 = $company_info->city;
			$_POST['s_adres'] 		 = $company_info->adress;
			$_POST['s_nip'] 		 = $company_info->nip;
			$_POST['s_regon'] 		 = $company_info->regon;
			$_POST['s_telefon'] 	 = $company_info->phone;
			$_POST['konto_bankowe']  = $company_info->bank_account;
			$_POST['nazwa_banku']    = $company_info->bank_name;
			$_POST['osoba_uprawniona_do_wystawienia'] = $company_info->invoice_user;
			
			if ($record_id) { 	// aktualizacja (update) i przej¶cie do listy
				$pagedata->updateRow($_POST); 
				//set_post_row ($pagedata->getRow($record_id)); 					
			} else {			// dodanie (insert) i przej¶cie do listy
				$sr = set_post_row($schedule->getScheduleList('WHERE a.id='.$_POST['usluga_id']));			
				$_POST['nazwa_uslugi'] = 'Zap³ata za szkolenie &quot;('.$sr->code.') '.$sr->title.'&quot; uczestnik: '.$_POST['uczestnik_szkolenia'];
				$pagedata->addRow($_POST); 
				$record_id = $pagedata->lastId;
				//set_post_row ($pagedata->getRow($record_id)); 				
			}
			break;
		case 'change_oplacona':	
			$pagedata->changeOplacona($_POST); 
			break;
		case 'delete':	
			$pagedata->deleteRows($_POST['cid']); 
			break;
		case 'change_limit':
			//zmiana limitu
		}	
		
		$list_resoults = &$pagedata->getList($_POST); 
		$page_info = $page_info_list;		
		
	}
	

	$page->setPageInfo( $page_info );
	include_once("../template/".$page->template_file_name);	    						
		
} else {
	
	header("Locate: ../");
		
}

?>