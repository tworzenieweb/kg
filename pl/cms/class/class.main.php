<?php
class Main
{
	var $dao = null;
	
	var $position = 0; 
	var $limit;	
	var $default_page = 1;
	var $last_page = 1;
	
	var $record_count = 0;	
	var $default_limit = 20; 
	
	var $lastId = 0;
	
	function Main( &$dao ) {
		$this->dao = $dao;
	}
	
	function DeleteIds ( $table_name, $ids, $field='id', $condition='' ) {
		$list_id = $this->array_to_string($ids);
		$sql = "DELETE FROM ".$table_name." WHERE ".$field." IN (".$list_id.") ".$condition;
		return $this->dao->query( $sql );			
	}
			
	function array_to_string( $cid ) {
	
		if (is_array($cid)) {
			for ($i = 0; $i<count($cid); $i++) 
				$ss .= (($i+1) < count($cid))? $cid[$i].', ':$cid[$i];
			return $ss;		
		}	else {
			return 0;	
		}	
	}
	
	function SetPageParameter ($post, $position_input_name = 'list_start_position', $limit_input_name = 'list_limit', $number = '') {
			
		$position_old = ($post[$position_input_name]) ?  $post[$position_input_name] : 0;
		$this->limit = ($post[$limit_input_name]) ?  $post[$limit_input_name] : $this->default_limit;
		
		switch ( $post['action'] ) {		
		case 'save'.$number: //last_position
			$this->position = floor( $this->record_count / $this->limit ) * $this->limit;			
			break;	
		case 'delete'.$number:
			$this->position = ( $position_old < $this->record_count ) ? $position_old : floor( $this->record_count / $this->limit ) * $this->limit;
			break;	
		case 'first'.$number:
			$this->position = 0;
			break;
		case 'last'.$number:
			$this->position = floor( $this->record_count / $this->limit ) * $this->limit;
			break;
		case 'next'.$number:
			$this->position = ( ($position_old + $this->limit) < $this->record_count ) ? $position_old + $this->limit : floor( $this->record_count / $this->limit ) * $this->limit;
			break;	
		case 'prev'.$number:
			$this->position = ( ($position_old - $this->limit) >= 0 ) ? $this->limit : 0;
			break;		
		case 'find'.$number:
			$this->position = 0;
			break;			
		case 'change_limit'.$number:
			$this->position = 0;
			break;				
		default:
			//$this->position = ( ($position_old + $this->limit) < $this->record_count ) ? $position_old + $this->limit : floor( $this->record_count / $this->limit ) * $this->limit;		
			$this->position = $position_old;
			
		}		
		$this->default_page = @ceil(($this->position + $this->limit -1)/ $this->limit);
		$this->last_page = ceil(@($this->record_count / $this->limit ));
	}
	
	function &getRecord( $table_name, $id ) {		
		$sql = "SELECT * FROM ".$table_name." WHERE id=".$id; 
		//echo $sql;
		return $this->dao->query( $sql );	
	}

	function &getRecordObj( $table_name, $id ) {		
		$sql = "SELECT * FROM ".$table_name." WHERE id=".$id; 
		$record = $this->dao->query( $sql );	
		if ( is_array( $record ) ) { 
				foreach( $record as $object ) { 
					return $object;
				}
		}		
	}

	
	function sql_limitString() {  
		return 'LIMIT '.$this->position.', '.$this->limit;
	}
	
	function navigationString( $number = '' ) {	
	return 	'<a href="javascript:submitbutton(\'first'.$number.'\');">I&lt;</a> <a href="javascript:submitbutton(\'prev'.$number.'\');">&lt;</a> '.$this->default_page.'/'.$this->last_page.' <a href="javascript:submitbutton(\'next'.$number.'\');">&gt;</a> <a href="javascript:submitbutton(\'last'.$number.'\');">&gt;I</a>';	
	}
}

?>