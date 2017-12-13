<?
class history{
	
	var $ff					= "hg_";					// Tiền tố field trong bảng history
	var $key					= "hg_guest_id";		// Khóa chính trong bảng history
	var $user_id			= 0;
	var $security_code	= "Ldm20X8w6";
	var $limit_guest		= 30;
	var $limit_user		= 50;
	var $max_table			= 19;
	var $array_category	= array ("product"=> array());
	var $crHH				= "";
	
	/**
	Function khởi tạo
	*/
	function history($user_id=0){
		
		$this->user_id	= $user_id;
		
		if($this->user_id > 0){
			$this->ff	= "hu_";
			$this->key	= "hu_user_id";
		}
		
		// Lấy uniqid từ COOKIE
		$crHH				= getValue("crHH", "str", "COOKIE", "");
		$crHH				= trim(preg_replace("/[^a-z0-9]/U", "", $crHH));
		$this->crHH		= $crHH;
		
	}
	
	/**
	Function generate
	*/
	function generate($use_id, $cat_id, $data_id, $keyword, $type="product"){
		
		$hash			= $this->hash($use_id, $cat_id, $data_id, $keyword, $type);
		$strReturn	= $use_id . "|" . $cat_id . "|" . $data_id . "|" . $keyword . "|" . $type . "|" . $hash;
		$strReturn	= base64_encode($strReturn);
		
		return $strReturn;
		
	}
	
	/**
	Function mã hóa data để checksum
	*/
	function hash($use_id, $cat_id, $data_id, $keyword, $type){
		
		return md5($use_id . $cat_id . $data_id . $keyword . $type . $this->security_code);
		
	}
	
	/**
	Function get table
	*/
	function get_table(){
		
		if($this->user_id > 0) $fs_table	= "history_user_" . ($this->user_id % ($this->max_table + 1));
		else $fs_table	= "history_guest_" . intval(substr($this->crHH, 0, 2));
		
		return $fs_table;
		
	}
	
	/**
	Function get sql: Tạo ra truy vấn để lọc trong bảng history cho đúng (Nếu là guest thì theo dạng text, user đăng nhập thì dạng int)
	*/
	function get_sql(){
		
		if($this->user_id > 0) $sqlWhere	= " hu_user_id = " . $this->user_id . " ";
		else $sqlWhere	= " hg_guest_id = '" . replaceMQ($this->crHH) . "' ";
		
		return $sqlWhere;
		
	}
	
	/**
	Function get cookie
	*/
	function check_cookie(){
		
		// Mặc định cho $return = 1
		$return		= 1;
		
		// Nếu user đã đăng nhập thì return 1 luôn
		if($this->user_id > 0) return $return;
		
		// Check xem cookie có hợp lệ hay ko
		if($this->crHH == "" || strlen($this->crHH) != 24) $return = 0;
		
		// Check xem table có tồn tại hay ko
		$temp			= intval(substr($this->crHH, 0, 2));
		if($temp < 0 || $temp > $this->max_table) $return = 0;
		
		return $return;
		
	}
	
