<?php

class MessageMail extends Main
{
	//wiadomo¶æ z komunikatem o potwierdzeniu subskrypcji na eletter {email} {link_accept} {user_host}
	var $accept_eletter_message_id  = 3;	
	//wiadomo¶æ z komunikatem o potwierdzeniu subskrypcji na szkolenie {email} {link_accept} {user_host} {first_name} {last_name}
	var $accept_training_message_id = 4;

	function MessageMail(&$dao) 
	{
		$this->Main(&$dao);
	}	
	
	/*	Table: asp_mail_message ( id  title  context  comment  sender  template_id  create_date  update_date )	*/
				
	function &getList( $post, $input_sort_column ='table_sort_column',$input_sort_type ='table_sort_type' ) 
	{
		$sort_column = (!isset( $post[$input_sort_column] ) or ( trim($post[$input_sort_column]) == '' )) ? 'id' : trim($post[$input_sort_column]);
		$sort_type   = (!isset( $post[$input_sort_type] ) or ( trim($post[$input_sort_type]) == '' )) ? 'ASC' : trim($post[$input_sort_type]);
		$filter		 = $post['filter'];
		$find        = trim($post['find']);
		
		switch ( $filter ) { 
		case 1:
			$filter_sql = "WHERE a.special=1"; break;			
		case 2:
			$filter_sql = ""; break;					
		default :
			$filter_sql = "WHERE a.special=0";
		}	
		
		//'SELECT b.id, b.title, c.name'
		//'FROM mail_message b LEFT JOIN mail_template c ON b.template_id = c.id;''
				
		$column = 'ORDER BY `'.$sort_column.'` '.$sort_type;						
		$sql = "SELECT count(b.id) as 'value' FROM (SELECT * FROM `asp_mail_message` a $filter_sql) b LEFT JOIN asp_mail_template c ON b.template_id = c.id ";
		$sql.= "WHERE b.title like '%$find%' or b.context like '%$find%' or b.comment like '%$find%' or c.name like '%$find%'";

		$rec_count = $this->dao->query( $sql );				
				
		if (is_array($rec_count)) { foreach( $rec_count as $object ) $this->record_count = $object->value; }			
									
		$this->SetPageParameter($post);
		
		$sql  = "SELECT * ";
		$sql .= "FROM (SELECT a.id as 'id', special, template_id, comment, context, a.create_date as 'create_date', title, name, a.update_date as 'update_date' FROM `asp_mail_message` a LEFT JOIN asp_mail_template b ON a.template_id = b.id ";
		$sql .= $filter_sql.") c ";
		$sql .= "WHERE title like '%$find%' or context like '%$find%' or comment like '%$find%' or name like '%$find%' ";
		$sql .= $column." ".$this->sql_limitString();
				
		//$sql = "SELECT *, b.id as 'id', b.create_date as 'create_date', b.update_date as 'update_date' FROM (SELECT * FROM `asp_mail_message` a $filter_sql) b LEFT JOIN asp_mail_template c ON b.template_id = c.id ";
		//$sql.= "WHERE b.title like '%$find%' or b.context like '%$find%' or b.comment like '%$find%' or c.name like '%$find%' $column ".$this->sql_limitString();
		//echo $sql;
		return $this->dao->query( $sql );				
	}
	
	function getListToSelect() {
		$sql = "SELECT * FROM asp_mail_message";	
		return $this->dao->query( $sql );				
	}
	
	function &getRow( $id ) {
		 return $this->getRecord( 'asp_mail_message', $id );	
	}
	
	function addRow( $field )
	{		
		$title       = $this->dao->escape(trim($field['title']));
		$context     = $this->dao->escape(trim($field['context']));
		$comment     = $this->dao->escape(trim($field['comment']));
		$sender      = $this->dao->escape(trim($field['sender']));
		$template_id = trim($field['template_id']);
	
		$sql = "INSERT INTO asp_mail_message (title, context, comment, sender, template_id, create_date, update_date) VALUES ({$title},{$context},{$comment},{$sender},{$template_id},now(),now())";

		$this->dao->query( $sql );		
		$this->lastId = mysql_insert_id();
	}


