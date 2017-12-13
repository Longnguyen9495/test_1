<?
function callback($buffer) {
   //replace all the apples with oranges
	$str		= array(chr(9),chr(10),chr(13));
	$buffer 	= str_replace($str, "", $buffer);//bo dau tab
	//Convert font sang unicode Composite
	$buffer	= convert_unicode_to_unicode_composite($buffer);
	return $buffer;
}

function array_currency(){
	$arrReturn	= array(0 => "USD", 1 => "EUR");
	return $arrReturn;
}

function removeQuote($string){
	$string = trim($string);
	$string = str_replace("\'", "'", $string);
	$string = str_replace("'", "''", $string);
	return $string;
}

function getStatic($iSta){
	$string = '';
	$db_static = new db_query("SELECT sta_description FROM statics_multi WHERE  sta_id = " . intval($iSta));
	if($row = mysql_fetch_assoc($db_static->result)){ 
		$string = $row["sta_description"];
	}
	unset($db_static);
	return $string;
}

function array_language(){
	$db_language	= new db_query("SELECT * FROM languages ORDER BY lang_id ASC");
	$arrReturn		= array();
	while($row = mysql_fetch_array($db_language->result)){
		$arrReturn[$row["lang_id"]] = array($row["lang_path"], $row["lang_name"]);
	}
	return $arrReturn;
}

function array_length_of_stay_tour(){
	$arrReturn	= array (1 => "1 " . tdt("day"),
								2 => "2 - 5 " . tdt("days"),
								3 => "6 - 9 " . tdt("days"),
								4 => "10 - 16 " . tdt("days"),
								5 => "17 " . tdt("and_more_days"),
								);
	return $arrReturn;
}

function array_star_rating_hotel(){
	$arrReturn	= array (2 => "2 " . tdt("stars"),
								3 => "3 " . tdt("stars"),
								4 => "4 " . tdt("stars"),
								5 => "5 " . tdt("stars"),
								);
	return $arrReturn;
}

function array_service(){
	$arrReturn	= array (1 => tdt("Air_ticket"),
								2 => tdt("Train_ticket"),
								3 => tdt("Visa"),
								4 => tdt("Car_for_rent"),
								);
	return $arrReturn;
}

function check_email_address($email) {
	//First, we check that there's one @ symbol, and that the lengths are right
	if(!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)){
		//Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
		return false;
	}
	//Split it into sections to make life easier
	$email_array = explode("@", $email);
	$local_array = explode(".", $email_array[0]);
	for($i = 0; $i < sizeof($local_array); $i++){
		if(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])){
			return false;
		}
	}
	if(!ereg("^\[?[0-9\.]+\]?$", $email_array[1])){
	//Check if domain is IP. If not, it should be valid domain name
		$domain_array = explode(".", $email_array[1]);
		if(sizeof($domain_array) < 2){
			return false; // Not enough parts to domain
		}
		for($i = 0; $i < sizeof($domain_array); $i++){
			if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])){
				return false;
			}
		}
	}
	return true;
}

function check_session_security($security_code){
	$return = 1;
	if(!isset($_SESSION["session_security_code"])) $_SESSION["session_security_code"] = generate_security_code();
	if($security_code != $_SESSION["session_security_code"]){
		$return = 0;
	}
	// Reset lại session security code
	$_SESSION["session_security_code"] = generate_security_code();
	return $return;
}

function count_online(){
	$visited_timeout		= 10 * 60;
	$last_visited_time	= time();
	//Kiem tra co session_id hay ko, neu co
	if(session_id() != ""){
		$db_exec	= new db_execute("REPLACE INTO active_users(au_session_id, au_last_visit) VALUES('" . session_id() . "', " . $last_visited_time . ")");
		unset($db_exec);
	}
	// Delete timeout
	$db_exec	= new db_execute("DELETE FROM active_users WHERE au_last_visit < " . ($last_visited_time - $visited_timeout));
	unset($db_exec);
	// Select Count
	$db_count= new db_query("SELECT count(*) AS count FROM active_users");
	$row		= mysql_fetch_array($db_count->result);
	unset($db_count);
	// Return value
	return $row["count"];
}

function count_visited(){
	$db_count	= new db_query("SELECT vis_counter FROM visited");
	$row = mysql_fetch_array($db_count->result);
	unset($db_count);
	return $row["vis_counter"];
}

