<?
class user{
	var $logged						= 0;
	var $login_name;
	var $use_name;
	var $password;
	var $u_id						= -1;
	var $level						= 0;
	var $group_right				= 0;
	var $user_right_name_array;
	var $user_right_quantity_array;
	var $use_security;
	var $use_admin					= 0;
	var $use_city					=	0;
	var $use_address				= "";
	var $use_phone					= "";
	var $use_email					= "";
	var $use_avatar				= "";
	var $array_info_user			= array();
	var $useField					= array();
	var $use_address_received	= array();
	var $server_name				= ".hanoimobile.com.vn";
	/*
	init class
	login_name : ten truy cap
	password  : password (no hash)
	level: nhom user; 0: Normal; 1: Admin (default level = 0)
	*/
	function user($login_name="",$password=""){

		$checkcookie	= 0;
		$this->logged	= 0;
		if ($login_name == ""){
			if (isset($_COOKIE["login_name"])) $login_name = $_COOKIE["login_name"];
		}
		if ($password	== ""){
			if (isset($_COOKIE["PHPSESS1D"])) $password = $_COOKIE["PHPSESS1D"];
			$checkcookie	= 1;
		}
		else{
			//remove \' if gpc_magic_quote = on
			$password = str_replace("\'","'",$password);
		}

		if ($login_name == "" && $password == "") return;

		$sql_where	= " AND use_email = '" . $this->removequote($login_name) . "'";

		// Nếu có cookie lưu email thì chỉ dùng email để check đăng nhập
		if(isset($_COOKIE["login_email"]) && $_COOKIE["login_email"] != ""){
			$sql_where	= " AND use_email = '" . $this->removequote($_COOKIE["login_email"]) . "'";
		}

		$db_user = new db_query("SELECT *
										 FROM users
										 WHERE 1 " . $sql_where, __FILE__, "USE_SLAVE");

		if ($row=mysql_fetch_assoc($db_user->result)){
			//kiem tra password va use_active
			if($checkcookie == 0)	$password = md5($password . $row["use_security"]);
			if ($password == $row["use_password"] && $row["use_active"] == 1) {
				$this->logged				= 1;
				$this->login_name			= $login_name;
				$this->use_name			= $row["use_name"];
				$this->password			= $password;
				$this->use_security		= $row["use_security"];
				$this->u_id					= intval($row["use_id"]);
				$this->use_address		= $row["use_address"];
				$this->use_phone			= $row['use_phone'];
				$this->use_email			= $row['use_email'];
				$this->array_info_user	= $row; // Array chứa toàn bộ thông tin user
			}
		}
		unset($db_user);
	}

	/*
	save to cookie
	time : thoi gian save cookie, neu = 0 thi` save o cua so hien ha`nh
	*/
	function savecookie($time = 0){
		if ($this->logged!=1) return false;

		if ($time > 0){
			setcookie("login_email",$this->use_email,time()+$time,"/", $this->server_name,null,1);
			setcookie("login_name",$this->login_name,time()+$time,"/", $this->server_name,null,1);
			setcookie("PHPSESS1D",$this->password,time()+$time,"/", $this->server_name,null,1);

			setcookie("login_email",$this->use_email,time()+$time,"/","",null,1);
			setcookie("login_name",$this->login_name,time()+$time,"/","",null,1);
			setcookie("PHPSESS1D",$this->password,time()+$time,"/","",null,1);
		}
		else{

			//Set cookie cho domain bằng rỗng để chống lưu cookie save
			setcookie("login_email","",time()-365*24*60*60,"/",$this->server_name,null,1);
			setcookie("login_name","",time()-365*24*60*60,"/",$this->server_name,null,1);
			setcookie("PHPSESS1D","",time()-365*24*60*60,"/",$this->server_name,null,1);

			//Set temporary cookie
			setcookie("login_email",$this->use_email,null,"/",$this->server_name,null,1);
			setcookie("login_name",$this->login_name,null,"/",$this->server_name,null,1);
			setcookie("PHPSESS1D",$this->password,null,"/",$this->server_name,null,1);

			setcookie("login_email",$this->use_email,null,"/","",null,1);
			setcookie("login_name",$this->login_name,null,"/","",null,1);
			setcookie("PHPSESS1D",$this->password,null,"/","",null,1);

		}
	}

	/*
	Logout account
	*/
	function logout(){

		//Clear saved cookie (if time > 0)
		setcookie("login_email","",time()-365*24*60*60,"/",$this->server_name,null,1);
		setcookie("login_name","",time()-365*24*60*60,"/",$this->server_name,null,1);
		setcookie("PHPSESS1D","",time()-365*24*60*60,"/",$this->server_name,null,1);

		//Clear temporary cookie (if time==0)
		setcookie("login_email","",null,"/","",null,1);
		setcookie("login_name","",null,"/","",null,1);
		setcookie("PHPSESS1D","",null,"/","",null,1);

		$_COOKIE["login_email"]	= "";
		$_COOKIE["login_name"]	= "";
		$_COOKIE["PHPSESS1D"]	= "";

		$this->logged=0;

	}
	//kiem tra password de thay doi email
	function check_password($password){
		$db_user = new db_query("SELECT use_password,use_security
										 FROM users, user_group
										 WHERE use_group = group_id AND use_active=1 AND use_login = '" . $this->removequote($this->login_name) . "'");
		if ($row=mysql_fetch_array($db_user->result)){
			$password=md5($password . $row["use_security"]);
			if($password==$row["use_password"]) return 1;
		}
		unset($db_user);
	}

	function authen_code($record_id){
		$str = $this->password . $this->u_id . $record_id;
		return md5($str);
	}

	/*
	Remove quote
	*/
	function removequote($str){
		$temp = str_replace("\'","'",$str);
		$temp = str_replace("'","''",$temp);
		return $temp;
	}

	/*
	check_data : kiem tra xem data co phai thuoc user_id khong (check trong luc fetch_array)
	user_id : gia tri user id để so sánh
	*/
	function check_data($user_id){
		if ($this->logged!=1) return 0;
		if ($this->u_id != $user_id) return 0;
		return 1;
	}

	/*
	change password : Sau khi change password phải dùng hàm save cookie. Su dung trong truong hop Change Profile
	*/
	function change_password($old_password,$new_password){

		//replace quote if gpc_magic_quote = on
		$old_password = str_replace("\'","'",$old_password);
		$new_password = str_replace("\'","'",$new_password);

		//chua login -> fail
		if ($this->logged!=1) return 0;
		//old password ko đúng -> fail
		if (md5($old_password . $this->use_security)!=$this->password) return 0;

		//change password
		$db_update = new db_execute("UPDATE users
											 SET use_password = '" . md5($new_password . $this->use_security). "'
											 WHERE use_id = " . intval($this->u_id));
		//reset password
		$this->password = md5($new_password . $this->use_security);
		return 1;
	}

	function getArrayPasswordError(){
		$array_return	= array('cucre.vn', 'cucre123', '123456', '123456a', '123456b', '1234567', '12345678', '123456789', '123abc', 'test123', 'test1234', 'abc123', 'password', 'abcdef', 'matkhau');
		return $array_return;
	}

	/**
	 * FaceloginOpenID($emai, $name);
	 * Ham fake dang nhap cho nhung user khong tao tai khoan truc tiep tren cucre
	 * ma tao qua facebook hoac google
	 */
	function fakeloginopenid($email = '', $name = ''){
		$user_email		= htmlspecialbo($email);
		$user_name		= ($name != '')? htmlspecialbo($name) : $user_email;

		$pass				= md5('cropenid');

		// nếu email != '' thì thực hiện tiếp
		if($user_email != ''){

			/* Kiểm tra email + cucre có trong dữ liệu chưa
				nếu chưa có thì thêm vào
				nếu có rồi thì kiểm tra use_openid có == 1 hay không */

			$db_query	= new db_query("	SELECT * FROM users
													WHERE	use_login = 'cr_" . $user_email . "'",
													__FILE__ . " Line: " . __LINE__, "USE_SLAVE");
			// nếu tồn tại dữ liệu
			if($row		= mysql_fetch_assoc($db_query->result)){
				if($row['use_openid'] == 1){
					$this->logged		= 1;
					$this->use_name	= $user_name;
					$this->login_name	= 'cr_' . $user_email;
					$this->use_email	= $user_email;
					$this->password	= $pass;
					$this->savecookie(31536000);
					return 1;
				}

			}else{
				// nếu không tồn tại dữ liệu thì thêm dữ liệu mới vào
				$db_insert	= new db_execute("INSERT INTO users(use_login, use_password, use_name, use_email, use_active, use_openid, use_group)
														VALUES('cr_" . $user_email . "','". $pass ."','" . $user_name . "','cr_" . $user_email . "',1,1,1)");
				unset($db_insert);
				$this->logged		= 1;
				$this->use_name	= $user_name;
				$this->login_name	= 'cr_' . $user_email;
				$this->use_email	= $user_email;
				$this->password	= $pass;
				$this->savecookie(31536000);
				return 1;

			}

		}//end if user_email != ''
	}
	// end fakeloginopenid
}
?>