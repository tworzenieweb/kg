<?php
class Action
{
	var $dao = null;
	
	var $position = 0; 
	var $limit;	
	var $default_page = 1;
	var $last_page = 1;
	
	var $record_count = 0;
	
	var $default_limit = 25; 
	
	var $lastId = 0;
	
	function Action( &$dao ) {
		$this->dao = $dao;
	}
	
	function DeleteIds ( $table_name, $ids ) {
		$list_id = $this->array_to_string($ids);
		$sql = "DELETE FROM ".$table_name." WHERE id IN (".$list_id.")";
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
	
	function SetPageParameter ($post, $position_input_name = 'list_start_position', $limit_input_name = 'list_limit') {
			
		$position_old = ($post[$position_input_name]) ?  $post[$position_input_name] : 0;
		$this->limit = ($post[$limit_input_name]) ?  $post[$limit_input_name] : $this->default_limit;
		
		switch ( $post['action'] ) {		
		case 'add': //last_position
			$this->position = floor( $this->record_count / $this->limit ) * $this->limit;			
			break;	
		case 'delete':
			$this->position = ( $position_old < $this->record_count ) ? $position_old : floor( $this->record_count / $this->limit ) * $this->limit;
			break;	
		case 'first':
			$this->position = 0;
			break;
		case 'last':
			$this->position = floor( $this->record_count / $this->limit ) * $this->limit;
			break;
		case 'next':
			$this->position = ( ($position_old + $this->limit) < $this->record_count ) ? $position_old + $this->limit : floor( $this->record_count / $this->limit ) * $this->limit;
			break;	
		case 'prev':
			$this->position = ( ($position_old - $this->limit) >= 0 ) ? $this->limit : 0;
			break;		
		default :
			$this->position = $position_old;
		
		}
		
		$this->default_page = @ceil(($this->position + $this->limit -1)/ $this->limit);
		$this->last_page = ceil(@($this->record_count / $this->limit ));
	}
	
	function &getRecord( $table_name, $id ) {		
		$sql = "SELECT * FROM ".$table_name." WHERE id=".$id; 
		return $this->dao->query( $sql );
	
	}

	
	function sql_limitString() {  
		return 'LIMIT '.$this->position.', '.$this->limit;
	}
	
	function navigationString() {	
	return 	'<a href="javascript:submitbutton(\'first\');">I&lt;</a> <a href="javascript:submitbutton(\'prev\');">&lt;</a> '.$this->default_page.'/'.$this->last_page.' <a href="javascript:submitbutton(\'next\');">&gt;</a> <a href="javascript:submitbutton(\'last\');">&gt;I</a>';	
	}
}

?>