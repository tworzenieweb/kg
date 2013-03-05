<?php

		//Handling status
		// 0 - Wiadomo¶æ nie wysy³ana
		// 1 - Wiadomo¶æ wys³ana poprawnie
		// 2 - B³±d w czasie wysy³ki
		
		//mail_shipping "shipping"
		// 0 - wysy³ka nierozpoczêta
		// 1 - wysy³ka w trakcie realizacji
		// 2 - wysy³ka zakoñczona


class Shipping extends Main
{

	function Shipping(&$dao) 
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
		case 1: //Wszystkie wysy³ki
			$filter_sql = ""; break;			
		case 2: //Wysy³ki zakoñczone
			$filter_sql = "WHERE a.shipping = 2"; break;					
		case 3:  //Rozpoczête wysy³ki
			$filter_sql = "WHERE a.shipping = 1"; break;					
		default :  // Wysy³ki niewys³ane
			$filter_sql = "WHERE a.shipping < 2";
		}	
				
		$column = 'ORDER BY `'.$sort_column.'` '.$sort_type;						
		
		$sql = "SELECT count(b.id) as 'value' FROM (SELECT * FROM `asp_mail_shipping` a $filter_sql) b LEFT JOIN asp_mail_message c ON b.message_id = c.id ";
		$sql.= "WHERE c.title like '%$find%' or b.comment like '%$find%'";
		
		$rec_count = $this->dao->query( $sql );				
				
		if (is_array($rec_count)) { foreach( $rec_count as $object ) $this->record_count = $object->value; }			
									
		$this->SetPageParameter($post);
				
		$sql  = "SELECT * ";
		$sql .= "FROM (SELECT a.id as 'id', a.comment as 'comment', title, ship_date, shipping FROM `asp_mail_shipping` a LEFT JOIN asp_mail_message b ON a.message_id = b.id ";
		$sql .= $filter_sql.") b ";
		$sql .= "WHERE b.title like '%$find%' or b.comment like '%$find%' ".$column." ".$this->sql_limitString();
		return $this->dao->query( $sql );				
	}
	
	function &getListEmail( $post, $input_sort_column ='table_sort_column',$input_sort_type ='table_sort_type' ) 
	{
		$sort_column = (!isset( $post[$input_sort_column] ) or ( trim($post[$input_sort_column]) == '' )) ? 'id' : trim($post[$input_sort_column]);
		$sort_type   = (!isset( $post[$input_sort_type] ) or ( trim($post[$input_sort_type]) == '' )) ? 'ASC' : trim($post[$input_sort_type]);
		$filter		 = $post['filter2'];
		$find        = trim($post['find2']);

		if (isset($_GET['id'])) {
			$id = $_GET['id'];
		} else {
			$id	= $post['id'];	
		} 
								
		switch ( $filter ) { 
		case 1:
			$filter_sql = "WHERE a.`source` like '%wpis rêczny%'"; break;	// Tylko wybranbe do wysy³ki		
		case 2:
			$filter_sql = "WHERE a.`source` like '%formularz%'"; break;		
		case 3:
			$filter_sql = "WHERE a.`source` like '%newsletter%'"; break;					
		case 4:
			$filter_sql = "WHERE a.`source` like '%import%'"; break;					
		case 5:
			$filter_sql = "(WHERE accept=1) and (a.`accept` = 0)"; break;					
		default :
			$filter_sql = 'WHERE (accept=1)' ;
		}			
		
		$column = 'ORDER BY `'.$sort_column.'` '.$sort_type;						
		

		$sql  = "SELECT count(c.id) as 'value' ";
		$sql .= "FROM (SELECT a.id AS 'id', name, email, source, type, date, accept, status, NOT (isnull( b.mail_id )) AS 'handling' ";
		$sql .= "FROM `asp_mail_subscribe` a LEFT JOIN (SELECT * FROM asp_mail_handling WHERE shipping_id=$id) b ON a.id = b.mail_id ";
		$sql .= "WHERE (accept = 1) ) c ";
		$sql .= "WHERE email like '%$find%' or name like '%$find%' or source like '%$find%' or type like '%$find%'";
						
		$rec_count = $this->dao->query( $sql );				
				
		if (is_array($rec_count)) { foreach( $rec_count as $object ) $this->record_count = $object->value; }			
									
		$this->SetPageParameter($post, 'list_start_position2', 'list_limit2','2');
				
		$sql  = "SELECT * ";
		$sql .= "FROM (SELECT a.id AS 'id', name, email, source, type, date, accept, status, NOT(isnull( b.mail_id )) AS 'handling' ";
		$sql .= "FROM `asp_mail_subscribe` a LEFT JOIN (SELECT * FROM asp_mail_handling WHERE shipping_id=$id) b ON a.id = b.mail_id ";
		$sql .= "WHERE (accept = 1) ) c ";
		$sql .= "WHERE email like '%$find%' or name like '%$find%' or source like '%$find%' or type like '%$find%' ";		
		$sql .= $column." ".$this->sql_limitString();
		
		//echo $sql;				
		return $this->dao->query( $sql );				
	}

	function &getReportList( $post, $id, $input_sort_column ='table_sort_column',$input_sort_type ='table_sort_type' ) 
	{
		$sort_column = (!isset( $post[$input_sort_column] ) or ( trim($post[$input_sort_column]) == '' )) ? 'a.id' : trim($post[$input_sort_column]);
		$sort_type   = (!isset( $post[$input_sort_type] ) or ( trim($post[$input_sort_type]) == '' )) ? 'ASC' : trim($post[$input_sort_type]);
		$filter		 = $post['filter'];
		$find        = trim($post['find']);
		
		switch ( $filter ) { 
		case 1: //B³êdy
			$filter_sql = "and (status = 2)"; break;			
		case 2: //Wys³ane poprawnie
			$filter_sql = "and (status = 1)"; break;					
		case 3:  //Pozycje niewys³ane
			$filter_sql = "and (status = 0)"; break;					
		default :  // Wszystkie wysy³ane
			$filter_sql = "";
		}	
				
		$column = 'ORDER BY '.$sort_column.' '.$sort_type;						
		
		//$sql = "SELECT count(b.id) as 'value' FROM (SELECT * FROM `asp_mail_shipping` a $filter_sql) b LEFT JOIN asp_mail_message c ON b.message_id = c.id ";
		//$sql.= "WHERE c.title like '%$find%' or b.comment like '%$find%'";
		
		$sql = "SELECT count(a.id) as 'value' ";
		$sql.= "FROM `asp_mail_handling` a ";
		$sql.= "LEFT JOIN asp_mail_subscribe b ON a.mail_id = b.id ";
		$sql.= "WHERE (a.shipping_id = $id ) and (b.email like '%$find%' or  b.name like '%$find%' or a.info like '%$find%') "; 
		$sql.= $filter_sql;
		
		$rec_count = $this->dao->query( $sql );				
				
		if (is_array($rec_count)) { foreach( $rec_count as $object ) $this->record_count = $object->value; }			
									
		$this->SetPageParameter($post);
							
		$sql = "SELECT * ";
		$sql.= "FROM `asp_mail_handling` a ";
		$sql.= "LEFT JOIN asp_mail_subscribe b ON a.mail_id = b.id ";
		$sql.= "WHERE (a.shipping_id = $id ) and  (b.email like '%$find%' or  b.name like '%$find%' or a.info like '%$find%') "; 
		$sql.= $filter_sql." ".$column." ".$this->sql_limitString(); 
		//echo $sql; 
		return $this->dao->query( $sql );				
	}


	function &getRow( $id ) {
		 return $this->getRecord( 'asp_mail_shipping', $id );	
	}
		
	function addRow( $field )
	{		
		$message_id   = trim( $field['message_id'] );
		$comment      = $this->dao->escape( trim($field['comment']) );
		$sender       = $this->dao->escape( trim($field['sender']) );
		$sender_email = $this->dao->escape( trim($field['sender_email']) );
				
		$sql = "INSERT INTO asp_mail_shipping (message_id, comment, sender, sender_email) VALUES ({$message_id},{$comment},{$sender},{$sender_email})";

		echo $sql;
		$this->dao->query( $sql );		
		$this->lastId = mysql_insert_id();
	}

	function handlingList ( $shipping_id ) {
		$sql = "SELECT a.id as 'id', mail_id, status, info, name, email, accept FROM asp_mail_handling a LEFT JOIN asp_mail_subscribe b ON a.mail_id = b.id WHERE (shipping_id=".$shipping_id.") and (accept=1)";
		//echo $sql;
		return $this->dao->query( $sql );
	}

	function updateHandlingStatus ( $id, $status, $info ) {
		$status = $this->dao->escape( trim($status) );
		$info = $this->dao->escape( trim($info) );
		$sql = "UPDATE asp_mail_handling SET status = {$status}, info = {$info} WHERE id=".$id;
		//echo $sql;
		return $this->dao->query( $sql );
	}
	

	function updateRow( $field )
	{		
		$message_id   = trim( $field['message_id'] );
		$comment  	  = $this->dao->escape( trim($field['comment']) );
		$sender 	  = $this->dao->escape( trim($field['sender']) );
		$sender_email = $this->dao->escape( trim($field['sender_email']) );
		$id           = $field['id'];
		
		$sql = "UPDATE asp_mail_shipping SET message_id = {$message_id}, comment = {$comment}, sender = {$sender}, sender_email = {$sender_email} WHERE id=".$id;
		//echo $sql;
		return $this->dao->query( $sql );		
	}


	function deleteRows( $ids )
	{		
		deleteAllHandling( $ids ); //usuniêcie wszystkich przypisañ zwi±zanych z wysy³k±
		return $this->DeleteIds('asp_mail_shipping',$ids);
	}

	function deleteAllHandling ( $shipping_id ) {
		$sql = "DELETE FROM asp_mail_handling WHERE shipping_id = ".$shipping_id ;
		return $this->dao->query( $sql );		
	}
	
	function addAllHandling ( $hipping_id ) {
		$this->deleteAllHandling ( $hipping_id );
		$sql = "INSERT INTO asp_mail_handling (shipping_id,mail_id) ";
		$sql.= "SELECT ".$hipping_id.", id FROM asp_mail_subscribe WHERE accept = 1";
		return $this->dao->query( $sql );		
	}
	
	function deleteHandling ( $post ) {
		
		$hipping_id = $post['id'];
		$ids		= $post['cid'];
		 
		$list_id = $this->array_to_string($ids);
		$sql = "DELETE FROM asp_mail_handling WHERE shipping_id = {$hipping_id} and mail_id IN (".$list_id.")";
		return $this->dao->query( $sql );		
	}
	
	function addHandling ( $post ) {
		$this->deleteHandling( $post );	
		$hipping_id = $post['id'];
		$ids		= $post['cid'];
				 
		$list_id = $this->array_to_string($ids);
		
		$sql = "INSERT INTO asp_mail_handling (shipping_id,mail_id) ";
		$sql.= "SELECT ".$hipping_id.", id FROM asp_mail_subscribe WHERE id IN (".$list_id.")";
		//echo $sql;
		return $this->dao->query( $sql );		
				
	}
	
	function changeHandling ( ) {
	
	}


	function startShipping ( $shipping_id, $template_text='', $message_text='' ) {
		$message_text = $this->dao->escape( trim($message_text) );
		$template_text = $this->dao->escape( trim($template_text) );
		$sql = 'UPDATE asp_mail_shipping SET shipping=1, ship_date=now(), template_text='.$template_text.', message_text='.$message_text.' WHERE id='.$shipping_id;
		//echo $sql;
		return $this->dao->query( $sql );			
	}
	
	function endShipping ( $shipping_id ) {
		$sql = 'UPDATE asp_mail_shipping SET shipping=2, ship_date_end=now() WHERE id='.$shipping_id;
		return $this->dao->query( $sql );				
	}		
		
}

?>