<?
require_once("session.php");

$lang_id	= 1;
require_once("../functions/translate.php");
require_once("../functions/functions.php");
require_once("../classes/database.php");
require_once("resource/security/functions.php");

$username	= getValue("username", "str", "POST", "", 1);
$password	= getValue("password", "str", "POST", "", 1);
$action		= getValue("action", "str", "POST", "");

//Kiem tra xem ip nay co duoc phep vao admin hay khong
$ip					= $_SERVER['REMOTE_ADDR'];
$check_ip_exists	= 1;
if(file_exists("ipstore/" . ip2long($ip) . ".cfn")){
	$check_ip_exists	= 1;
}

if($action == "login" && $check_ip_exists == 1){
	$user_id	= 0;
	$user_id = checkLogin($username, $password);
	if($user_id != 0){
		$isAdmin		= 0;
		$db_isadmin	= new db_query("SELECT adm_isadmin, lang_id FROM admin_user WHERE adm_id = " . $user_id);
		$row			= mysql_fetch_array($db_isadmin->result);
		if($row["adm_isadmin"] != 0) $isAdmin = 1;
		//Set SESSION
		$_SESSION["Logged"]			= 1;
		$_SESSION["logged"]			= 1;
		$_SESSION["user_id"]			= $user_id;
		$_SESSION["userlogin"]		= $username;
		$_SESSION["password"]		= md5($password);
		$_SESSION["isAdmin"]			= $isAdmin;
		$_SESSION["lang_id"]			= $row["lang_id"];
		$_SESSION["lang_id"] 		= get_curent_language();
		$_SESSION["lang_path"] 		= get_curent_path();
		unset($db_isadmin);
	}
}

//Check logged
$logged = getValue("logged", "int", "SESSION", 0);
$db_language			= new db_query("SELECT tra_text,tra_keyword FROM admin_translate");
$langAdmin 				= array();
while($row=mysql_fetch_assoc($db_language->result)){
	$langAdmin[$row["tra_keyword"]] = $row["tra_text"];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
if($logged == 1){
?>
	<script language="javascript">
   	window.parent.location.href="index.php";
   </script>
<?
}
?>
<title><?=translate_text("Management website")?></title>
<link rel="stylesheet" type="text/css" href="resource/css/layout.css">
<link rel="stylesheet" type="text/css" href="resource/css/bootstrap/css/bootstrap.css">
</head>
<body>
	<div class="loginBox">
     <div class="loginHead">Administrator</div>
     <div class="loginContent">
			<form action="<?=$_SERVER['REQUEST_URI']?>" method="post" role="form">
				<input name="action" type="hidden" value="login">
				<div class="form-group">
				<label for="exampleInputEmail1">User name</label>
				<input type="text" class="form-control input-sm" id="username" name="username" placeholder="Enter username">
				</div>
				<div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input type="password" class="form-control input-sm" id="password" name="password" placeholder="Password">
				</div>
				<div class="form-actions">
				<button type="submit" class="btn btn-primary btn-block active">Sign in</button>
				</div>
			</form>
      </div>
   </div>
</body>
</html>
