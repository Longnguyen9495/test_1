<?
//Chống include 2 function checkdomain và checkpostserver vào 1 file
if (!isset($array_domain)){
	$host = trim(str_replace("www.","",strtolower(@$_SERVER['SERVER_NAME'])));

	if ($host != "localhost" && $host != "admin.cucre.vn" && $host != "test.cucre.vn"){
		Header( "HTTP/1.1 301 Moved Permanently" );
		Header( "Location: http://admin.cucre.vn" . @$_SERVER['REQUEST_URI']);
		exit();
	}
}
?>