	/**
	Function save data vào database ($data = "a|b|c|d|e|f")
	a: user_id, b: cat_id, c: pro_id, d: keyword, e: type, f: hash
	*/
	function save($data){
		
		// Kiểm tra xem có create cookie mới hay ko
		$create		= ($this->check_cookie() == 1 ? 0 : 1);
		
		// Nếu chưa có uniqid hoặc uniqid ko hợp lệ thì tạo mới
		if($create == 1){
			
			$rand		= rand(0, $this->max_table);
			if($rand < 10) $rand = 0 . $rand;
			// Gán lại biến cookie global
			$this->crHH			= $rand . str_replace(".", "", uniqid("", true));
			
			// Save cookie
			$server_name 		= ".cucre.vn";
			$time					= 90 * 86400;
			setcookie("crHH",$this->crHH,time()+$time,"/",$server_name,null,1);
			setcookie("crHH",$this->crHH,time()+$time,"/","",null,1);
			
		}// End if($create == 1)
		
		$arrHistory	= array ("category"	=> "",
									"data"		=> "",
									"keyword"	=> "",
									);
		
		// Get table
		$fs_table	= $this->get_table();
		
		// Check trong database (db_logs)
		$db_history	= new db_query("SELECT *
											 FROM " . $fs_table . "
											 WHERE " . $this->get_sql(),
											 __FILE__, "", 1);
		// Check xem update hay là insert
		$update	= (($row = mysql_fetch_assoc($db_history->result)) ? 1 : 0);
		$db_history->close();
		unset($db_history);
		
		// Bẻ $data ra array
		$data		= base64_decode($data);
		$arrTemp	= explode("|", $data);
		
		// Nếu array hợp lệ (Đủ số phần tử quy định) thì mới thực hiện
		if(count($arrTemp) == 6){
			
			$cat_id	= intval($arrTemp[1]);
			$data_id	= intval($arrTemp[2]);
			$keyword	= trim(str_replace(array("[", "]"), array("", ""), $arrTemp[3]));
			$type		= $arrTemp[4];
			
			// Check category
			$db_category	= new db_query("SELECT cat_id
													 FROM categories_multi
													 WHERE cat_active = 1 AND cat_type = 'phagia' AND cat_id = " . $cat_id,
													 __FILE__, "USE_SLAVE");
			if($rowTemp = mysql_fetch_assoc($db_category->result)) $cat_id	= $rowTemp["cat_id"];
			else $cat_id = 0;
			$db_category->close();
			unset($db_category);
			
			// Mã hóa để checksum
			$hash		= $this->hash($arrTemp[0], $arrTemp[1], $arrTemp[2], $arrTemp[3], $arrTemp[4]);
			
			// Check hash xem có đúng hay ko
			if($hash == $arrTemp[5]){
				
				$arrField		= array("category" => $this->ff . "category_product", "data" => $this->ff . "product", "keyword" => $this->ff . "keyword_product");
				
				// Nếu là update thì gán luôn dữ liệu mặc định trong database
				if($update == 1){
					$arrHistory	= array ("category"	=> $row[$arrField["category"]],
												"data"		=> $row[$arrField["data"]],
												"keyword"	=> $row[$arrField["keyword"]],
												);
				}
				
				if($cat_id > 0) $arrHistory["category"]	= $this->add($cat_id, $arrHistory["category"]);
				if($data_id > 0) $arrHistory["data"]		= $this->add($data_id, $arrHistory["data"]);
				if($keyword != "") $arrHistory["keyword"]	= $this->add($keyword, $arrHistory["keyword"]);
				
				// Lưu vào database
				$queryStr	= "INSERT IGNORE INTO " . $fs_table . " (" . $this->key . ", " . $arrField["category"] . ", " . $arrField["data"] . ", " . $arrField["keyword"] . ", " . $this->ff . "last_update)
									VALUES(" . ($this->user_id > 0 ? $this->user_id : "'" . replaceMQ($this->crHH) . "'") . ",
											 '" . replaceMQ($arrHistory["category"]) . "',
											 '" . replaceMQ($arrHistory["data"]) . "',
											 '" . replaceMQ($arrHistory["keyword"]) . "',
											 " . time() . "
											 )";
				// Nếu là update thì check xem field nào thay đổi data mới update
				if($update == 1){
					
					$sqlSet		= "";
					if($row[$arrField["category"]] != $arrHistory["category"])	$sqlSet .= $arrField["category"] . " = '" . replaceMQ($arrHistory["category"]) . "', ";
					if($row[$arrField["data"]] != $arrHistory["data"])				$sqlSet .= $arrField["data"] . " = '" . replaceMQ($arrHistory["data"]) . "', ";
					if($row[$arrField["keyword"]] != $arrHistory["keyword"])		$sqlSet .= $arrField["keyword"] . " = '" . replaceMQ($arrHistory["keyword"]) . "', ";
					
					$queryStr	= "UPDATE " . $fs_table . "
										SET " . $sqlSet . " " . $this->ff . "last_update = " . time() . "
										WHERE " . $this->get_sql();
					
				}// End if($update == 1)
				
				$db_execute	= new db_execute($queryStr, 1);
				unset($db_execute);
				
				//if(defined("IP_IS_TRUSTED")) print_r($arrHistory);
				
			}// End if($hash == $arrTemp[5])
			
		}// End if(count($arrTemp) == 6)
		
	}
	
