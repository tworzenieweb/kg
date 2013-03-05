<?php

class MailBase extends Main
{

	function MailBase(&$dao) 
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
			$filter_sql = "WHERE a.`source` like '%wpis rêczny%'"; break;			
		case 2:
			$filter_sql = "WHERE a.`source` like '%formularz%'"; break;					
		case 3:
			$filter_sql = "WHERE a.`source` like '%newsletter%'"; break;					
		case 4:
			$filter_sql = "WHERE a.`source` like '%import%'"; break;					
		case 5:
			$filter_sql = "WHERE a.`accept` = 0"; break;					
		default :
			$filter_sql = '';
		}	
				
		$column = 'ORDER BY `'.$sort_column.'` '.$sort_type;						
		$sql = "SELECT count(id) as 'value' FROM (SELECT * FROM `asp_mail_subscribe` a $filter_sql) b  WHERE b.name like '%$find%' or b.email like '%$find%' or b.source like '%$find%' or b.phone like '%$find%' or b.mail_comment like '%$find%'";

		$rec_count = $this->dao->query( $sql );				
		
		
		if (is_array($rec_count)) { foreach( $rec_count as $object ) $this->record_count = $object->value; }			
									
		$this->SetPageParameter($post);
				
		$sql = "SELECT * FROM (SELECT * FROM `asp_mail_subscribe` a $filter_sql) b  WHERE b.name like '%$find%' or b.email like '%$find%' or b.source like '%$find%' or b.phone like '%$find%' or b.mail_comment like '%$find%' $column ".$this->sql_limitString();
		return $this->dao->query( $sql );				
	}
	

	function &getRow( $id ) {
		 return $this->getRecord( 'asp_mail_subscribe', $id );	
	}
	
	function if_exist( $condition ) {
		$sql = "SELECT count(id) as 'value' FROM `asp_mail_subscribe` ".$condition;
		//echo $sql;
		$rec_count = $this->dao->query( $sql );	
		if (is_array($rec_count)) { foreach( $rec_count as $object )  return $object->value; }		
		
	}
	
	function addRow( $field )
	{		
		$name   = trim($field['name']);
		$email  = trim($field['email']);
		$source = trim($field['source']);
		$type   = trim($field['type']);
		$accept = trim($field['mail_accept']);		
		$phone  = $this->dao->escape(trim($field['phone']));
		$user_host    = $this->dao->escape(trim($field['user_host'])); 
		$mail_comment = $this->dao->escape(trim($field['mail_comment']));
		
		
		
		$name   = ( trim( $name ) )?$this->dao->escape( trim( $name ) ):'NULL';
		$email  = $this->dao->escape( trim( $email ) );
		$source = $this->dao->escape( trim( $source ) );
		$type   = ( trim( $type ) )?$this->dao->escape( trim( $type ) ):'NULL';
		$accept = ( trim( $accept ) )?$this->dao->escape( trim( $accept ) ):'0';

		$sql = "INSERT INTO asp_mail_subscribe (name, email, source, type, date, accept, phone, mail_comment, user_host) VALUES ({$name},{$email},{$source},{$type},now(),{$accept},{$phone},{$mail_comment},{$user_host})";
		//echo $sql.'<br />';
		$result = $this->dao->query( $sql );		
		$this->lastId = mysql_insert_id();
		return $result;
	}




	function updateRow( $field )
	{		
		$name   = trim($field['name']);
		$email  = trim($field['email']);
		$source = trim($field['source']);
		$type   = trim($field['type']);
		$accept = trim($field['mail_accept']);
		$user_host = trim($field['user_host']);
		$phone  = $this->dao->escape(trim($field['phone']) );
		$mail_comment = $this->dao->escape(trim($field['mail_comment']) );
		$id     = $field['id'];
		
		$name   = ( trim( $name ) )?$this->dao->escape( trim( $name ) ):'NULL';
		$email  = $this->dao->escape( trim( $email ) );
		$source = $this->dao->escape( trim( $source ) );
		$type   = ( trim( $type ) )?$this->dao->escape( trim( $type ) ):'NULL';
		$accept = ( trim( $accept ) )?$this->dao->escape( trim( $accept ) ):'0';
		
		
		$sql = "UPDATE asp_mail_subscribe SET name = {$name}, email = {$email}, source = {$source}, type = {$type}, accept = {$accept}, phone = {$phone}, mail_comment = {$mail_comment}, user_host = {$user_host} WHERE id=".$id;
		//echo $sql;
		$this->dao->query( $sql );		
	}


	function deleteRows( $ids )
	{
		return $this->DeleteIds('asp_mail_subscribe',$ids);
	}
	
	
	function acceptSubscription ( $sha_id )
	{		
		$sql = "UPDATE asp_mail_subscribe set accept=1 WHERE sha1(id)='$sha_id'";		
		return $this->dao->query( $sql );	
	}
	
	
	function changeAccept ( $post )
	{	
		$ids = $post['cid'];
		$list_id = $this->array_to_string($ids);
		$sql = "UPDATE asp_mail_subscribe SET accept=NOT(accept) WHERE id  IN ($list_id)";	
		return $this->dao->query( $sql );	
	}
	
	
	function unsubscribeEmail ( $sha_id )
	{
		$id = $this->dao->escape( $id );		
		$sql = "DELETE FROM asp_mail_subscribe WHERE sha1(id)={$sha_id}";		
		return $this->dao->query( $sql );		
	}
		
}

?>