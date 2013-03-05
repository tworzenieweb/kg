<?php

class SitePage extends Main
{

	function SitePage($dao) 
	{
		$this->Main($dao);
	}	
					
	function getList( $post, $input_sort_column ='table_sort_column',$input_sort_type ='table_sort_type' ) 
	{
		$sort_column = (!isset( $post[$input_sort_column] ) or ( trim($post[$input_sort_column]) == '' )) ? 'id' : trim($post[$input_sort_column]);
		$sort_type   = (!isset( $post[$input_sort_type] ) or ( trim($post[$input_sort_type]) == '' )) ? 'ASC' : trim($post[$input_sort_type]);
		$filter		 = $post['filter'];
		$find        = trim($post['find']);
		
		switch ( $filter ) { 
		case 1:
			$filter_sql = "AND visible=0"; break;						
		default :
			$filter_sql = '';
		}	
				
		$column = 'ORDER BY b.name ASC, '.$sort_column.' '.$sort_type;						
		$sql = "SELECT count(id) as 'value' FROM `asp_site_page` WHERE (title like '%$find%' or context like '%$find%') $filter_sql";

		$rec_count = $this->dao->query( $sql );				
				
		if (is_array($rec_count)) { foreach( $rec_count as $object ) $this->record_count = $object->value; }			
									
		$this->SetPageParameter($post);
				
		$sql = "SELECT a.*,b.name FROM `asp_site_page` a LEFT JOIN asp_site_page_group b ON a.site_page_group_id=b.id WHERE (a.title like '%$find%' or a.context like '%$find%') $filter_sql $column ".$this->sql_limitString();
		//echo $sql;
		return $this->dao->query( $sql );				
	}
	
	function getTrainingInfo() {
		$sql = "SELECT * FROM `asp_site_page`";
		return $this->dao->query( $sql );				
	}
	

	function getRow( $id ) {			
		 return $this->getRecord( 'asp_site_page', $id );	
	}
	
	function getPageInfo( $id ) {
		$sql = 'SELECT a.*, b.name, b.site_controler, b.site_template, b.cms_controler, b.cms_template, b.cms_link_edit FROM asp_site_page a LEFT JOIN asp_site_page_group b ON a.site_page_group_id=b.id WHERE a.id='.$id;
		$pinf = $this->dao->query( $sql );
		if ( is_array($pinf) ) { 
			foreach( $pinf as $object )		
				return $object;
		}		
	}
	
	function addRow( $post )
	{		
		$site_page_group_id = $this->dao->escape(trim($post['site_page_group_id']));
		$prefix_code	    = $this->dao->escape(trim($post['prefix_code']));
		$title_m  	  	    = htmlspecialchars($this->dao->escape(trim($post['title_m'])));
		$context_m 		    = $this->dao->escape(trim($post['context_m']));
		$visible		    = ( trim( $post['visible'] ) )?$this->dao->escape( trim( $post['visible'] ) ):'0';
		$sort_order         = "'".$post['sort_order']."'"; 
		
		$sql  = "INSERT INTO asp_site_page (title_m, context_m,  visible, create_date, update_date, sort_order, site_page_group_id) ";
		$sql .= "VALUES ({$title_m}, {$context_m}, {$visible},  now(), now(), {$sort_order}, {$site_page_group_id})";
		//echo $sql;
		$this->dao->query( $sql );		
		$this->lastId = mysql_insert_id();
	}

	function publish ( $id ) 
	{
		$sql = "UPDATE asp_site_page SET title = title_m, context = context_m, update_date = now() WHERE id=".$id;
		//echo $sql;
		$this->dao->query( $sql );			
	}

	function unpublish ( $id ) 
	{
		$sql = "UPDATE asp_site_page SET title_m = title, context_m = context, update_date = now() WHERE id=".$id;
		//echo $sql;
		$this->dao->query( $sql );			
	}

	function updateRow( $post )
	{		
		$id              = $post['id'];
		$site_page_group_id = $this->dao->escape(trim($post['site_page_group_id']));
		$title_m  	  	 = htmlspecialchars($this->dao->escape(trim($post['title_m'])));
		$context_m 		 = ($this->dao->escape(trim($post['context_m'])));
		$visible		 = ( trim( $post['visible'] ) )?$this->dao->escape( trim( $post['visible'] ) ):'0';
		$sort_order      = "'".$post['sort_order']."'"; 
	
		$sql = "UPDATE asp_site_page SET site_page_group_id = {$site_page_group_id}, title_m = {$title_m}, context_m = {$context_m}, visible = {$visible},  update_date = now(), sort_order = {$sort_order} WHERE id=".$id;
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
		$sql = "UPDATE asp_site_page SET visible=NOT(visible) WHERE id IN ($list_id)";	
		return $this->dao->query( $sql );	
	}

	function changeOrder ( $post )
	{	
		$orderid = $post['orderid'];
		$orders = $post['order'];
		if (is_array($orderid)) {
			for ($i = 0; $i<count($orderid); $i++) {				
				$sql = "UPDATE asp_site_page SET sort_order={$orders[$i]} WHERE id IN ($orderid[$i])";
				//echo $sql;
				$this->dao->query( $sql );		
			}
		}
		
	}

	function page_list() {
		$sql = 'SELECT * FROM asp_site_page';
		return $this->dao->query( $sql );		
	}			

	function group_page_list() {
		$sql = 'SELECT * FROM asp_site_page_group';
		return $this->dao->query( $sql );		
	}		
}

?>