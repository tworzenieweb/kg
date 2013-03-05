<?php

class Instructors extends Main
{

	function Instructors(&$dao) 
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
		$sql = "SELECT count(id) as 'value' FROM (SELECT * FROM `asp_training_instructors` a $filter_sql) b  WHERE b.first_name like '%$find%' or b.last_name like '%$find%' or b.description like '%$find%'";

		$rec_count = $this->dao->query( $sql );				
				
		if (is_array($rec_count)) { foreach( $rec_count as $object ) $this->record_count = $object->value; }			
									
		$this->SetPageParameter($post);
				
		$sql = "SELECT * FROM (SELECT * FROM `asp_training_instructors` a $filter_sql) b  WHERE b.first_name like '%$find%' or b.last_name like '%$find%' or b.description like '%$find%' $column ".$this->sql_limitString();
		//echo $sql;
		return $this->dao->query( $sql );				
	}

	function &getInscructors( $schedule_id ) {
		$sql = "SELECT a.*,schedule_id FROM `asp_training_instructors` a LEFT JOIN (SELECT * FROM `asp_training_instructors_item` WHERE schedule_id={$schedule_id}) b ON a.id = b.instructor_id ";
		return $this->dao->query( $sql );
	}	

	function &getInscructorsList() {
		$sql = "SELECT * FROM `asp_training_instructors` WHERE visible=1 ORDER BY sort_order ASC";
		return $this->dao->query( $sql );
	}

	function &getRow( $id ) {			
	
		 return $this->getRecord( 'asp_training_instructors', $id );	
	}
	
	
	function addRow( $post ) {		
	
		$first_name  	= $this->dao->escape(trim($post['first_name']));
		$last_name  	= $this->dao->escape(trim($post['last_name'])); 
		$description 	= $this->dao->escape(trim($post['description']));
		$email 			= $this->dao->escape(trim($post['email']));
		$picture 		= $this->dao->escape(trim($post['picture']));
		$visible		= ( trim( $post['visible'] ) )?$this->dao->escape( trim( $post['visible'] ) ):'0';
		$sort_order     = "'".$post['sort_order']."'"; 
		
		$sql  = "INSERT INTO asp_training_instructors (first_name, last_name, description, email, picture, visible, create_date, update_date, sort_order) ";
		$sql .= "VALUES ({$first_name}, {$last_name}, {$description}, {$email}, {$picture}, {$visible}, now(), now(), {$sort_order})";
		//echo $sql;
		$this->dao->query( $sql );		
		$this->lastId = mysql_insert_id();
	}

	
	function updateRow( $post )	{		
	
		$id              = $post['id'];
		$first_name  	= $this->dao->escape(trim($post['first_name']));
		$last_name  	= $this->dao->escape(trim($post['last_name'])); 
		$description 	= $this->dao->escape(trim($post['description']));
		$email 			= $this->dao->escape(trim($post['email']));
		$picture 		= $this->dao->escape(trim($post['picture']));
		$visible		= ( trim( $post['visible'] ) )?$this->dao->escape( trim( $post['visible'] ) ):'0';
		$sort_order     = "'".$post['sort_order']."'"; 
						
		$sql = "UPDATE asp_training_instructors SET first_name = {$first_name}, last_name = {$last_name}, description = {$description}, email = {$email}, picture = {$picture}, visible = {$visible}, update_date = now(), sort_order = {$sort_order} WHERE id=".$id;
		//echo $sql;
		$this->dao->query( $sql );		
	}


	function deleteRows( $ids )	{
	
		return $this->DeleteIds('asp_training_instructors',$ids);
	}
	
			
	function changeVisible ( $post )
	{	
		$ids = $post['cid'];
		$list_id = $this->array_to_string($ids);
		$sql = "UPDATE asp_training_instructors SET visible=NOT(visible) WHERE id IN ($list_id)";	
		return $this->dao->query( $sql );	
	}

	function changeOrder ( $post )
	{	
		$orderid = $post['orderid'];
		$orders  = $post['order'];
		if (is_array($orderid)) {
			for ($i = 0; $i<count($orderid); $i++) {				
				$sql = "UPDATE asp_training_instructors SET sort_order={$orders[$i]} WHERE id IN ($orderid[$i])";
				//echo $sql;
				$this->dao->query( $sql );		
			}
		}
		
	}
			
}

?>