function cut_string($str, $length, $char=" ..."){
	//Nếu chuỗi cần cắt nhỏ hơn $length thì return luôn
	$strlen	= mb_strlen($str, "UTF-8");
	if($strlen <= $length) return $str;
	
	//Cắt chiều dài chuỗi $str tới đoạn cần lấy
	$substr	= mb_substr($str, 0, $length, "UTF-8");
	if(mb_substr($str, $length, 1, "UTF-8") == " ") return $substr . $char;
	
	//Xác định dấu " " cuối cùng trong chuỗi $substr vừa cắt
	$strPoint= mb_strrpos($substr, " ", "UTF-8");
	
	//Return string
	if($strPoint < $length - 20) return $substr . $char;
	else return mb_substr($substr, 0, $strPoint, "UTF-8") . $char;
}

function format_number($number, $edit=0){
	if($number > 1000) $number = round($number/1000)*1000;
	if($edit == 0){
		$return	= number_format($number, 2, ".", ",");
		if(intval(substr($return, -2, 2)) == 0) $return = number_format($number, 0, ".", ",");
		elseif(intval(substr($return, -1, 1)) == 0) $return = number_format($number, 1, ".", ",");
		return $return;
	}
	else{
		$return	= number_format($number, 2, ".", "");
		if(intval(substr($return, -2, 2)) == 0) $return = number_format($number, 0, ".", "");
		return $return;
	}
}

function generate_array_variable($variable){
	$list			= tdt($variable);
	$arrTemp		= explode("{-break-}", $list);
	$arrReturn	= array();
	for($i=0; $i<count($arrTemp); $i++) $arrReturn[$i] = trim($arrTemp[$i]);
	return $arrReturn;
}

function generate_security_code(){
	$code	= rand(1000, 9999);
	return $code;
}

function generate_sort($type, $sort, $current_sort, $image_path){
	if($type == "asc"){
		$title = tdt("Tang_dan");
		if($sort != $current_sort) $image_sort = "sortasc.gif";
		else $image_sort = "sortasc_selected.gif";
	}
	else{
		$title = tdt("Giam_dan");
		if($sort != $current_sort) $image_sort = "sortdesc.gif";
		else $image_sort = "sortdesc_selected.gif";
	}
	return '<a title="' . $title . '" href="' . getURL(0,0,1,1,"sort") . '&sort=' . $sort . '"><img border="0" src="' . $image_path . $image_sort . '" style="margin-top:3px" /></a>';
}

function generate_sql_length_of_stay_tour($key){
	$arrSQL	= array (1 => " AND tou_length = 1 ",
							2 => " AND tou_length >= 2 AND tou_length <= 5 ",
							3 => " AND tou_length >= 6 AND tou_length <= 9 ",
							4 => " AND tou_length >= 10 AND tou_length <= 16 ",
							5 => " AND tou_length >= 17 ",
							);
	if(isset($arrSQL[$key])) return $arrSQL[$key];
	else return "";
}

function generate_title_url_tour($arrCou, $arrTs, $nData, $nTab){
	global $lang_path;
	$strReturn	= '<a href="' . generate_module_url("Search_tour") . ';country=' . $arrCou[0] . '">' . $arrCou[1] . '</a> &raquo; ';
	$strReturn .= '<a href="' . generate_module_url("Search_tour") . ';country=' . $arrCou[0] . '&travel_style=' . $arrTs[0] . '">' . $arrTs[1] . '</a> &raquo; ';
	$strReturn .= '<a href="' . generate_detail_tour_url($arrCou[1], $arrTs[1], $nData) . '">' . $nData . '</a> &raquo; ';
	$strReturn .= '<span>' . $nTab . '</span>';
	return $strReturn;
}

function generate_title_url_hotel($arrCou, $arrCity, $nData, $nTab){
	global $lang_path;
	$strReturn	= '<a href="' . generate_module_url("Search_hotel") . ';country=' . $arrCou[0] . '">' . $arrCou[1] . '</a> &raquo; ';
	$strReturn .= '<a href="' . generate_module_url("Search_hotel") . ';country=' . $arrCou[0] . '&city=' . $arrCity[0] . '">' . $arrCity[1] . '</a> &raquo; ';
	$strReturn .= '<a href="' . generate_detail_hotel_url($arrCou[1], $arrCity[1], $nData) . '">' . $nData . '</a> &raquo; ';
	$strReturn .= '<span>' . $nTab . '</span>';
	return $strReturn;
}

