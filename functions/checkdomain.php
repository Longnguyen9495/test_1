<?
// Check domain để redirect cho đúng
$array_domain = arrayCucreDomain();

$host = trim(str_replace("www.","",strtolower(@$_SERVER['HTTP_HOST'])));
$port = intval($_SERVER['SERVER_PORT']);

// Nếu là admin.cucre.vn thì đẩy đến www.cucre.vn
if ($host == "admin.cucre.vn"){
	Header( "HTTP/1.1 301 Moved Permanently" );
	Header( "Location: http://www.cucre.vn" . @$_SERVER['REQUEST_URI']);
	exit();
}

// Nếu không phải domain của Cực Rẻ thì hiển thị box thông báo và link về www.cucre.vn
if(!in_array($host, $array_domain) || ($port != 80 && $port != 9000)){
	echo '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="robots" content="noindex, nofollow" />
		<title>Cucre.vn</title>
		<style type="text/css">
		*{
			font-family:Arial, Helvetica;
		}
		a{
			color:#003399;
			text-decoration:underline;
		}
		a:hover{
			color:#e97d13;
		}
		body{
			margin:0px;
			text-align:center;
		}
		div{
			background:#F2F2F2;
			border:1px #E2E2E2 solid;
			border-radius:0.5em 0.5em 0.5em 0.5em;
			-moz-border-radius:0.5em 0.5em 0.5em 0.5em;
			font-size:13px;
			line-height:22px;
			padding:30px;
			margin:100px auto;
			width:600px;
			text-align:center;
		}
		</style>
		</head>
		<body>
		<div>
			<b>Chào mừng các bạn đến với website Cucre.vn</b><br />
			Bạn <a href="http://www.cucre.vn/vn/">Click vào đây</a> để truy xuất vào <a href="http://www.cucre.vn/vn/">Cucre.vn</a>
		</div>
		</body>
		</html>
	';
	exit();
}
?>