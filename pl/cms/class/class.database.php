<?php

class Database 
{
	var $user = null;
	var $password = null;
	var $host = null;
	var $database = null;
	var $connection = null;
	
	function Database( $user, $password, $database, $host )
	{
		$this->user = $user;
		$this->password = $password;
		$this->database = $database;
		$this->host = $host;
		
		$this->connect();
	}
			
	function connect()
	{
		if ( is_null( $this->connection ) )
		{
			$db = @mysql_connect( $this->host, $this->user, $this->password );
			$result = @mysql_select_db( $this->database, $db );
			
			if ( $result )
			{
        mysql_query('SET NAMES LATIN2', $db);
				$this->connection = $db;
			}
		}
	}
	
	function getConnection()
	{
		//if ( is_null( $this->connection ) )
		//{
		//	$this->connection();
		//}
		
		return $this->connection;
	}
	
	function &query( $sql )
	{
		//print $sql.'<br>';
		return $this->fetch( @mysql_query( $sql, $this->connection ) );
	}
	
	function escape( $text )
	{
		if (!get_magic_quotes_gpc()) {
   			//return "'".(mysql_real_escape_string( $text ))."'";
			return "'".addslashes( $text )."'";
		} else {
   			return "'".$text."'";
		}
		
		//return mysql_real_escape_string( $text );
	}
		
	
	function &fetch( $result )
	{
		$list = null;
		
		if ( $result && !is_bool( $result ) )
		{
			while ( $row = mysql_fetch_object( $result ) )
			{
				$list[] = $row;
			};
			
			@mysql_free_result( $result );
		}  
		
		return $list;
	}
	
	
}

?>