function getURL($serverName=0, $scriptName=0, $fileName=1, $queryString=1, $varDenied=''){
	$url	 = '';
	$slash = '/';
	if($scriptName != 0)$slash	= "";
	if($serverName != 0){
		if(isset($_SERVER['SERVER_NAME'])){
			$url .= 'http://' . $_SERVER['SERVER_NAME'];
			if(isset($_SERVER['SERVER_PORT'])) $url .= ":" . $_SERVER['SERVER_PORT'];
			$url .= $slash;
		}
	}
	if($scriptName != 0){
		if(isset($_SERVER['SCRIPT_NAME']))	$url .= substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/') + 1);
	}
	if($fileName	!= 0){
		if(isset($_SERVER['SCRIPT_NAME']))	$url .= substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], '/') + 1);
	}
	if($queryString!= 0){
		$url .= '?';
		reset($_GET);
		$i = 0;
		if($varDenied != ''){
			$arrVarDenied = explode('|', $varDenied);
			while(list($k, $v) = each($_GET)){
				if(array_search($k, $arrVarDenied) === false){
					$i++;
					if($i > 1) $url .= '&' . $k . '=' . @urlencode($v);
					else $url .= $k . '=' . @urlencode($v);
				}
			}
		}
		else{
			while(list($k, $v) = each($_GET)){
				$i++;
				if($i > 1) $url .= '&' . $k . '=' . @urlencode($v);
				else $url .= $k . '=' . @urlencode($v);
			}
		}
	}
	$url = str_replace('"', '&quot;', strval($url));
	return $url;
}

