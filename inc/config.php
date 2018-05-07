<?php

header('content-type:text/html;charset=utf8');

session_start();

//veritabanı ve bağlantı değişkenleri
$server="localhost";
$database="blog";
$mysql_username="root";
$mysql_password="";


//bağlantı stringi oluşturma

$connection = @mysql_pconnect($server,$mysql_username,$mysql_password)
or die ("MySQL sunucuya bağlantı yapılamadı");

$db=mysql_select_db($database);
if(!$db){
	echo "veritabanı seçiminde hata var".mysql_errno();
}
mysql_set_charset('utf8',$connection);



?>