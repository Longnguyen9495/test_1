<?
/*
class response
*/
class Rest_Response_Digest{

	// Cần checksum data;
	var $need_checksum		= 1;

	 /*
	 check key
	 */

	var $rest_access_key_id = "";
	var $rest_payload			= "";
	var $rest_share_key		= "";


    /**
	 	The Digest opaque value (any string will do, never sent in plain text over the wire).
     */
    var $opaque = 'opaque';

    /**
	 	The authentication realm name.
     */
    var $realm = 'Ban hay nhap user name';

    /**
	 	The base URL of the application, auth data will be used for all resources under this URL.
     */
    var $baseURL = '/';


    /**
	 	key cua he thong de xac thuc
     */
    var $privateKey = 'privatekey';

    /**
	 	Thời gian timeout tính theo phút
     */
    var $nonceLife = 5;

	 var $method	 = "POST";

	 /*
	 Data header

	 */
	 var $arrayHeader = array();

	/*
	Khởi tạo class
	*/
	function Rest_Response_Digest($rest_access_key_id ,$rest_share_key){

		$this->rest_access_key_id 	= $rest_access_key_id;
		$this->rest_share_key 		= $rest_share_key;

	}

	/*
	hàm set header
	*/

	function Set_Header(){

		 $header = 'WWW-Authenticate: Digest realm="' . $this->realm . '",';
		 $header .= 'nonce="'. $this->getNonce() .'",';
		 $header .= 'qop="auth",';
		 $header .= 'uri="' . uniqid(time()) . '",';
		 $header .= 'domain="' . $this->baseURL . '",';
		 $header .= 'nc="' . time() . '",';
		 $header .= 'algorithm=MD5,';
		 $header .= 'opaque="' . $this->getOpaque() . '"';

		 header('HTTP/1.1 401 Unauthorized');
		 header($header);

		$arrReturn	= array(
			"error"	=> "Authentication failed",
			"code"	=> 0
		);
		die(json_encode($arrReturn));

	}

	/**
	Lấy HTTP Auth header
	*/
    function Get_Header()
    {
        if (isset($_SERVER['Authorization'])) {

            return $_SERVER['Authorization'];

		  } elseif (function_exists('apache_request_headers')) {

		      $headers = apache_request_headers();
            if (isset($headers['Authorization'])) {
                return $headers['Authorization'];
            }
		  }
        return NULL;
    }

	/*
	Hàm xác thực đăng nhập nếu thành công trả về username
	*/
	function Authenticate($return = 0){
			$users = array('admin'	=> 'vasfklewgyubgpay', 'giaonhan.net' => 'ahjfdlwghcldhsld', 'appmobile' => 'bjhbcashc2suwbnq', "vatgia" => "foaufosj@osj79sas");

			//$this->method = @$_SERVER['REQUEST_METHOD'];
			$header = $this->Get_Header();

			//nếu không tồn tại header
			if ($header == "") $this->Set_Header();

			$this->http_digest_parse($header);

			$username 			= $this->Get_Header_Val("username");
			$opaque 				= $this->Get_Header_Val("opaque");
			$uri		 			= $this->Get_Header_Val("uri");
			$nonce	 			= $this->Get_Header_Val("nonce");
			$response	 		= $this->Get_Header_Val("response");
			$qop	 				= $this->Get_Header_Val("qop");
			$nc		 			= $this->Get_Header_Val("nc");
			$cnonce	 			= $this->Get_Header_Val("cnonce");

			$requestURI = $_SERVER['REQUEST_URI'];
			if (strpos($requestURI, '?') !== FALSE) {

				$requestURI = substr($requestURI, 0, strlen($uri));
			}

			//kiểm tra bước 1 của các trường hợp
			if (
				  isset($users[$username])
				   && $opaque == $this->getOpaque()
				   && $uri == $requestURI
				   && $nonce == $this->getNonce()
			 ){
			 	//bắt đầu xử lý phần a1 a2 ---------------------------------------------------------------
				$passphrase = $users[$username];

				  $a1 = md5($username . ':' . $this->getRealm() . ':' . $passphrase);
				  $a2 = md5($this->method . ':' . $requestURI);

				  if(($qop != '') && ($nc != '') && ($cnonce != '')) {
						$expectedResponse = md5($a1 . ':' . $nonce . ':' . $nc . ':' . $cnonce . ':' . $qop . ':' . $a2);

				  } else {
						$expectedResponse = md5($a1 . ':' . $nonce . ':' . $a2);
				  }

					//nếu đăng nhập thành công
					if ($response == $expectedResponse) {
//khi dang nhap thanh cong authen thi xu ly o day ----------------------------------------------------------------------------------------------
						//dau tien la check sum da
						$this->rest_payload 			= getValue("data","str",$this->method,"");
						$this->rest_payload 			= str_replace('\"','"',$this->rest_payload);
						$this->rest_payload 			= str_replace("\'","'",$this->rest_payload);
						$this->rest_payload 			= str_replace('\\\\','\\',$this->rest_payload);

						// Nếu $return  = 1 thì tra ket qua luon không qua bước checksum
						if($return == 1) return $this->rest_payload;

						if($this->Checksum()){
							return $this->rest_payload;
						}else{
							//die( 'Data invalid');
							$arrReturn	= array(
								"error"	=> "Data invalid'",
								"code"	=> 0
							);
							die(json_encode($arrReturn));
						}
//khet thuc xu ly khi dang nhap thenh cong -----------------------------------------------------------------------------------------------------------
					}else{ //ngược lại yêu cầu đăng nhập tiếp

						$this->Set_Header();

					}

			  	//kết thúc xử lý a1 a2 --------------------------------------------------------------------

			 }else{	// nguoc lai yeu cau dang nhap tiep

			 	$this->Set_Header();

			 }
	}