function curPageURL() {
	$pageURL = 'http';
	if (@$_SERVER["HTTPS"] == "on"){
		$pageURL .= "s";
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

function getValue($value_name, $data_type = "int", $method = "GET", $default_value = 0, $advance = 0){
	$value = $default_value;
	switch($method){
		case "GET": if(isset($_GET[$value_name])) $value = $_GET[$value_name]; break;
		case "POST": if(isset($_POST[$value_name])) $value = $_POST[$value_name]; break;
		case "COOKIE": if(isset($_COOKIE[$value_name])) $value = $_COOKIE[$value_name]; break;
		case "SESSION": if(isset($_SESSION[$value_name])) $value = $_SESSION[$value_name]; break;
		default: if(isset($_GET[$value_name])) $value = $_GET[$value_name]; break;
	}
	$valueArray	= array("int" => intval($value), "str" => trim(strval($value)), "flo" => floatval($value), "dbl" => doubleval($value), "arr" => $value);
	foreach($valueArray as $key => $returnValue){
		if($data_type == $key){
			if($advance != 0){
				switch($advance){
					case 1:
						$returnValue = replaceMQ($returnValue);
						break;
					case 2:
						$returnValue = htmlspecialbo($returnValue);
						break;
				}
			}
			//Do số quá lớn nên phải kiểm tra trước khi trả về giá trị
			if((strval($returnValue) == "INF") && ($data_type != "str")) return 0;
			return $returnValue;
			break;
		}
	}
	return (intval($value));
}

function get_server_name(){
	$server = $_SERVER['SERVER_NAME'];
	if(strpos($server, "asiaqueentour.com") !== false) return "http://www.asiaqueentour.com";
	else return "http://" . $server . ":" . $_SERVER['SERVER_PORT'];
}

function htmlspecialbo($str){
	$arrDenied	= array('<', '>', '\"', '"');
	$arrReplace	= array('&lt;', '&gt;', '&quot;', '&quot;');
	$str = str_replace($arrDenied, $arrReplace, $str);
	return $str;
}

function javascript_writer($str){
	$mytextencode = "";
	for ($i=0;$i<strlen($str);$i++){
		$mytextencode .= ord(substr($str,$i,1)) . ",";
	}
	if ($mytextencode!="") $mytextencode .= "32";
	return "<script language='javascript'>document.write(String.fromCharCode(" . $mytextencode . "));</script>";
}

function lang_path(){
	global $lang_id;
	global $array_lang;
	global $con_root_path;
	$default_lang = 1;
	$path	= ($lang_id == $default_lang) ? $con_root_path : $con_root_path . $array_lang[$lang_id][0] . "/";
	return $path;
}

function microtime_float(){
   list($usec, $sec) = explode(" ", microtime());
   return ((float)$usec + (float)$sec);
}

function random(){
	$rand_value = "";
	$rand_value.= rand(1000,9999);
	$rand_value.= chr(rand(65,90));
	$rand_value.= rand(1000,9999);
	$rand_value.= chr(rand(97,122));
	$rand_value.= rand(1000,9999);
	$rand_value.= chr(rand(97,122));
	$rand_value.= rand(1000,9999);
	return $rand_value;
}

function redirect($url){
	$url	= htmlspecialbo($url);
	echo '<script type="text/javascript">window.location.href = "' . $url . '";</script>';
	exit();
}

function removeAccent($mystring){
	$marTViet=array(
		// Chữ thường
		"à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ",
		"è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ",
		"ì","í","ị","ỉ","ĩ",
		"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ",
		"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
		"ỳ","ý","ỵ","ỷ","ỹ",
		"đ","Đ","'",
		// Chữ hoa
		"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ",
		"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
		"Ì","Í","Ị","Ỉ","Ĩ",
		"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
		"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
		"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
		"Đ","Đ","'"
		);
	$marKoDau=array(
		/// Chữ thường
		"a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a",
		"e","e","e","e","e","e","e","e","e","e","e",
		"i","i","i","i","i",
		"o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o",
		"u","u","u","u","u","u","u","u","u","u","u",
		"y","y","y","y","y",
		"d","D","",
		//Chữ hoa
		"A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A",
		"E","E","E","E","E","E","E","E","E","E","E",
		"I","I","I","I","I",
		"O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O",
		"U","U","U","U","U","U","U","U","U","U","U",
		"Y","Y","Y","Y","Y",
		"D","D","",
		);
	return str_replace($marTViet, $marKoDau, $mystring);
}

function removeHTML($string){
	$string = preg_replace ('/<script.*?\>.*?<\/script>/si', ' ', $string); 
	$string = preg_replace ('/<style.*?\>.*?<\/style>/si', ' ', $string); 
	$string = preg_replace ('/<.*?\>/si', ' ', $string); 
	$string = str_replace ('&nbsp;', ' ', $string);
	return $string;
}

function removeLink($string){
	$string = preg_replace ('/<a.*?\>/si', '', $string);
	$string = preg_replace ('/<\/a>/si', '', $string);
	return $string;
}

function replaceFCK($string, $type=0){
	$array_fck	= array ("&Agrave;", "&Aacute;", "&Acirc;", "&Atilde;", "&Egrave;", "&Eacute;", "&Ecirc;", "&Igrave;", "&Iacute;", "&Icirc;",
								"&Iuml;", "&ETH;", "&Ograve;", "&Oacute;", "&Ocirc;", "&Otilde;", "&Ugrave;", "&Uacute;", "&Yacute;", "&agrave;",
								"&aacute;", "&acirc;", "&atilde;", "&egrave;", "&eacute;", "&ecirc;", "&igrave;", "&iacute;", "&ograve;", "&oacute;",
								"&ocirc;", "&otilde;", "&ugrave;", "&uacute;", "&ucirc;", "&yacute;",
								);
	$array_text	= array ("À", "Á", "Â", "Ã", "È", "É", "Ê", "Ì", "Í", "Î",
								"Ï", "Ð", "Ò", "Ó", "Ô", "Õ", "Ù", "Ú", "Ý", "à",
								"á", "â", "ã", "è", "é", "ê", "ì", "í", "ò", "ó",
								"ô", "õ", "ù", "ú", "û", "ý",
								);
	if($type == 1) $string = str_replace($array_fck, $array_text, $string);
	else $string = str_replace($array_text, $array_fck, $string);
	return $string;
}

function replaceJS($text){
	$arr_str = array("\'", "'", '"', "&#39", "&#39;", chr(10), chr(13), "\n");
	$arr_rep = array(" ", " ", '&quot;', " ", " ", " ", " ");
	$text		= str_replace($arr_str, $arr_rep, $text);
	$text		= str_replace("    ", " ", $text);
	$text		= str_replace("   ", " ", $text);
	$text		= str_replace("  ", " ", $text);
	return $text;
}

function replace_keyword_search($keyword, $lower=1){
	if($lower == 1) $keyword	= mb_strtolower($keyword, "UTF-8");
	$keyword	= replaceMQ($keyword);
	$arrRep	= array("'", '"', "-", "+", "=", "*", "?", "/", "!", "~", "#", "@", "%", "$", "^", "&", "(", ")", ";", ":", "\\", ".", ",", "[", "]", "{", "}", "‘", "’", '“', '”');
	$keyword	= str_replace($arrRep, " ", $keyword);
	$keyword	= str_replace("  ", " ", $keyword);
	$keyword	= str_replace("  ", " ", $keyword);
	return $keyword;
}

function replaceMQ($text){
	$text	= str_replace("\'", "'", $text);
	$text	= str_replace("'", "''", $text);
	return $text;
}

function remove_magic_quote($str){
	$str = str_replace("\'", "'", $str);
	$str = str_replace("\&quot;", "&quot;", $str);
	$str = str_replace("\\\\", "\\", $str);
	return $str;
}

function tdt($variable){
	global $lang_display;
	if (isset($lang_display[$variable])){
		if (trim($lang_display[$variable]) == ""){
			return "#" . $variable . "#";
		}
		else{
			$arrStr	= array("\\\\'", '\"');
			$arrRep	= array("\\'", '"');
			return str_replace($arrStr, $arrRep, $lang_display[$variable]);
		}
	}
	else{
		return "_@" . $variable . "@_";
	}
}

function generate_detail_phagia_url($id, $iGroup){
	return "detailrw.php?module=phagia&record_id=" . $id . "&iGroup=" . $iGroup;
}

function checkBusiness($user_id){
	$check_business = 0;
	$db_business = new db_query("SELECT bus_user_id FROM business WHERE bus_user_id = " . $user_id);
	if(mysql_numrows($db_business->result) > 0) $check_business = 1;
	unset($db_business);
	
	return $check_business;
}

function removeExcessSpace($string){
	$string = preg_replace ("/(\\s|&nbsp;){2,}/si", ' ', $string); 
	$string = trim($string); 
	return $string;
}

//Convert Unicode -> Unicode Composite
function convert_unicode_to_unicode_composite($input_str){

	$array_unicode	= array(
	"à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ",
	"è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ",
	"ì","í","ị","ỉ","ĩ",
	"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ",
	"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
	"ỳ","ý","ỵ","ỷ","ỹ",
	"đ",
	"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ",
	"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
	"Ì","Í","Ị","Ỉ","Ĩ",
	"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
	"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
	"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
	"Đ");

	$array_unicode_composite = array(
	"à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ",
	"è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ",
	"ì","í","ị","ỉ","ĩ",
	"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ",
	"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
	"ỳ","ý","ỵ","ỷ","ỹ",
	"đ",
	"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ",
	"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
	"Ì","Í","Ị","Ỉ","Ĩ",
	"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
	"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
	"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
	"Đ");
	
	return str_replace($array_unicode, $array_unicode_composite, $input_str);
}

function removeCharPhoneNumber($string){

	$length		= mb_strlen($string, "UTF-8");
	
	$start_char	= 0;
	//Remove các ký tự ko phải số ở đầu
	for($i=0; $i<$length; $i++){
		$char	= mb_substr($string, $i, 1, "UTF-8");
		if(($char == "(") || (is_numeric($char))) break;
		$start_char	= $i+1;
	}
	
	$end_char	= $length;
	//Remove các ký tự ko phải số ở cuối
	for($i=$length; $i>=0; $i--){
		$char	= mb_substr($string, $i-1, 1, "UTF-8");
		if(is_numeric($char)) break;
		$end_char	= $i-1;
	}
	//Cắt chuỗi
	$string		= mb_substr($string, $start_char, ($end_char - $start_char), "UTF-8");
	
	return $string;
	
}

function splitPhoneNumber($string){
	
	$str_tmp = str_replace(array(" - ", " . "), " / ", $string);
	$str_tmp = preg_replace('/\s/', '', $str_tmp);

	$pattern	= '/(\d{6,}(?!\d)|(?<!\d)\d{6,}|(\(|\d|\.|-|,|\)){6,})/';
	
	preg_match_all($pattern, $str_tmp, $match);
	//print_r($match[0]);
	
	$result	= array();// Mang luu lai ket qua tra ve
	foreach($match[0] as $key => $value){
		$result[$key]["socu"]	= removeCharPhoneNumber($value);
		$result[$key]["somoi"]	= preg_replace('/\D/', '', $value);
	}
	
	return $result;
	
}
?>
