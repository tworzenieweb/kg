<?php

class Password
{
	var $dao = null;
	
	function Password( &$dao )
	{
		$this->dao = $dao;
	}
	
	function checkPassword( $password, $login = null )
	{
		$result = false;
		
		$sql = "SELECT * FROM asp_cms_user WHERE active=1 AND";
		$sql .= " password=".$this->dao->escape($password);
		$sql .= ($login)?" AND login=".$this->dao->escape($login):"";
				
		$temp = &$this->dao->query( $sql );
		
		if ( count( $temp ) )
		{
			if ( is_array( $temp ) ) { 
				foreach( $temp as $object )
				$_SESSION['user_login'] = $object->first_name;
			}	
			$result = true;
		}
		
		return $result;
	}
	
}

?>