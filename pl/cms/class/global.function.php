<?php

	//Wsparcie przy tworzeniu komunikatów w hintach
	function createHint($h_items, $h_type, $h_caption, $h_below='BELOW',$h_position='RIGHT') {
		foreach($h_items as $h_item)
		$h_table.= '<tr><td>'.$h_item.'</td></tr>';
		$h_table = '<table>'.$h_table.'</table>';
		return 'onmouseover="return overlib(\''.$h_table.'\', '.$h_type.', \''.$h_caption.'\', '.$h_below.', '.$h_position.');" onmouseout="return nd();"';
	}

	//Sprawdzanie poprawno¶ci adresu email
	function checkmail($email) {
	if (eregi("^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.([a-z]{2}|com|edu|gov|int|mil|net|org|shop|aero|biz|coop|info|museum|name|pro)$", $email, $check)) { 
		if(getmxrr(substr(strstr($check[0], '@'), 1), $validate_email_temp)) { 
			return true;
			}
		if(checkdnsrr(substr(strstr($check[0], '@'), 1),"ANY")){
			return true;
			}
		}
	return false;
	}
	//Adres IP
	function getClientIP() {
        $ip = 0;

        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            $ip = $_SERVER['HTTP_CLIENT_IP'];

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipList = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip) {
                array_unshift($ipList, $ip);
                $ip = 0;
            }
            foreach ($ipList as $v)
            if (!eregi("^(192\.168|172\.16|10|224|240|127|0)\.", $v))
                return $v;
        }
        return $ip ? $ip : $_SERVER['REMOTE_ADDR'];
    }

?>
