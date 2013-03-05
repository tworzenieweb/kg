<?php

class Schedule extends Main
{

	function Schedule(&$dao) 
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
			$filter_sql = "WHERE YEAR(a.training_date)=2006"; break;					
		case 3:
			$filter_sql = "WHERE YEAR(a.training_date)=2007"; break;					
		case 4:
			$filter_sql = "WHERE YEAR(a.training_date)=2008"; break;					
		case 5:
			$filter_sql = "WHERE YEAR(a.training_date)=2009"; break;					
		case 6:
			$filter_sql = "WHERE YEAR(a.training_date)=2010"; break;					
		case 7:
			$filter_sql = "WHERE YEAR(a.training_date)=2011"; break;					
		case 8:
			$filter_sql = "WHERE YEAR(a.training_date)=2012"; break;					
		case 9:
			$filter_sql = "WHERE YEAR(a.training_date)=2013"; break;					
		case 10:
			$filter_sql = "WHERE YEAR(a.training_date)=2014"; break;					
		case 11:
			$filter_sql = "WHERE YEAR(a.training_date)=2015"; break;					
		case 12:
			$filter_sql = "WHERE YEAR(a.training_date)=2016"; break;								
		default :
			$filter_sql = 'WHERE a.training_date >= now()';
		}	
				
		$column = 'ORDER BY `'.$sort_column.'` '.$sort_type;						
		$sql = "SELECT count(id) as 'value' FROM (SELECT a.*, c.title FROM `asp_training_schedule` a LEFT JOIN `asp_training_info` c ON a.training_info_id = c.id  $filter_sql) b  WHERE b.code like '%$find%' or b.training_location like '%$find%'";

		$rec_count = $this->dao->query( $sql );				
				
		if (is_array($rec_count)) { foreach( $rec_count as $object ) $this->record_count = $object->value; }			
									
		$this->SetPageParameter($post);
				
		$sql = "SELECT * FROM (SELECT a.*, c.title FROM `asp_training_schedule` a LEFT JOIN `asp_training_info` c ON a.training_info_id = c.id  $filter_sql) b  WHERE b.code like '%$find%' or b.training_location like '%$find%' $column ".$this->sql_limitString();
		//echo $sql;
		return $this->dao->query( $sql );				
	}
	

	function &getScheduleList( $condition = '' ) {
		$sql = "SELECT a.*, c.title, c.id as 'training_id' FROM `asp_training_schedule` a LEFT JOIN `asp_training_info` c ON a.training_info_id = c.id ".$condition; 		
		//echo $sql.'<br/>';
		return $this->dao->query( $sql );
	}

	function &getRow( $id ) {			
		 return $this->getRecord( 'asp_training_schedule', $id );	
	}
	
	function &getRowObj( $id ) {			
		 return $this->getRecordObj( 'asp_training_schedule', $id );	
	}

	
	function addRow( $post )
	{		
		$code  	  	 		= $this->dao->escape(trim($post['code']));
		$training_date  	= trim($post['training_date']); 
		$training_info_id 	= trim($post['training_info_id']);
		$training_location	= $this->dao->escape(trim($post['training_location']));
		$visible		 	= ( trim( $post['visible'] ) )?$this->dao->escape( trim( $post['visible'] ) ):'0';
		$price 				= trim($post['price']);
		$price_promo		= trim($post['price_promo']);
		$schedule_comment	= $this->dao->escape(trim($post['schedule_comment']));

		
		$sql  = "INSERT INTO asp_training_schedule (code, training_date, training_info_id, training_location, visible, price, price_promo, schedule_comment, create_date, update_date) ";
		$sql .= "VALUES ({$code}, '$training_date', {$training_info_id}, {$training_location}, {$visible}, {$price}, {$price_promo}, {$schedule_comment}, now(), now())";
		//echo $sql;
		$this->dao->query( $sql );		
		$this->lastId = mysql_insert_id();
	}

	
	function updateRow( $post )
	{		
		$id              	= $post['id'];
		$code  	  	 		= $this->dao->escape(trim($post['code']));
		$training_date  	= trim($post['training_date']); 
		$training_info_id 	= trim($post['training_info_id']);
		$training_location	= $this->dao->escape(trim($post['training_location']));
		$visible		 	= ( trim( $post['visible'] ) )?$this->dao->escape( trim( $post['visible'] ) ):'0';
		$price 				= trim($post['price']);
		$price_promo		= trim($post['price_promo']);
		$schedule_comment	= $this->dao->escape(trim($post['schedule_comment']));
						
		$sql = "UPDATE asp_training_schedule SET code = {$code}, training_date = '$training_date', training_info_id = {$training_info_id}, training_location = {$training_location}, visible = {$visible}, price = {$price}, update_date = now(), price_promo = {$price_promo}, schedule_comment = {$schedule_comment} WHERE id=".$id;
		//echo $sql;
		$this->dao->query( $sql );		
	}


	function deleteRows( $ids )	{
		return $this->DeleteIds('asp_training_schedule',$ids);
	}
	
	function HandlingList () {
		$sql = 'SELECT c.training_date, a.schedule_id, a.instructor_id, b.first_name, b.last_name, b.description, b.email  FROM asp_training_instructors_item a ';
 		$sql.= 'LEFT JOIN asp_training_instructors b ON a.instructor_id = b.id ';
 		$sql.= 'LEFT JOIN asp_training_schedule c ON a.schedule_id = c.id ';
		$sql.= 'WHERE c.training_date >= now() ';
		return $this->dao->query( $sql );
	}
			
	function changeVisible( $post ) {	
		$ids = $post['cid'];
		$list_id = $this->array_to_string($ids);
		$sql = "UPDATE asp_training_schedule SET visible=NOT(visible) WHERE id IN ($list_id)";	
		return $this->dao->query( $sql );	
	}

	function deleteInstructorsHandling( $post ) {
		
		$schedule_id = $post['id'];
		$instructors = $post['instructors'];
		$list_id = $this->array_to_string($instructors);
		
		$sql = "DELETE FROM asp_training_instructors_item WHERE schedule_id = {$schedule_id} and instructor_id IN (".$list_id.")";
		//echo $sql;
		return $this->dao->query( $sql );		
	}

	function deleteInstructorsHandlingAll( $schedule_id ) {
		$sql = "DELETE FROM asp_training_instructors_item WHERE schedule_id = {$schedule_id}";
		return $this->dao->query( $sql );		
	}

	function addInstructorsHandling( $post ) {
		
		$schedule_id = $post['id'];
		$instructors = $post['instructors'];
		
		$this->deleteInstructorsHandlingAll( $schedule_id );	
		
		$list_id = $this->array_to_string($instructors);
		
		$sql = "INSERT INTO asp_training_instructors_item (schedule_id, instructor_id) ";
		$sql.= "SELECT ".$schedule_id.", id FROM asp_training_instructors WHERE id IN (".$list_id.")";
		//echo $sql;
		return $this->dao->query( $sql );						
	}		
}

?>