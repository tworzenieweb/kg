<?php

class SiteMenu extends Main
{

	function SiteMenu($dao) 
	{
		$this->Main($dao);
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
		default :
			$filter_sql = '';
		}	
				
		$column = 'ORDER BY b.menu_group_name ASC, '.$sort_column.' '.$sort_type;						
		$sql = "SELECT count(id) as 'value' FROM `asp_site_menu`";

		$rec_count = $this->dao->query( $sql );				
		
		if (is_array($rec_count)) { foreach( $rec_count as $object ) $this->record_count = $object->value; }			
									
		$this->SetPageParameter($post);
				
		$sql = "SELECT a.*, b.menu_group_name, c.title, c.title_m, c.context, c.context_m FROM `asp_site_menu` a ";
		$sql.= "LEFT JOIN asp_site_menu_group b ON a.menu_group_id=b.id ";
		$sql.= "LEFT JOIN asp_site_page c ON a.page_id=c.id ";
		$sql.= "LEFT JOIN asp_site_page_group d ON c.site_page_group_id=d.id ";
		$sql.= "WHERE (a.name like '%$find%') $filter_sql $column ".$this->sql_limitString();
		//echo $sql;
		return $this->dao->query( $sql );				
	}
	
	
	function getMenu( $menu_group_id ) {
		$sql = "SELECT * FROM `asp_site_menu` WHERE menu_group_id={$menu_group_id} and visible=1";
		//echo $sql;
		return $this->dao->query( $sql );				
	}	

	function getRow( $id ) {			
		 return $this->getRecord( 'asp_site_menu', $id );	
	}
	
	
	function addRow( $post )
	{		
		$page_id 	 = $this->dao->escape(trim($post['page_id']));
		$name  	  	 = htmlspecialchars($this->dao->escape(trim($post['name'])));
		$link 		 = htmlspecialchars($this->dao->escape(trim($post['link'])));
		$visible	 = ( trim( $post['visible'] ) )?$this->dao->escape( trim( $post['visible'] ) ):'0';
		$menu_group_id = $post['menu_group_id'];
		$sort_order  = "'".$post['sort_order']."'"; 
		
		$sql  = "INSERT INTO asp_site_menu (menu_group_id, name, sort_order, visible, page_id, link) ";
		$sql .= "VALUES ({$menu_group_id}, {$name}, {$sort_order}, {$visible}, {$page_id}, {$link})";
		//echo $sql;
		$this->dao->query( $sql );		
		$this->lastId = mysql_insert_id();
	}


	function updateRow( $post )
	{		
		$id            = $post['id'];
		$menu_group_id = $post['menu_group_id'];
		$page_id 	   = $this->dao->escape(trim($post['page_id']));
		$name  	  	   = htmlspecialchars($this->dao->escape(trim($post['name'])));
		$link 		   = htmlspecialchars($this->dao->escape(trim($post['link'])));
		$visible	   = ( trim( $post['visible'] ) )?$this->dao->escape( trim( $post['visible'] ) ):'0';
		$sort_order    = "'".$post['sort_order']."'"; 
	
		$sql = "UPDATE asp_site_menu SET menu_group_id = {$menu_group_id}, page_id = {$page_id}, name = {$name}, link = {$link}, visible = {$visible},  sort_order = {$sort_order} WHERE id=".$id;
		$this->dao->query( $sql );		
	}

	function deleteRows( $ids )
	{
		return $this->DeleteIds('asp_site_menu',$ids);
	}
	
			
	function changeVisible ( $post )
	{	
		$ids = $post['cid'];
		$list_id = $this->array_to_string($ids);
		$sql = "UPDATE asp_site_menu SET visible=NOT(visible) WHERE id IN ($list_id)";	
		return $this->dao->query( $sql );	
	}

	function changeVisible2 ( $post )
	{	
		$id = $post['id'];
		$sql = "UPDATE asp_site_menu SET visible=NOT(visible) WHERE id IN ($id)";	
		return $this->dao->query( $sql );	
	}


	function changeOrder ( $post )
	{	
		$orderid = $post['orderid'];
		$orders = $post['order'];
		if (is_array($orderid)) {
			for ($i = 0; $i<count($orderid); $i++) {				
				$sql = "UPDATE asp_site_menu SET sort_order={$orders[$i]} WHERE id IN ($orderid[$i])";
				//echo $sql;
				$this->dao->query( $sql );		
			}
		}
		
	}

	function menuGroupList () {
		$sql = 'SELECT * FROM asp_site_menu_group';
		return $this->dao->query( $sql ); 		
	}
	
	function group_page_list() {
		$sql = 'SELECT * FROM asp_site_page_group';
		return $this->dao->query( $sql );		
	}		
	
}

?>