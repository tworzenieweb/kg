<?php

class CMSUser extends Main
{

	function CMSUser(&$dao) 
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
		case 2:
			$filter_sql = ""; break;					
		case 3:
			$filter_sql = ""; break;					
		case 4:
			$filter_sql = ""; break;					
		case 5:
			$filter_sql = ""; break;					
		default :
			$filter_sql = '';
		}	
				
		$column = 'ORDER BY `'.$sort_column.'` '.$sort_type;						
		$sql = "SELECT count(id) as 'value' FROM `asp_cms_user` WHERE (first_name like '%$find%' or last_name like '%$find%') $filter_sql";

		$rec_count = $this->dao->query( $sql );				
				
		if (is_array($rec_count)) { foreach( $rec_count as $object ) $this->record_count = $object->value; }			
									
		$this->SetPageParameter($post);
				
		$sql = "SELECT * FROM `asp_cms_user` WHERE (first_name like '%$find%' or last_name like '%$find%') $filter_sql $column ".$this->sql_limitString();
		//echo $sql;
		return $this->dao->query( $sql );				
	}

	function &getRow( $id ) {			
	
		 return $this->getRecord( 'asp_cms_user', $id );	
	}
	
	
	function addRow( $post ) {		
	
		$first_name  	= $this->dao->escape(trim($post['first_name']));
		$last_name  	= $this->dao->escape(trim($post['last_name'])); 
		$login			= $this->dao->escape(trim($post['login'])); 
		$password		= $this->dao->escape(trim($post['password'])); 		
		$permission		= $this->dao->escape(trim($post['permission'])); 		
		$email 			= $this->dao->escape(trim($post['email']));
		$active			= ( trim( $post['active'] ) )?$this->dao->escape( trim( $post['active'] ) ):'0';
		
		$sql  = "INSERT INTO asp_cms_user (first_name, last_name, login, password, permission, email, active, update_date) ";
		$sql .= "VALUES ({$first_name}, {$last_name}, {$login}, {$password}, {$permission}, {$email}, {$active}, now())";
		echo $sql;
		$this->dao->query( $sql );		
		$this->lastId = mysql_insert_id();
	}

	
	function updateRow( $post )	{		
	
		$id              = $post['id'];
		$first_name  	= $this->dao->escape(trim($post['first_name']));
		$last_name  	= $this->dao->escape(trim($post['last_name'])); 
		$login			= $this->dao->escape(trim($post['login'])); 
		$password		= $this->dao->escape(trim($post['password'])); 		
		$permission		= $this->dao->escape(trim($post['permission'])); 		
		$email 			= $this->dao->escape(trim($post['email']));
		$active			= ( trim( $post['active'] ) )?$this->dao->escape( trim( $post['active'] ) ):'0';

						
		$sql = "UPDATE asp_cms_user SET ";
		$sql.= "first_name = {$first_name}, ";
		$sql.= "last_name = {$last_name}, ";
		$sql.= "login = {$login}, ";
		$sql.= "password = {$password}, ";
		$sql.= "permission = {$permission}, ";
		$sql.= "email = {$email}, ";
		$sql.= "update_date = now(), ";
		$sql.= "active = {$active} ";
		$sql.= "WHERE id=$id";
		//echo $sql;
		$this->dao->query( $sql );		
	}


	function deleteRows( $ids )	{
	
		return $this->DeleteIds('asp_cms_user',$ids);
	}
	
			
	function changeActive ( $post )
	{	
		$ids = $post['cid'];
		$list_id = $this->array_to_string($ids);
		$sql = "UPDATE asp_cms_user SET active=NOT(active) WHERE id IN ($list_id)";	
		return $this->dao->query( $sql );	
	}

			
}

?>