	function updateRow( $field )
	{		
		$title       = $this->dao->escape(trim($field['title']));
		$context     = $this->dao->escape(trim($field['context']));
		$comment     = $this->dao->escape(trim($field['comment']));
		$sender      = $this->dao->escape(trim($field['sender']));
		$template_id = trim($field['template_id']);		
		$id          = $field['id'];
		
		$sql = "UPDATE asp_mail_message SET title = {$title}, context = {$context}, comment = {$comment}, sender = {$sender}, update_date = now(), template_id = {$template_id} WHERE id=".$id;
		//echo $sql;
		$this->dao->query( $sql );		
	}


	function deleteRows( $ids )
	{
		return $this->DeleteIds('asp_mail_message', $ids,'id','and special=0');
	}
	
	
	function SetMessageId( $message_id ) {
		$sql = 'SELECT a.*,b.template FROM asp_mail_message a LEFT JOIN asp_mail_template b ON a.template_id=b.id WHERE a.id='.$message_id;		
		//echo $sql;
		//$this->message_id = $message_id;
		$record = $this->dao->query( $sql );
		if (is_array($record)) { 
			foreach( $record as $object ) {
				return $object;	
			}
		}			
	}

	function SetEmailId( $email_id ) {
		$sql = 'SELECT * FROM asp_mail_subscribe WHERE id='.$email_id;		
		//echo $sql;
		$record = $this->dao->query( $sql );
		if (is_array($record)) { 
			foreach( $record as $object ) {
				return $object; 			
			}
		}		
	}
	
	function getMessageEletter( $email_id) {		
		
	    $path_accept_subscribe = 'http://www.akademiastosowaniaprawa.pl/pl/cms/eletter/acceptsubscribe.php';
		$message_info = $this->SetMessageId( 3 ); // wiadomo¶æ dla akceptacji elletera
		$email_info   = $this->SetEmailId( $email_id );
		
		$messageHTML  = str_replace('{context}', $message_info->context, $message_info->template);
		$messageHTML  = str_replace('{email}', $email_info->email, $messageHTML);
		$messageHTML  = str_replace('{link_accept}','<a href="'.$path_accept_subscribe.'?accept='.sha1( $email_id ).'">Kliknij aby potwierdziæ</a>', $messageHTML);
		$messageHTML  = str_replace('{user_host}', $email_info->user_host, $messageHTML);

		return 	$messageHTML;	
	}
	
	function getMessageTraining( $email_id, $training_name, $participant_id ) {		

		//echo $participant_id ;
	    $path_accept_subscribe = 'http://www.akademiastosowaniaprawa.pl/pl/cms/szkolenia/acceptsubscribe.php';
		$message_info = $this->SetMessageId( 4 ); // wiadomo¶æ dla akceptacji uczestnictwa w szkoleniu
		$email_info   = $this->SetEmailId( $email_id );
		//echo '### email_id = '.$email_id.' '.$email_info->name.'<br />'; 
		$messageHTML  = str_replace('{context}', $message_info->context, $message_info->template);
		$messageHTML  = str_replace('{email}', $email_info->email, $messageHTML);
		$messageHTML  = str_replace('{link_accept}','<a href="'.$path_accept_subscribe.'?accept='.sha1( $participant_id ).'">Kliknij aby potwierdziæ</a>', $messageHTML);
		$messageHTML  = str_replace('{user_host}', $email_info->user_host, $messageHTML);
		$messageHTML  = str_replace('{name}', $email_info->name, $messageHTML);
		$messageHTML  = str_replace('{training_name}', $training_name, $messageHTML);

		return 	$messageHTML;	
	}

	function getMessageInvoice( $invoice_id ) {		

	    $path_view_invoice = 'http://www.akademiastosowaniaprawa.pl/pl/cms/invoice/';
		$message_info = $this->SetMessageId( 8 ); // wiadomo¶æ dla wysy³ki faktury

		//echo '### email_id = '.$email_id.' '.$email_info->name.'<br />'; 
		$messageHTML  = str_replace('{context}', $message_info->context, $message_info->template);
		$messageHTML  = str_replace('{link_invoice}', '<a href="'.$path_view_invoice.'?mid='.sha1( $invoice_id ).'">Kliknij aby wyswietliæ fakturê</a>', $messageHTML);

		return 	$messageHTML;	
	}

	
}

?>