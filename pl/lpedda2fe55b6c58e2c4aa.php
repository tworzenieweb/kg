<?php
error_reporting(E_ALL ^ E_NOTICE);
$lp_version='2.3.5.9.6';
if (!isset($_SERVER)) $_SERVER=$HTTP_SERVER_VARS;

function linkujpro_getdata_local($adres) {
  $data='';
  if ($p=@fopen($adres,'r')) {
    while (!feof($p)) $data.=fgets($p,262144);
    fclose($p);
    return $data;
  }
  else return 'ERROR';
}
function linkujpro_getdata($adres) {
  $data='';
  $conn=linkujpro_http_connect($adres);
  if ($conn) {
    while(!feof($conn)) $data.=fread($conn,524288);
    $eof=feof($conn);
    fclose($conn);
    if (!$eof) return 'ERROR';
    return $data;
  }
  return 'ERROR';
}
function linkujpro_http_connect($adres) {
  ## laczenie przez socket
  $url_czesci=parse_url($adres);
  $site_url=$url_czesci['path'];
  if ($url_czesci['query']) $site_url.='?'.$url_czesci['query'];
  $timeout=20;
  $port= 80;
  $errnum=0;
  $errmsg='';
  $file=@fsockopen($url_czesci['host'],$port,$errnum,$errmsg,$timeout);
  if ($file) {
    $message='GET '.$site_url." HTTP/1.0\r\n";
    $message.='Host: '.$url_czesci['host']."\r\n\r\n";
    fwrite($file,$message);
    $status=fgets($file,1024);
    $status_array=explode(' ',$status,3);
    if (!isset($status_array[1])) return false;
    $status_array[1]=intval($status_array[1]);
    if (($status_array[1]<200)||($status_array[1]>299)) return false;
    while(!feof($file)) {
      $back=fgets($file, 10240);
      if ($back=="\r\n") return $file;
    }
    return false;
  }
  return false;
  ## laczenie przez socket
}
function linkujpro_getsettingpath() {
  $linkuj_settings='edda2fe55b6c58e2c4aa.txt';
  while(!file_exists($dir.$linkuj_settings)&&$n<20) {
    $dir.='../';
    $n++;
  }
  return $dir.$linkuj_settings;
}
function linkujpro_getsettings() {
  global $lp_settings;
  $settings=linkujpro_getdata_local(linkujpro_getsettingpath());
  if ($settings=='ERROR') $lp_settings['komunikat']='Nie moge czytac z pliku tekstowego';
  else {
    $settings=explode('<linkujpro>',$settings);
    $settings[0]!=''?$lp_settings['urle']=			$settings[0]:$lp_settings['urle']=			'';
    $settings[1]!=''?$lp_settings['urle_il']=		$settings[1]:$lp_settings['urle_il']=		0;
    $settings[2]!=''?$lp_settings['urle_nowe']=		$settings[2]:$lp_settings['urle_nowe']=		'';
    $settings[3]!=''?$lp_settings['urle_nowe_il']=	$settings[3]:$lp_settings['urle_nowe_il']=	0;
    $settings[4]!=''?$lp_settings['linki']=			$settings[4]:$lp_settings['linki']=			'';
    $settings[5]!=''?$lp_settings['lokalizacje']=	$settings[5]:$lp_settings['lokalizacje']=	'';
    $settings[6]!=''?$lp_settings['polaczenie']=	$settings[6]:$lp_settings['polaczenie']=	time()-86400;
    $settings[7]!=''?$lp_settings['test']=			$settings[7]:$lp_settings['test']=			0;
    $settings[8]!=''?$lp_settings['max_stron']=		$settings[8]:$lp_settings['max_stron']=		500;
    $settings[9]!=''?$lp_settings['request']=		$settings[9]:$lp_settings['request']=		0;
  }
  return;
}
function linkujpro_request() {
  global $lp_settings;
  linkujpro_getsettings();
  $url='http://www.linkujpro.pl/get.php5?id=edda2fe55b6c58e2c4aa&ac=gc';
  if ($f=@fopen($url,'r')) {
    if (function_exists('stream_set_timeout')) {stream_set_timeout($f,2);}
    $success=fread($f,2);
    if ($success=='OK') $lp_settings['request']='1';
    fclose($f);
  }
  linkujpro_savesettings();
}
function linkujpro_savesettings() {
	global $lp_settings;
	if ($p=@fopen(linkujpro_getsettingpath(),'r+')) {
		unset($lp_settings['komunikat']);
		if (flock($p,LOCK_EX)) {
			fwrite($p,implode('<linkujpro>',$lp_settings));
			ftruncate($p,ftell($p));
			flock($p,LOCK_UN);
		}
		fclose($p);
	}
	else $lp_settings['komunikat']='Nie moge zapisywac w pliku tekstowym';
	return;
}
$lp_link='http://www.linkujpro.pl/get.php5?id=edda2fe55b6c58e2c4aa';
if (substr($_SERVER['SCRIPT_NAME'],strlen($_SERVER['SCRIPT_NAME'])-24)=='edda2fe55b6c58e2c4aa.php') {
  switch($_REQUEST['ac']) {
    case 'lp_c_test':
      echo linkujpro_getdata($lp_link.'&ac=c_test');
      exit;
      break;
    case 'lp_getver':
      echo $lp_version;
      exit;
      break;
    case 'lp_r_site': //reset
      linkujpro_getsettings();
      if (!$lp_settings['komunikat']) {
        $lp_settings['urle_il']=linkujpro_getdata($lp_link.'&ac=gcount');
        if ($lp_settings['urle_il']=='ERROR') $lp_settings['komunikat']='Blad przy pobieraniu licznika URLi';
        else {
          $lp_settings['urle']=linkujpro_getdata($lp_link.'&ac=gurl');
          if ($lp_settings['urle']=='ERROR') $lp_settings['komunikat']='Blad przy pobieraniu listy URLi';
          else {
            $lp_settings['linki']=linkujpro_getdata($lp_link.'&ac=glink');
            if ($lp_settings['linki']=='ERROR') $lp_settings['komunikat']='Blad przy pobieraniu listy linków';
            else {
              $lp_settings['lokalizacje']=linkujpro_getdata($lp_link.'&ac=gloc');
              if ($lp_settings['lokalizacje']=='ERROR') $lp_settings['komunikat']='Blad przy pobieraniu listy lokalizacji';
              else {
                $lp_settings['polaczenie']=time()-86400;
                if ($_REQUEST['lp_test']=='on') $lp_settings['test']=1;
                else $lp_settings['test']=0;
                if ($_REQUEST['lp_maxstron']) $lp_settings['max_stron']=$_REQUEST['lp_maxstron'];
                linkujpro_savesettings();
                if (!$lp_settings['komunikat']) $lp_settings['komunikat']='OK';
              }
            }
          }
        }
      }
      break;
    case 'lp_s_test':
      linkujpro_getsettings();
      if ($_REQUEST['test']=='on') $lp_settings['test']=1;
      else $lp_settings['test']=0;
      linkujpro_savesettings();
      if (!$lp_settings['komunikat']) $lp_settings['komunikat']='OK';
      break;
    case 'lp_s_max':
      linkujpro_getsettings();
      if ($_REQUEST['l']>$lp_settings['max_stron']) $lp_settings['max_stron']=$_REQUEST['l'];
      linkujpro_savesettings();
      if (!$lp_settings['komunikat']) $lp_settings['komunikat']='OK';
      break;
    case 'lp_g_url':
      linkujpro_getsettings();
      $array=array('<U>'=>"\n",'</U>'=>'|');
      $urls=explode("\n",trim(str_replace(array_keys($array),$array,$lp_settings['urle_nowe'])));
      if (count($urls)>=$c) {
        foreach($urls as $url) {
          $n++;
          echo $url."\n";
          if ($n==$c) break;
        }
      }
      else $lp_settings['error']='ERROR';
      break;
    case 'lp_g_nurl':
      linkujpro_getsettings();
      if (!$lp_settings['komunikat']) {
        $urle_nowe=linkujpro_getdata($lp_link.'&ac=gnurl');
        if ($urle_nowe=='ERROR') $lp_settings['komunikat']='Blad przy pobieraniu listy nowych URLi';
        else {
          $ile=count(explode('<U>',$urle_nowe))-1;
          $lp_settings['urle_il']+=$ile;
          $lp_settings['urle'].=$urle_nowe;
          linkujpro_savesettings();
        }
      }
      break;
    case 'lp_g_links':
      linkujpro_getsettings();
      if (!$lp_settings['komunikat']) {
        $lp_settings['linki']=linkujpro_getdata($lp_link.'&ac=glink');
        if ($lp_settings['linki']=='ERROR') $lp_settings['komunikat']='Blad przy pobieraniu listy linków';
        else {
          $lp_settings['lokalizacje']=linkujpro_getdata($lp_link.'&ac=gloc');
          if ($lp_settings['lokalizacje']=='ERROR') $lp_settings['komunikat']='Blad przy pobieraniu listy lokalizacji';
          else {
            $lp_settings['polaczenie']=time()-86400;
            if ($_REQUEST['lp_test']=='on') $lp_settings['test']=1;
            else $lp_settings['test']=0;
            $lp_settings['max_stron']=$_REQUEST['lp_maxstron'];
            linkujpro_savesettings();
            if (!$lp_settings['komunikat']) $lp_settings['komunikat']='OK';
          }
        }
      }
      break;
    case 'newlink':
      linkujpro_getsettings();
      if (strpos($lp_settings['linki'],'<L'.$_REQUEST['link_id'].'><a href="'.$_REQUEST['link'].'">'.$_REQUEST['txt'].'</a></L>')===false) {
        $lp_settings['linki'].='<L'.$_REQUEST['link_id'].'><a href="'.$_REQUEST['link'].'">'.$_REQUEST['txt'].'</a></L>';
      }
      if (strpos($lp_settings['lokalizacje'],'U'.$_REQUEST['url_id'].':')===false) {
        $lp_settings['lokalizacje'].='U'.$_REQUEST['url_id'].':'.$_REQUEST['link_id'].';';
      }
      else {
        $locale=substr($lp_settings['lokalizacje'],strpos($lp_settings['lokalizacje'],'U'.$_REQUEST['url_id'].':'));
        $locale=str_replace('U'.$_REQUEST['url_id'].':','',substr($locale,0,strpos($locale,';')));
        $links=explode(',',$locale);
        if (!in_array($_REQUEST['link_id'],$links)) {
          $links[]=$_REQUEST['link_id'];
          $locale=substr($lp_settings['lokalizacje'],strpos($lp_settings['lokalizacje'],'U'.$_REQUEST['url_id'].':'));
          $locale=substr($locale,0,strpos($locale,';')+1);
          $lp_settings['lokalizacje']=str_replace($locale,'U'.$_REQUEST['url_id'].':'.implode(',',$links).';',$lp_settings['lokalizacje']);
        }
      }
      linkujpro_savesettings();
      $lp_settings['komunikat']='OK';
      break;
    case "newurl":
      linkujpro_getsettings();
      if (!(strpos($lp_settings['urle_nowe'],'<U>'.$_REQUEST['url'].'</U>'.$_REQUEST['m'])===false)) {
        $p=strpos($lp_settings['urle_nowe'],'<U>'.$_REQUEST['url'].'</U>');
        $q=strpos($lp_settings['urle_nowe'],'<U>',$p+1);
        if ($p>0) {
          if ($p==1) {
            if ($q>0) $lp_settings['urle_nowe']=substr($lp_settings['urle_nowe'],$q);
            else $lp_settings['urle_nowe']='';
          }
          else {
            if ($q>0) $lp_settings['urle_nowe']=substr($lp_settings['urle_nowe'],0,$p-1).substr($lp_settings['urle_nowe'],$q);
            else $lp_settings['urle_nowe']=substr($lp_settings['urle_nowe'],0,$p-1);
          }
        }
      }
      if (strpos($lp_settings['urle'],'<U>'.$_REQUEST['url'].'</U>'.$_REQUEST['m'].':'.$_REQUEST['uid'])===false) {
        $p=strpos($lp_settings['urle'],'<U>'.$_REQUEST['url'].'</U>');
        $q=strpos($lp_settings['urle'],'<U>',$p+1);
        if ($p>0) {
          if ($p==1) {
            if ($q>0) $lp_settings['urle']=substr($lp_settings['urle'],$q);
            else $lp_settings['urle']='';
          }
          else {
            if ($q>0) $lp_settings['urle']=substr($lp_settings['urle'],0,$p-1).substr($lp_settings['urle'],$q);
            else $lp_settings['urle']=substr($lp_settings['urle'],0,$p-1);
          }
        }
        $lp_settings['urle']=$lp_settings['urle'].'<U>'.urldecode($_REQUEST['url']).'</U>'.$_REQUEST['m'].':'.$_REQUEST['uid'];
        linkujpro_savesettings();
      }
      break;
    case "e_nu":
      linkujpro_getsettings();
      if ($lp_settings['urle_nowe']!='') {
        echo '<NU>'.$lp_settings['urle_nowe'].'</NU>';
        $lp_settings['urle_nowe_il']=0;
        $lp_settings['urle_nowe']='';
      }
      $lp_settings['request']=0;
      linkujpro_savesettings();
      break;
    case 'c_data':
      echo 'phpversion(): '.phpversion().":<br>\n";
      echo 'PHP_OS: '.PHP_OS.":<br>\n";
      echo 'php_sapi_name(): '.php_sapi_name().":<br>\n";
      echo '$_SERVER["GATEWAY_INTERFACE"]: '.($_SERVER['GATEWAY_INTERFACE']!=''?$_SERVER['GATEWAY_INTERFACE']:'Nie ustawione').":<br>\n";
      echo '$_SERVER["SERVER_SOFTWARE"]: '.($_SERVER['SERVER_SOFTWARE']!=''?$_SERVER['SERVER_SOFTWARE']:'Nie ustawione').":<br>\n";
      echo '$_SERVER["SERVER_SIGNATURE"]: '.($_SERVER['SERVER_SIGNATURE']!=''?$_SERVER['SERVER_SIGNATURE']:'Nie ustawione').":<br>\n";

      echo 'allow_url_fopen: '.(@ini_get('allow_url_fopen')?'On':'Off').":<br>\n";
      echo 'cURL: '.(function_exists('curl_init')?'Dostepny':'Niedostepny').":<br>\n";
      echo 'safe_mode: '.(ini_get('safe_mode')?'On':'Off').":<br>\n";
      echo 'safe_mode_gid: '.(ini_get('safe_mode_gid')?'On':'Off').":<br>\n";
      echo 'register_globals: '.(ini_get('register_globals')?'On':'Off').":<br>\n";

      $met=ini_get('max_execution_time');
      echo 'max_execution_time: '.ini_get('max_execution_time').":<br>\n";
      echo 'Zwiekszenie max_execution_time: ini_set(\'max_execution_time\')='.($met+10).":<br>\n";
      ini_set('max_execution_time',$met+10);
      echo 'max_execution_time po ini_set(): '.ini_get('max_execution_time').":<br>\n";

      $txt_path=linkujpro_getsettingpath();
      if (is_file($txt_path)) {
          echo 'Plik txt znaleziony: '.$txt_path.":<br/>\n";
          echo 'Uprawnienia do pliku: '.substr(sprintf('%o', fileperms($txt_path)), -4).":<br>\n";
          echo 'Odpowiedz na is_writable(): '.(is_writable($txt_path)?'TRUE':'FALSE').":<br>\n";
      }
      break;
  }
  echo $lp_settings['komunikat'];
  exit;
}
function show_links($ilosc_miejsc,$przed,$odstep,$po,$klasa) {
  if (!isset($_GET)) $_GET=$HTTP_GET_VARS;
  global $lp_settings;
  $lp_link='http://www.linkujpro.pl/get.php5?id=edda2fe55b6c58e2c4aa';

  if ($ilosc_miejsc>5) $ilosc_miejsc=5;
  if ($ilosc_miejsc<1) $ilosc_miejsc=1;
  $adres=$_SERVER['REQUEST_URI'];

  if (sizeof($_POST)) return;
  $denied=array('sid=','PHPSESSID=','SID=','phpsessid=','edda2fe55b6c58e2c4aa','//','/../','/./','#');
  foreach ($denied as $deny) {
    if (strpos($adres,$deny)===false) continue;
    else return;
  }
  linkujpro_getsettings();

  $linia='';
  $cnt=0;

  if ($lp_settings['urle']==''&&$lp_settings['urle_nowe']=='') {
    $lp_settings['urle_nowe']='<U>'.$adres.'</U>'.$ilosc_miejsc;
    $lp_settings['urle_nowe_il']=1;
  }
  else {
    if ($lp_settings['max_stron']>$lp_settings['urle_il']&&strpos($lp_settings['urle'],'<U>'.$adres.'</U>')===false) {
      if ($lp_settings['max_stron']>$lp_settings['urle_il']&&(strpos($lp_settings['urle_nowe'],'<U>'.$adres.'</U>')===false)) {
        $lp_settings['urle_nowe'].='<U>'.$adres.'</U>'.$ilosc_miejsc;
        $lp_settings['urle_nowe_il']++;
      }
    }
    else {
      $pos=strpos($lp_settings['urle'],'<U>'.$adres.'</U>')+strlen('<U>'.$adres.'</U>');
      $pos=strpos($lp_settings['urle'],':',$pos)+1;

      if (strpos($lp_settings['urle'],'<',$pos)!==false) $uid=substr($lp_settings['urle'],$pos,strpos($lp_settings['urle'],'<',$pos)-$pos);
      else $uid=substr($lp_settings['urle'],$pos);

      if (strpos($lp_settings['lokalizacje'],'U'.$uid.':')!==false) {
        $lstart=strpos($lp_settings['lokalizacje'],'U'.$uid.':')+strlen($uid)+2;
        $dlinks=substr($lp_settings['lokalizacje'],$lstart,strpos($lp_settings['lokalizacje'],';',$lstart)-$lstart);
        $dlsp=explode(',',$dlinks);
        $c=count($dlsp);
        $s=$c-$ilosc_miejsc;
        for ($i=$s; $i<$c; $i++) {
          if (strpos($lp_settings['linki'],'<L'.$dlsp[$i].'>')!==false) {
            $lstart=strpos($lp_settings['linki'],'<L'.$dlsp[$i].'>')+strlen($dlsp[$i])+3;
            if($cnt>0) $linia.=$odstep;
            else $linia.=$przed;

            $link=substr($lp_settings['linki'],$lstart,strpos($lp_settings['linki'],'</L>',$lstart)-$lstart);
            if ($klasa!='') $link=str_replace('">','" class="'.$klasa.'">',$link);
            $linia.=$link;
            $cnt++;
          }
        }
      }

    }
  }
  if ($lp_settings['test']==1) {
    $cnt=0;
    $linia=$adres.': '.$linia;
    if ($cnt==0) $linia=$przed.$linia;
    for ($i=$cnt+1; $i<=$ilosc_miejsc; $i++) {
      if ($i>1) $linia.=$odstep;
      $linia.='<a href="'.$adres.'#"';
      if (!$klasa=='') $linia.=' class="'.$klasa.'"';
      $linia.='>test'.$i.'</a>';
    }
    $cnt=$ilosc_miejsc;
  }
  if ($cnt>0) $linia.=$po;

  $lp_settings['urle_nowe_il']=(strlen($lp_settings['urle_nowe'])-strlen(str_replace('<U>','',$lp_settings['urle_nowe'])))/3;
  $from_last_contact=time()-$lp_settings['polaczenie'];
  
  if ((($lp_settings['urle_nowe_il']>9||($lp_settings['urle_nowe_il']>0&&$from_last_contact>900))&&!$lp_settings['request'])||$from_last_contact>86400) {
    if ($from_last_contact>300) {
      $lp_settings['polaczenie']=time();
      linkujpro_savesettings();
      linkujpro_request();
    }
    else linkujpro_savesettings();
  }
  else linkujpro_savesettings();
  return $linia;
}
?>