<?php

class MyCompany extends Main
{

	function MyCompany(&$dao) 
	{
		$this->Main(&$dao);
	}	
					
	function &getRow( $id=1 ) 
	{			
		 return $this->getRecord( 'asp_cms_company', $id );	
	}

	function &getRowObj( $id=1 ) 
	{			
		 return $this->getRecordObj( 'asp_cms_company', $id );	
	}
	

	function updateRow( $post )
	{		
		$name  	 	  = $this->dao->escape(trim($post['name']));
		$short_name   = $this->dao->escape(trim($post['short_name']));
		$post_code    = $this->dao->escape(trim($post['post_code']));
		$post_box  	  = $this->dao->escape(trim($post['post_box']));
		$city  	  	  = $this->dao->escape(trim($post['city']));
		$adress  	  = $this->dao->escape(trim($post['adress']));
		$nip  		  = $this->dao->escape(trim($post['nip']));
		$regon  	  = $this->dao->escape(trim($post['regon']));
		$invoice_user = $this->dao->escape(trim($post['invoice_user']));
		$bank_name    = $this->dao->escape(trim($post['bank_name']));
		$bank_account = $this->dao->escape(trim($post['bank_account']));
		$phone  	  = $this->dao->escape(trim($post['phone']));
		$phone_mobile = $this->dao->escape(trim($post['phone_mobile']));
		$fax  	  	  = $this->dao->escape(trim($post['fax']));
		$email  	  = $this->dao->escape(trim($post['email']));
		$www  	  	  = $this->dao->escape(trim($post['www']));
				
		
		$sql = "UPDATE asp_cms_company SET ";
		$sql.= "name = {$name}, ";
		$sql.= "short_name = {$short_name}, ";		
		$sql.= "post_code = {$post_code}, ";
		$sql.= "post_box = {$post_box}, ";
		$sql.= "city = {$city}, ";
		$sql.= "adress = {$adress}, ";
		$sql.= "nip = {$nip}, ";
		$sql.= "regon = {$regon}, ";
		$sql.= "invoice_user = {$invoice_user}, ";
		$sql.= "bank_name = {$bank_name}, ";
		$sql.= "bank_account = {$bank_account}, ";
		$sql.= "phone = {$phone}, ";
		$sql.= "phone_mobile = {$phone_mobile}, ";
		$sql.= "fax = {$fax}, ";
		$sql.= "email = {$email}, ";
		$sql.= "www = {$www}, ";		
		$sql.= "update_date = now() ";
		$sql.= "WHERE id=1";
		//echo $sql;
		$this->dao->query( $sql );		
	}

		
}

?>