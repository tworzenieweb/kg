<?php

class mySQLObject {

	var $connection;
	var $databese;
	var $query;
	var $result = array();
	var $records = array();
	var $queries = 0;
	var $lastId;

	function error() {
		echo '<b>'.mysql_errno().'</b>: '.mysql_error().'<br>';
	}

	function connect($host, $user, $password, $database, $persistent=FALSE) {
	
		$this->connection = ($persistent==TRUE) ? mysql_pconnect($host, $user, $password) : mysql_connect($host, $user, $password);
		
		if ($this->connection && $database != "") {
			$this->database = mysql_select_db($database, $this->connection);
				
			if ($this->database) {
				return TRUE;
			} else {
				$this->error();
				mysql_close($this->connection);
				return FALSE;
			}
		} else {
			$this->error();
			return FALSE;
		}
	}
	
	
	function close() {
	
		if ($this->connection) {		
			if ($this->result) mysql_free_result($this->result);			
			mysql_close($this->connection);
			
			unset($this->query);
			unset($this->result);
			unset($this->database);
			unset($this->connection);
			
			return TRUE;
		} else {
			$this->error();
		}								
	}
	

	function query($query) {
		if($query != "" && $this->database) {
			$this->query = $query;
			if ($this->result) mysql_free_result($this->result);
			if ($this->result = mysql_query($this->query, $this->connection)) {
			
				$this->lastId = mysql_insert_id();
				$this->queries++;
				
				return $this->result;
			} else {
				$this->error();
			}
		} else {
			$this->error();
		}
	}
	
	
	function fetchArray($resultHandle = 0) {
	
		$this->result = ($resultHandle==0) ? $this->result : $resultHandle;
		
		if ($this->database && $this->result) {
			
			$this->records = mysql_fetch_array($this->result, MYSQL_ASSOC);
			if (is_array($this->records)) { 
				return $this->records; 
			} else {
				$this->error();
			}						
		} else {
			$this->error();	
		}
	}

	function fetchRow($resultHandle = 0) {
	
		$this->result = ($resultHandle==0) ? $this->result : $resultHandle;
		
		if ($this->database) {
			
			$this->records = mysql_fetch_row($this->result, MYSQL_ASSOC);
			if ($this->records) { 
				return $this->records; 
			} else {
				$this->error();
			}						
		} else {
			$this->error();	
		}
	}	

	function numRows() {
		if ($numRows = mysql_num_rows($this->result)) {
			return $numRows;
		} else {
			$this->error();
		}	
	}
}	
	
?>