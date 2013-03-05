<?php

class TableBuilder
{
	var $row_list = null;
	
	var $column_name_list = null;
	var $column_caption_list = null;
	var $column_width_list = null;
	var $table_width = '100%';
	
	function TableBuilder( &$dao )
	{
		$this->dao = $dao;
	}
	
	
	function &getEmails( $find = null, $sort = null ) 
	{
		//$sort = trim($sort);
		//$find = $this->dao->escape( $find );
		$sql = "SELECT * FROM asp_mail_subscribe";		
		return $this->dao->query( $sql );				
		//SELECT * FROM `asp_mail_subscribe` WHERE `name` like '%ê%' or `email` like '%ê%' or `source` like '%ê%'
	}
	
	
	function addEmail( $name = null, $email, $source, $type=null, $accept=0 )
	{		
		$name   = ( trim( $name ) )?$this->dao->escape( trim( $name ) ):'NULL';
		$email  = $this->dao->escape( trim( $email ) );
		$source = $this->dao->escape( trim( $source ) );
		$type   = ( trim( $type ) )?$this->dao->escape( trim( $type ) ):'NULL';
	
		$sql = "INSERT INTO asp_mail_subscribe (name, email, source, type, date, accept) VALUES ({$name},{$email},{$source},{$type},{now()},{$accept})";
		$this->dao->query( $sql );		
	}
	
	
	function deleteEmail( $id )
	{
		$id = $this->dao->escape( $id );
		$sql = "DELETE FROM asp_mail_subscribe WHERE id={$id}";
		return $this->dao->query( $sql );		
	}
	
	
	function acceptSubscription ( $sha_id )
	{		
		$sql = "UPDATE asp_mail_subscribe set accept=1 WHERE sha1(id)={$sha_id}";	
		return $this->dao->query( $sql );	
	}
	
	
	function changeAccept ( $id )
	{	
		$sql = "UPDATE asp_mail_subscribe set accept=NOT(accept) WHERE id={$id}";	
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
