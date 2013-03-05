<?php

class TrainingInfo extends Main
{

	function TrainingInfo(&$dao) 
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
			$filter_sql = "AND special=0"; break;			
		case 2:
			$filter_sql = "AND special=1"; break;					
		case 3:
			$filter_sql = "AND visible=0"; break;					
		default :
			$filter_sql = '';
		}	
				
		$column = 'ORDER BY `'.$sort_column.'` '.$sort_type;						
		$sql = "SELECT count(id) as 'value' FROM `asp_training_info` WHERE (title like '%$find%' or context like '%$find%' or introduction like '%$find%') $filter_sql";

		$rec_count = $this->dao->query( $sql );				
				
		if (is_array($rec_count)) { foreach( $rec_count as $object ) $this->record_count = $object->value; }			
									
		$this->SetPageParameter($post);
				
		$sql = "SELECT * FROM `asp_training_info` WHERE (title like '%$find%' or context like '%$find%' or introduction like '%$find%') $filter_sql $column ".$this->sql_limitString();
		//echo $sql;
		return $this->dao->query( $sql );				
	}
	
	function getTrainingInfo( $condition = '' ) {
		$sql = "SELECT * FROM `asp_training_info` ".$condition;
		return $this->dao->query( $sql );				
	}
	

	function &getRow( $id ) {			
		 return $this->getRecord( 'asp_training_info', $id );	
	}
	
	
	function addRow( $post )
	{		
		$prefix_code	 = $this->dao->escape(trim($post['prefix_code']));
		$title_m  	  	 = htmlspecialchars($this->dao->escape(trim($post['title_m'])));
		$introduction_m  = ($this->dao->escape(trim($post['introduction_m']))); 
		$context_m 		 = ($this->dao->escape(trim($post['context_m'])));
		$instructors_m 	 = ($this->dao->escape(trim($post['instructors_m'])));
		$description_m 	 = ($this->dao->escape(trim($post['description_m'])));
		$special_m		 = ( trim( $post['special_m'] ) )?$this->dao->escape( trim( $post['special_m'] ) ):'0';
		$visible_m		 = ( trim( $post['visible_m'] ) )?$this->dao->escape( trim( $post['visible_m'] ) ):'0';
		$intro_visible_m = ( trim( $post['intro_visible_m'] ) )?$this->dao->escape( trim( $post['intro_visible_m'] ) ):'0';
		$sort_order      = "'".$post['sort_order']."'"; 
		
		$sql  = "INSERT INTO asp_training_info (description_m, instructors_m, prefix_code, title_m, introduction_m, context_m, special_m, visible_m, intro_visible_m, create_date, update_date, sort_order) ";
		$sql .= "VALUES ({$description_m}, {$instructors_m},{$prefix_code},{$title_m}, {$introduction_m}, {$context_m}, {$special_m}, {$visible_m}, {$intro_visible_m}, now(), now(), {$sort_order})";
		//echo $sql;
		$this->dao->query( $sql );		
		$this->lastId = mysql_insert_id();
	}

	function publish ( $id ) {
		$sql = "UPDATE asp_training_info SET instructors = instructors_m, description = description_m, title = title_m, introduction = introduction_m, context = context_m, visible = visible_m, intro_visible = intro_visible_m, special = special_m, update_date = now() WHERE id=".$id;
		//echo $sql;
		$this->dao->query( $sql );			
	}

	function unpublish ( $id ) {
		$sql = "UPDATE asp_training_info SET instructors_m = instructors, description_m = description, title_m = title, introduction_m = introduction, context_m = context, visible_m = visible, intro_visible_m = intro_visible, special_m = special, update_date = now() WHERE id=".$id;
		//echo $sql;
		$this->dao->query( $sql );			
	}

	
	function updateRow( $post )
	{		
		$id              = $post['id'];
		$prefix_code	 = $this->dao->escape(trim($post['prefix_code']));
		$title_m  	  	 = htmlspecialchars($this->dao->escape(trim($post['title_m'])));
		$introduction_m  = $this->dao->escape(trim($post['introduction_m'])); 
		$context_m 		 = $this->dao->escape(trim($post['context_m']));
		$instructors_m 	 = $this->dao->escape(trim($post['instructors_m']));
		$description_m 	 = $this->dao->escape(trim($post['description_m']));		
		$special_m		 = ( trim( $post['special_m'] ) )?$this->dao->escape( trim( $post['special_m'] ) ):'0';
		$visible_m		 = ( trim( $post['visible_m'] ) )?$this->dao->escape( trim( $post['visible_m'] ) ):'0';
		$intro_visible_m = ( trim( $post['intro_visible_m'] ) )?$this->dao->escape( trim( $post['intro_visible_m'] ) ):'0';
		$sort_order      = "'".$post['sort_order']."'"; 
				
		$sql = "UPDATE asp_training_info SET ";
		$sql.= "instructors_m = {$instructors_m}, ";
		$sql.= "description_m = {$description_m}, ";
		$sql.= "prefix_code = {$prefix_code}, ";
		$sql.= "title_m = {$title_m}, ";
		$sql.= "introduction_m = {$introduction_m}, ";
		$sql.= "context_m = {$context_m}, ";
		$sql.= "visible_m = {$visible_m}, ";
		$sql.= "intro_visible_m = {$intro_visible_m}, ";
		$sql.= "special_m = {$special_m}, ";
		$sql.= "update_date = now(), ";
		$sql.= "sort_order = {$sort_order} ";
		$sql.= "WHERE id=".$id;
		//echo $sql;
		$this->dao->query( $sql );		
	}


	function deleteRows( $ids )
	{
		return $this->DeleteIds('asp_training_info',$ids);
	}
	
			
	function changeVisible ( $post )
	{	
		$ids = $post['cid'];
		$list_id = $this->array_to_string($ids);
		$sql = "UPDATE asp_training_info SET visible = NOT(visible), visible_m=visible WHERE id IN ($list_id)";	
		return $this->dao->query( $sql );	
	}

	function changeIntroVisible ( $post )
	{	
		$ids = $post['cid'];
		$list_id = $this->array_to_string($ids);
		$sql = "UPDATE asp_training_info SET intro_visible=NOT(intro_visible), intro_visible_m=intro_visible WHERE id IN ($list_id)";	
		return $this->dao->query( $sql );	
	}

	function changeIntroduction ( $post )
	{	
		$ids = $post['cid'];
		$list_id = $this->array_to_string($ids);
		$sql = "UPDATE asp_training_info SET introduction=NOT(introduction), introduction_m=introduction WHERE id IN ($list_id)";	
		return $this->dao->query( $sql );	
	}

	function changeSpecial ( $post )
	{	
		$ids = $post['cid'];
		$list_id = $this->array_to_string($ids);
		$sql = "UPDATE asp_training_info SET special=NOT(special), special_m=special WHERE id IN ($list_id)";	
		return $this->dao->query( $sql );	
	}

	function changeOrder ( $post )
	{	
		$orderid = $post['orderid'];
		$orders = $post['order'];
		if (is_array($orderid)) {
			for ($i = 0; $i<count($orderid); $i++) {				
				$sql = "UPDATE asp_training_info SET sort_order={$orders[$i]} WHERE id IN ($orderid[$i])";
				//echo $sql;
				$this->dao->query( $sql );		
			}
		}
		
	}

			
}

?>