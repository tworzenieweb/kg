<?php
function polish_date($format=1) {

$timestamp = time();

$day_of_month = Date("j",$timestamp);
$day_of_week  = Date("w",$timestamp);
$year         = Date("Y",$timestamp);
$month        = Date("n",$timestamp);

$month_name = array(
 1=>'stycznia',
 2=>'lutego',
 3=>'marca',
 4=>'kwietnia',
 5=>'maja',
 6=>'czerwca',
 7=>'lipca',
 8=>'sierpnia',
 9=>'wrze&#347;nia',
10=>'pa&#378;dziernika',
11=>'listopada',
12=>'grudnia');

$day_name = array(
0=>'niedziela',
1=>'poniedzia&#322;ek',
2=>'wtorek',
3=>'&#347;roda',
4=>'czwartek',
5=>'pi&#261;tek',
6=>'sobota');

switch($format) {
	case 1  : return "$day_name[$day_of_week], $day_of_month $month_name[$month] $year"; break;
	case 2  : return date("d-m-Y | G:i:s",$timestamp); break;
	case 3  : return date("d-m-Y",$timestamp); break;
	default : return date("d-m-Y",$timestamp); break;
	}
}
?>