	/**
	Function add to history
	*/
	function add($data, $cache_data){
		
		// Xóa data cũ và nối data mới vào đầu
		$strReturn	= str_replace("[" . $data . "]", "", $cache_data);
		$strReturn	= "[" . $data . "]" . $strReturn;
		
		// Kiểm tra xem có quá số limit quy định hay ko, nếu quá thì cắt bớt và gán lại
		$arrTemp		= convert_string_to_array($strReturn);
		$limit		= ($this->user_id > 0 ? $this->limit_user : $this->limit_guest);
		if(count($arrTemp) > $limit){
			$arrTemp		= array_slice($arrTemp, 0, $limit);
			$strReturn	= "";
			foreach($arrTemp as $value) $strReturn .= "[" . $value . "]";
		}
		
		return $strReturn;
		
	}
	
	/**
	Function get data from history
	*/
	function get(){
		
		// Array trả về, mặc định là rỗng
		$arrReturn 	= array ("category_product"=> array(),
									"product"			=> array(),
									"keyword_product"	=> array(),
									);
		
		// Check cookie
		if(!$this->check_cookie()) return $arrReturn;
		
		$fs_table	= $this->get_table();
		$db_history	= new db_query("SELECT *
											 FROM " . $fs_table . "
											 WHERE " . $this->get_sql(),
											 __FILE__, "", 1);
		if($row = mysql_fetch_assoc($db_history->result)){
			
			// Array khai báo các module
			$arrTemp		= array ("product"	=> array("module"				=> "phagia",
																	"table"				=> "phagia",
																	"id_field"			=> "pha_id",
																	"category_field"	=> "pha_category_id",
																	),
										);
			
			// Loop để lấy data
			foreach($arrTemp as $mkey => $mvalue){
				
				// Category
				$listId		= convert_string_to_list_id($row[$this->ff . "category_" . $mkey]);
				$arrID		= convert_string_to_array($row[$this->ff . "category_" . $mkey]);
				
				// Lấy category theo thứ tự
				$sqlSelect	= ", 0";
				foreach($arrID as $key => $value){
					$sqlSelect	.= " + IF(cat_id = " . $value . ", " . $key . ", 0) ";
				}
				$sqlSelect	.= " AS stt ";
				$db_category= new db_query("SELECT cat_id, cat_name, cat_rewrite " . $sqlSelect . "
													 FROM categories_multi
													 WHERE cat_active = 1 AND cat_type = '" . $mvalue["module"] . "' AND cat_id IN(" . $listId . ")
													 ORDER BY stt ASC",
													 __FILE__, "USE_SLAVE");
				while($rowTemp	= mysql_fetch_assoc($db_category->result)){
					$arrReturn["category_" . $mkey][$rowTemp["cat_id"]]	= $rowTemp;
				}
				unset($db_category);
				
				// Lấy ID
				$listId		= convert_string_to_list_id($row[$this->ff . $mkey]);
				$arrID		= convert_string_to_array($row[$this->ff . $mkey]);
				$sqlSelect	= ", 0";
				foreach($arrID as $key => $value){
					$sqlSelect	.= " + IF(" . $mvalue["id_field"] . " = " . $value . ", " . $key . ", 0) ";
				}
				$sqlSelect	.= " AS stt ";
				
				// Lấy data
				$db_data		= new db_query("SELECT * " . $sqlSelect . "
													 FROM " . $mvalue["table"] . " STRAIGHT_JOIN categories_multi ON (" . $mvalue["category_field"] . " = cat_id AND cat_active = 1 AND cat_type = '" . $mvalue["module"] . "') 
													 WHERE " . $mvalue["id_field"] . " IN(" . $listId . ")
													 ORDER BY stt ASC",
													 __FILE__, "USE_SLAVE");
				// Loop để đưa vào array trả về
				while($rowTemp	= mysql_fetch_assoc($db_data->result)){
					
					// Gán vào array trả về
					$arrReturn[$mkey][$rowTemp[$mvalue["id_field"]]]		= $rowTemp;
					
					// Check xem nếu chưa có trong array category thì gán, đã có thì tăng biến count 
					if(!isset($this->array_category[$mkey][$rowTemp["cat_id"]])){
						$this->array_category[$mkey][$rowTemp["cat_id"]]	= array ("cat_id"			=> $rowTemp["cat_id"],
																										"cat_name"		=> $rowTemp["cat_name"],
																										"cat_rewrite"	=> $rowTemp["cat_rewrite"],
																										"count"			=> 1,
																										);
					}
					else $this->array_category[$mkey][$rowTemp["cat_id"]]["count"]++;
					
				}
				unset($db_data);
				
				// Keyword
				$arrReturn["keyword_" . $mkey]	= convert_string_to_array($row[$this->ff . "keyword_" . $mkey]);
				
			}// End foreach($arrTemp as $mkey => $mvalue)
			
		}// End $db_history
		$db_history->close();
		unset($db_history);
		
		// Return data
		return $arrReturn;
		
	}
	
