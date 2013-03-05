<?php

class MailTemplate extends Main
{

	function MailTemplate(&$dao) {
	
		$this->Main(&$dao);
	}		
					
	function &getList( $post, $input_sort_column ='table_sort_column',$input_sort_type ='table_sort_type' ) {
	
		$sort_column = (!isset( $post[$input_sort_column] ) or ( trim($post[$input_sort_column]) == '' )) ? 'id' : trim($post[$input_sort_column]);
		$sort_type   = (!isset( $post[$input_sort_type] ) or ( trim($post[$input_sort_type]) == '' )) ? 'ASC' : trim($post[$input_sort_type]);
		$find        = trim($post['find']);
		
		
		$column = 'ORDER BY `'.$sort_column.'` '.$sort_type;						
		$sql = "SELECT count(id) as 'value' FROM `asp_mail_template` WHERE name like '%$find%'";

		$rec_count = $this->dao->query( $sql );				
		
		if (is_array($rec_count)) { foreach( $rec_count as $object ) $this->record_count = $object->value; }			
									
		$this->SetPageParameter($post);
				
		$sql = "SELECT * FROM `asp_mail_template` WHERE name like '%$find%' $column ".$this->sql_limitString();
		return $this->dao->query( $sql );				
	}
	
	function &getListToSelect() {
	
		$sql = "SELECT * FROM `asp_mail_template`";
		return $this->dao->query( $sql );				
		
	}
	

	function &getRowId( $id ) {
	
		 return $this->getRecord( 'asp_mail_template', $id );	
	}
	
	
	function addRow( $field )	{		
	
		$name        = trim($field['name']);
		$template    = trim($field['template']);
		$tem_comment = trim($field['tem_comment']);
		
		$sql = "INSERT INTO asp_mail_template (name, create_date, update_date, template, tem_comment) VALUES ('$name', now(), now(),'$template', '$tem_comment')";
		

		$this->dao->query( $sql );		
		$this->lastId = mysql_insert_id();
	}




	function updateRow( $field ) {		
	
		$id          = trim($field['id']);		
		$visible     = ($field['visible'])? 1 : 0;
		$name        = $this->dao->escape( trim($field['name']) );
		$template    = $this->dao->escape( trim($field['template']) );
		$tem_comment = $this->dao->escape( trim($field['tem_comment']) );

		$sql = "UPDATE asp_mail_template SET name = $name, template = $template, update_date = now(), visible = $visible, tem_comment = $tem_comment  WHERE id=".$id;
		//echo $sql;
		$this->dao->query( $sql );		
	}


	function deleteRows( $ids )	{
	
		return $this->DeleteIds('asp_mail_template',$ids);
	}
		
	
	function changeVisible ( $post )	{	
	
		$ids = $post['cid'];
		$list_id = $this->array_to_string($ids);
		$sql = "UPDATE asp_mail_template SET visible=NOT(visible) WHERE id  IN ($list_id)";	
		return $this->dao->query( $sql );	
	}
	
			
}

?>