	/*
	ham checksum tuong ung request len
	*/
	function Checksum(){
		// Nếu không cần checksum mà chỉ check authen thôi thì return luôn
		if($this->need_checksum	== 0) return true;

		$get_checksum			 		= getValue("checksum","str",$this->method,"");
		$rest_access_key_id	 		= getValue("accessKeyId","str",$this->method,"");

		//$my_checksum 				= hash("sha256", $_SERVER['REMOTE_ADDR'] . hash("sha256", $this->rest_payload) . $this->rest_share_key);
		$my_checksum					= md5($this->rest_payload . $this->rest_share_key);

		//neu check sum khong dung thi return false
		if($get_checksum != $my_checksum || $rest_access_key_id != $this->rest_access_key_id){

			return false;

		}else{

			return true;

		}
	}

	/*
	hàm lấy từng giá trị trong header
	*/

	function Get_Header_Val($key = ''){

			return isset($this->arrayHeader[$key]) ? $this->arrayHeader[$key] : '';

	}


	function http_digest_parse($txt)
	{
		 // protect against missing data
		 $needed_parts = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1,'domain'=>1,'opaque'=>1);
		 $data = array();
		 $keys = implode('|', array_keys($needed_parts));

		 preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);

		 foreach ($matches as $m) {
			  $data[$m[1]] = $m[3] ? $m[3] : $m[4];
			  unset($needed_parts[$m[1]]);
		 }

		 //gán data vào array header
		 $this->arrayHeader = $data;

		 //print_r($data);

		 return $needed_parts ? false : $data;
	}


	/*
	hàm tạo Nonce
	*/
    function getNonce() {

        $time = ceil(time() / $this->nonceLife) * $this->nonceLife;
		  //echo date('Y-m-d H:s', $time);
        return md5(date('Y-m-d H:i', $time) . ':' . $_SERVER['REMOTE_ADDR'] . ':' . $this->privateKey);

    }

	 /*
	 hàm lấy realm
	 */
    function getRealm()
    {
        if (ini_get('safe_mode')) {
            return $this->realm . '-' . getmyuid();
        } else {
            return $this->realm;
        }
    }

	 /*
	 hàm lấy opaque
	 */
    function getOpaque()
    {
        return md5($this->opaque);
    }



}

/*
$rest_access_key_id	= "";
$rest_share_key		= "fdsffdsfsddsadsfsd";

require_once("../../functions/functions.php");
$myRest = new Rest_Response_Digest($rest_access_key_id ,$rest_share_key);
echo $myRest->Authenticate();
*/
?>