	/**
	Function xóa history trong database
	*/
	function delete($type, $data){
		
		// Check cookie
		if(!$this->check_cookie()) return;
		
		$field	= "";
		switch($type){
			case "category_product"	: $field	= $this->ff . "category_product"; break;
			case "product"				: $field	= $this->ff . "product"; break;
			case "keyword_product"	: $field	= $this->ff . "keyword_product"; break;
		}
		
		// Nếu có field mới xóa
		if($field != ""){
			
			$data	= trim(str_replace(array("[", "]"), array("", ""), $data));
			
			$fs_table	= $this->get_table();
			$db_execute	= new db_execute("UPDATE " . $fs_table . "
												 SET " . $field . " = REPLACE(" . $field . ", '[" . replaceMQ($data) . "]', '')
												 WHERE " . $this->get_sql(),
												 1);
			unset($db_execute);
			
		}// End if($field != "")
		
	}
	
	/**
	Function xóa history trong database
	*/
	function delete_all($module){
		
		// Check cookie
		if(!$this->check_cookie()) return;
		
		switch($module){
			default			: $sqlSet = $this->ff . "category_product = '', " . $this->ff . "product = '', " . $this->ff . "keyword_product = '' "; break;
		}
		
		$fs_table	= $this->get_table();
		$db_execute	= new db_execute("UPDATE " . $fs_table . "
											 SET " . $sqlSet . "
											 WHERE " . $this->get_sql(),
											 1);
		unset($db_execute);
		
	}
	
	/**
	 * Function tra ve mang cac id deal trong history thuoc danh muc truyen vao
	 * history::getDealInCat()
	 * 
	 * @param mixed $cat
	 * @return void
	 */
	function getDealInCat($cat){

		$array_return	= array();
		$db_query		= new db_query("SELECT * FROM ". $this->get_table() ." WHERE ". $this->get_sql(), __FILE__, "", 1);
		if($row	= mysql_fetch_assoc($db_query->result)){
			$str_deal	= $row['hu_product'];
			$list_id		= convert_string_to_list_id($str_deal);
			//query lay id thuoc danh muc truyen vao
			$arr_cat		= getInfoCategory($cat);
			$list_cat	= isset($arr_cat['cat_all_child']) ? convert_list_to_list_id($arr_cat['cat_all_child']) : $cat;
			$db_deal		= new db_query("	SELECT pha_id
													FROM phagia
													WHERE pha_category_id IN(". $list_cat .") AND pha_id IN(". $list_id .")");
			while($row_deal	= mysql_fetch_assoc($db_deal->result)){
				$array_return[]	= $row_deal['pha_id'];
			}
			unset($db_deal);
		}
		unset($db_query);
		
		return $array_return;
	}
}
?>