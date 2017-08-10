<?php
require_once 'bekrainsert.php';
	function myUpperInjection($str) {
		return mb_strtoupper(str_replace(array('ı', 'ğ', 'ü', 'ş', 'i', 'ö', 'ç'), array('I', 'Ğ', 'Ü', 'Ş', 'I', 'Ö', 'Ç'), $str), 'utf-8');
	}
	$inj = array (
		"SELECT ", "INSERT ", "DELETE ", "UPDATE ", 
		"DROP TABLE ", "UNION ", "NULL ", "ORDER BY ", 
		"GROUP_CONCAT ", "TABLE_NAME ", "INFORMATION_SCHEMA ", "TABLES ", 
		"TABLE_SCHEMA ", "COLUMN_NAME ", "CASE ", "WHEN ", 
		"THEN ", "PASS ", "MID ", "KILL ", "EXEC ", "SYS ", 
		"CREATE ", "SYSOBJECTS ", "SYSCOLUMS ", " OR ", " AND ",
		"ALTER ", "DECLARE ", "CAST ", "EXECUTE " , " FROM ","+"
	);
	
foreach ($_GET as $get_key=>$get_value) {
		//Sql cümlecikleri barındırıyor mu ?
		$ip_adresi = GetIP();
		$hackingtrh = new DateTime();
		$sayfaadi = $_SERVER["SCRIPT_FILENAME"];
		for ($j = 0; $j < sizeof ($inj); ++$j ) {
			if (preg_match("/".$inj[$j]."/", myUpperInjection($get_value))) {
               $bekrainsert = new bekrainsert(); 
               $bekrainsert->veri_ekle($ip_adresi,$get_key,$hackingtrh,$sayfaadi); 			   
			}
		}
	}
function GetIP(){
	if(getenv("HTTP_CLIENT_IP")) {
 		$ip = getenv("HTTP_CLIENT_IP");
 	} elseif(getenv("HTTP_X_FORWARDED_FOR")) {
 		$ip = getenv("HTTP_X_FORWARDED_FOR");
 		if (strstr($ip, ',')) {
 			$tmp = explode (',', $ip);
 			$ip = trim($tmp[0]);
 		}
 	} else {
 	$ip = getenv("REMOTE_ADDR");
 	}
	return $ip;
}
?>