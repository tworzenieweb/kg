<?php

class Participant extends Main
{

	function Participant(&$dao) 
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
			$filter_sql = "and (YEAR(y.training_date) = 2006)"; break;					
		case 3:
			$filter_sql = "and (YEAR(y.training_date) = 2007)"; break;					
		case 4:
			$filter_sql = "and (YEAR(y.training_date) = 2008)"; break;					
		case 5:
			$filter_sql = "and (YEAR(y.training_date) = 2009)"; break;					
		case 6:
			$filter_sql = "and (YEAR(y.training_date) = 2010)"; break;					
		case 7:
			$filter_sql = "and (YEAR(y.training_date) = 2011)"; break;					
		case 8:
			$filter_sql = "and (YEAR(y.training_date) = 2012)"; break;					
		case 9:
			$filter_sql = "and (YEAR(y.training_date) = 2013)"; break;					
		case 10:
			$filter_sql = "and (YEAR(y.training_date) = 2014)"; break;					
		case 11:
			$filter_sql = "and (YEAR(y.training_date) = 2015)"; break;					
		case 12:
			$filter_sql = "and (accept = 0)"; break;					
		default :
			$filter_sql = 'and (y.training_date >= now()) ';
		}	
				
		$column = ', `'.$sort_column.'` '.$sort_type;						

		$sql = "SELECT count(x.id) as 'value' FROM asp_training_participant x ";
		$sql.= "LEFT JOIN (SELECT a.id as 'schedule_id2', a.code, a.training_date, c.title FROM `asp_training_schedule` a LEFT JOIN `asp_training_info` c ON a.training_info_id = c.id) y ON x.schedule_id = y.schedule_id2 ";
		$sql.= "WHERE (y.code like '%$find%' or y.title like '%$find%' or x.first_name like '%$find%' or x.last_name like '%$find%' or x.position like '%$find%' or x.department like '%$find%' or x.email like '%$find%' or x.s_first_name like '%$find%' ";
		$sql.= "or x.s_last_name like '%$find%' or x.s_position like '%$find%' or x.company like '%$find%' or x.nip like '%$find%' or x.brange like '%$find%' or x.comp_email like '%$find%' or x.city like '%$find%' or x.street like '%$find%' or x.post_code like '%$find%' ";
		$sql.= "or x.post_box like '%$find%' or x.comp_phone like '%$find%' or x.fax like '%$find%') $filter_sql ";

		$rec_count = $this->dao->query( $sql );				
				
		if (is_array($rec_count)) { foreach( $rec_count as $object ) $this->record_count = $object->value; }			
									
		$this->SetPageParameter($post);
				
		$sql = "SELECT * FROM (SELECT * FROM `asp_training_instructors` a $filter_sql) b  WHERE b.first_name like '%$find%' or b.last_name like '%$find%' or b.description like '%$find%' $column ".$this->sql_limitString();


		$sql = "SELECT * FROM asp_training_participant x ";
		$sql.= "LEFT JOIN (SELECT a.id as 'schedule_id2', a.code, a.training_date, c.title FROM `asp_training_schedule` a LEFT JOIN `asp_training_info` c ON a.training_info_id = c.id) y ON x.schedule_id = y.schedule_id2 ";
		$sql.= "WHERE (y.code like '%$find%' or y.title like '%$find%' or x.first_name like '%$find%' or x.last_name like '%$find%' or x.position like '%$find%' or x.department like '%$find%' or x.email like '%$find%' or x.s_first_name like '%$find%' ";
		$sql.= "or x.s_last_name like '%$find%' or x.s_position like '%$find%' or x.company like '%$find%' or x.nip like '%$find%' or x.brange like '%$find%' or x.comp_email like '%$find%' or x.city like '%$find%' or x.street like '%$find%' or x.post_code like '%$find%' ";
		$sql.= "or x.post_box like '%$find%' or x.comp_phone like '%$find%' or x.fax like '%$find%') $filter_sql ";
		$sql.= "ORDER BY y.code ASC $column ".$this->sql_limitString();;

		
		//echo $sql;
		return $this->dao->query( $sql );				
	}
	

	function &getRow( $id ) {			
	
		 return $this->getRecord( 'asp_training_participant', $id );	
	}
	
	
	function addRow( $post ) {		
		$schedule_id	= trim($post['schedule_id']);
		$price  		= $this->dao->escape(trim($post['price']));
		$first_name  	= $this->dao->escape(trim($post['first_name']));
		$last_name  	= $this->dao->escape(trim($post['last_name'])); 
		$position 		= $this->dao->escape(trim($post['position']));
		$department 	= $this->dao->escape(trim($post['department']));
		$email 			= $this->dao->escape(trim($post['email']));
		$s_first_name 	= $this->dao->escape(trim($post['s_first_name']));
		$s_last_name 	= $this->dao->escape(trim($post['s_last_name']));
		$s_position 	= $this->dao->escape(trim($post['s_position']));
		$s_email 		= $this->dao->escape(trim($post['s_email']));
		$company 		= $this->dao->escape(trim($post['company']));
		$nip 			= $this->dao->escape(trim($post['nip']));
		$brange 		= $this->dao->escape(trim($post['brange']));
		$comp_email 	= $this->dao->escape(trim($post['comp_email']));
		$city 			= $this->dao->escape(trim($post['city']));
		$street 		= $this->dao->escape(trim($post['street']));
		$post_code 		= $this->dao->escape(trim($post['post_code']));
		$post_box 		= $this->dao->escape(trim($post['post_box']));
		$comp_phone 	= $this->dao->escape(trim($post['comp_phone']));		
		$fax 			= $this->dao->escape(trim($post['fax']));
		$accept			= ( trim( $post['accept'] ) )?$this->dao->escape( trim( $post['accept'] ) ):'0';
		$accept_ad		= ( trim( $post['accept_ad'] ) )?$this->dao->escape( trim( $post['accept_ad'] ) ):'0';
		$participant_comment   = $this->dao->escape(trim($post['participant_comment']));				
		
		$sql  = "INSERT INTO asp_training_participant (schedule_id, price, first_name, last_name, position, department, email, s_first_name, s_last_name, s_position, s_email, company, nip, brange, comp_email, city, street, post_code, post_box, comp_phone, fax, accept, accept_ad, participant_comment, create_date, update_date) ";
		$sql .= "VALUES ({$schedule_id},{$price},{$first_name},{$last_name},{$position},{$department},{$email},{$s_first_name},{$s_last_name},{$s_position},{$s_email},{$company},{$nip},{$brange},{$comp_email},{$city},{$street},{$post_code},{$post_box},{$comp_phone},{$fax},{$accept},{$accept_ad},{$participant_comment},now(),now())";
		//echo $sql;
		$this->dao->query( $sql );		
		$this->lastId = mysql_insert_id();
	}

	
	function updateRow( $post )	{		
	
		$id              = $post['id'];
		$schedule_id	= trim($post['schedule_id']);
		$price  		= $this->dao->escape(trim($post['price']));
		$first_name  	= $this->dao->escape(trim($post['first_name']));
		$last_name  	= $this->dao->escape(trim($post['last_name'])); 
		$position 		= $this->dao->escape(trim($post['position']));
		$department 	= $this->dao->escape(trim($post['department']));
		$email 			= $this->dao->escape(trim($post['email']));
		$s_first_name 	= $this->dao->escape(trim($post['s_first_name']));
		$s_last_name 	= $this->dao->escape(trim($post['s_last_name']));
		$s_position 	= $this->dao->escape(trim($post['s_position']));
		$s_email 		= $this->dao->escape(trim($post['s_email']));
		$company 		= $this->dao->escape(trim($post['company']));
		$nip 			= $this->dao->escape(trim($post['nip']));
		$brange 		= $this->dao->escape(trim($post['brange']));
		$comp_email 	= $this->dao->escape(trim($post['comp_email']));
		$city 			= $this->dao->escape(trim($post['city']));
		$street 		= $this->dao->escape(trim($post['street']));
		$post_code 		= $this->dao->escape(trim($post['post_code']));
		$post_box 		= $this->dao->escape(trim($post['post_box']));
		$comp_phone 	= $this->dao->escape(trim($post['comp_phone']));		
		$fax 			= $this->dao->escape(trim($post['fax']));
		$update_date 	= $this->dao->escape(trim($post['update_date']));
		$accept			= ( trim( $post['accept'] ) )?$this->dao->escape( trim( $post['accept'] ) ):'0';
		$accept_ad		= ( trim( $post['accept_ad'] ) )?$this->dao->escape( trim( $post['accept_ad'] ) ):'0';
		$participant_comment   = $this->dao->escape(trim($post['participant_comment']));	
							
		$sql = "UPDATE asp_training_participant SET ";
		$sql.= "schedule_id = {$schedule_id}, ";
		$sql.= "price = {$price}, ";
		$sql.= "first_name = {$first_name}, ";
		$sql.= "last_name = {$last_name}, ";
		$sql.= "position = {$position}, ";
		$sql.= "department = {$department}, ";
		$sql.= "email = {$email}, ";
		$sql.= "s_first_name = {$s_first_name}, ";
		$sql.= "s_last_name = {$s_last_name}, ";
		$sql.= "s_position = {$s_position}, ";
		$sql.= "s_email = {$s_email}, ";
		$sql.= "company = {$company}, ";
		$sql.= "nip = {$nip}, ";
		$sql.= "brange = {$brange}, ";
		$sql.= "comp_email = {$comp_email}, ";
		$sql.= "city = {$city}, ";
		$sql.= "street = {$street}, ";
		$sql.= "post_code = {$post_code}, ";
		$sql.= "post_box = {$post_box}, ";
		$sql.= "comp_phone = {$comp_phone}, ";
		$sql.= "fax = {$fax}, ";
		$sql.= "accept = {$accept}, ";
		$sql.= "accept_ad = {$accept_ad}, ";
		$sql.= "update_date = {$update_date}, ";
		$sql.= "participant_comment = {$participant_comment} ";
		$sql.= "WHERE id=".$id;
		//echo $sql;	
		$this->dao->query( $sql );		
	}


	function deleteRows( $ids )	{
	
		return $this->DeleteIds('asp_training_participant',$ids);
	}
	
			
	function changeAccept ( $post )
	{	
		$ids = $post['cid'];
		$list_id = $this->array_to_string($ids);
		$sql = "UPDATE asp_training_participant SET accept=NOT(accept) WHERE id IN ($list_id)";	
		return $this->dao->query( $sql );	
	}

	function acceptSubscription ( $sha_id )
	{		
		$sql = "UPDATE asp_training_participant set accept=1 WHERE sha1(id)='$sha_id'";		
		//echo $sql;
		return $this->dao->query( $sql );	
	}
			
}

?>