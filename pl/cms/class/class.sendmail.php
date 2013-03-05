<?php
class SendMail extends Main
{
	//wiadomo¶æ z komunikatem o potwierdzeniu subskrypcji na eletter {email} {link_accept} {user_host}
	var $accept_eletter_subscription_message_id  = 3;
	
	//wiadomo¶æ z komunikatem o potwierdzeniu subskrypcji na szkolenie {email} {link_accept} {user_host} {first_name} {last_name}
	var $accept_training_subscription_message_id = 4;
				
	var $email_id    = 0;
	var $message_id  = 0;
	var $template_id = 0;	
	
	var $email;
	var $message;
	var $template;

	function SendMail(&$dao) 
	{
		$this->Main(&$dao);
	}	
	
	function Send($email='',$message='',$template='') {
		$this->email = $email;
		$this->message = $massage;
		$this->template = $template;
		
		if ($this->email == '') {
			
		}		
	}
	
	function SetEmailId( $email_id ) {
		$sql = 'SELECT * FROM asp_mail_subscribe WHERE id='.$email_id;		
		$this->email_id = $email_id;
		$record = $this->dao->query( $sql );
		if (is_array($record)) { 
			foreach( $record as $object ) {
				$this->email = $object->email; 			
			}
		}			
	}
	
	function SetMessageId( $message_id ) {
		$sql = 'SELECT a.*,b.template FROM asp_mail_message a LEFT JOIN asp_mail_template b ON a.template_id=b.id WHERE a.id='.$message_id;		
		echo $sql;
		$this->message_id = $message_id;
		$record = $this->dao->query( $sql );
		if (is_array($record)) { 
			foreach( $record as $object ) {
				$this->message = $object->context; 			
				$this->template = $object->template;
				$this->template_id = $object->template_id;
			}
		}			
	}

	function SetTemplateId( $template_id ) {
		$sql = 'SELECT * FROM asp_mail_template WHERE id='.$template_id;		
		$this->template_id = $template_id;
		$record = $this->dao->query( $sql );
		if (is_array($record)) { 
			foreach( $record as $object ) {
				$this->template = $object->template; 			
			}
		}			
	}
		
	
}	
	
?>