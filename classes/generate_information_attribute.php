<?php
class generate_infomation_attribute{
	
	var $num_col 						= 2; // số cột chia
	var $field_name					= "";
	var $arrayType						= array(1=>"Kiểu multi check", 2=>"Kiểu select box");
	var $group_id						= 0;
	
	/**
	 * generate_infomation_attribute::__construct()
	 * 
	 * @param integer $group_id : ID của group
	 * @return void
	 */
	function __construct($group_id = 0){
		$group_id			= intval($group_id);
		$this->group_id	= $group_id;
	}
	
	/**
	 * Function tra ve array cac thuoc tinh cua group co id truyen vao
	 * generate_infomation_attribute::getAttributeOfGroup()
	 * 
	 * @param integer $grp_id : ID group
	 * @param integer $filter_phagia : co loc theo pha gia hay khong 1 : co
	 * @return
	 */
	function getAttributeOfGroup($grp_id = 0, $filter_phagia = 0){
		$array_return 	= array();
		$grp_id			= intval($grp_id);
		$filter_phagia	= intval($filter_phagia);
		
		if($grp_id <= 0) return $array_return;
		
		$sqlWhere	= "";
		if($filter_phagia > 0){
			$sqlWhere	= " AND ica_phagia_filter = " . $filter_phagia;	
		}
		
		$db_query	= new db_query("	SELECT *
												FROM information_group, information_group_category, information_category
												WHERE igp_id = igc_group_id AND igc_icategory_id = ica_id AND igp_id = ". $grp_id . $sqlWhere, __FILE__ . ': line ' . __LINE__, "USE_SLAVE");
		while($row	= mysql_fetch_array($db_query->result)){
			$array_return[$row['ica_id']]		= $row; 	
		}
		unset($db_query);
		
		return $array_return;
	}
	
	
	/**
	 * Function tra ve array cac thuoc tinh cua danh muc co id truyen vao
	 * generate_infomation_attribute::getAttributeOfCategory()
	 * 
	 * @param mixed $cat_id : ID danh muc
	 * @param integer $filter_phagia : co loc theo pha gia haykhong -> 1 : co
	 * @return void
	 */
	function getAttributeOfCategory($cat_id = 0, $filter_phagia = 0, $define_colum = 0){
		
		$cat_id			= intval($cat_id);
		$array_return 	= array();
		
		if($cat_id == 0) return $array_return;
		
		$db_select	= new db_query("SELECT * FROM categories_multi WHERE cat_id = ". $cat_id, __FILE__ . ': line ' . __LINE__, "USE_SLAVE");
		if($row	= mysql_fetch_assoc($db_select->result)){
			
			$arrayAttributeGroup		= $this->getAttributeOfGroup($row['cat_group_id'], $filter_phagia);
			
			foreach($arrayAttributeGroup as $key => $value){
				for($i = 1; $i<=10; $i++){
					if($row['cat_param'. $i] == $key){
						$array_return[$key]						= $value;	
						$array_return[$key]['name_colum']	= "cat_param" . $i;
					}
				}
			}
		}else{
			return $array_return;
		}
		
		// Neu thuoc tinh phai duoc dinh nghia trong colum_attribute
		if($define_colum == 1){
			$array_define	= $this->getAttributeOfCateInColum($cat_id);
			foreach($array_return as $key => $value){
				if(!isset($array_define[$key])){
					unset($array_return[$key]);
				}
			}
		}
		
		return $array_return;	
	}
	
	/**
	 * Function tra ve array chua thông tin cac thuoc tinh, gia tri cac thuoc tinh ma deal nay co
	 * generate_infomation_attribute::getAttributeOfDeal()
	 * 
	 * @param integer $pha_id
	 * @return
	 */
	function getAttributeOfDeal($pha_id = 0, $use_memcache = 1){
		
		global $config_memcache;
		$pha_id			= intval($pha_id);
		$array_return	= array();
		$memcache		= new memcached_store();
		
		if($pha_id	== 0) return $array_return;
		
		if($config_memcache == 1 && $use_memcache == 1){
			$array_return	= $memcache->get("Attribute_default_" . $pha_id);
		}
		if($array_return)	return $array_return;
		
		$arrayAttribute	= array();
		$db_query			= new db_query("SELECT * FROM phagia_information_category WHERE pic_phaiga_id = ". $pha_id, __FILE__ . ': line ' . __LINE__, "USE_SLAVE");
		while($row = mysql_fetch_assoc($db_query->result)){
			$arrayAttribute[$row['pic_phagia_category']]	= $row['pic_total_value'];
		}
		unset($db_query);
	
		if(count($arrayAttribute) > 0){
			$list_icat	= convert_array_to_list(array_keys($arrayAttribute));
			
			$db_select 	= new db_query("	SELECT ica_id,ica_type,ica_name,ica_title
													FROM information_category,information_group_category
													WHERE ica_id = igc_icategory_id AND ica_id IN(" . $list_icat . ")", __FILE__ . ': line ' . __LINE__, "USE_SLAVE");
			while($cat 	= mysql_fetch_assoc($db_select->result)){
				//đưa ra các tiêu chí lựa chọn
				$db_value = new db_query("	SELECT *
													FROM information_category_value
													WHERE icv_icategory = " . $cat["ica_id"] . " AND icv_active = 1
													ORDER BY icv_order ASC", __FILE__ . ': line ' . __LINE__, "USE_SLAVE");
				while($row_value	= mysql_fetch_assoc($db_value->result)){
					if(isset($arrayAttribute[$cat["ica_id"]])){
						if(((doubleval($row_value["icv_real_value"]) & doubleval($arrayAttribute[$cat["ica_id"]]))!=0)){
							$array_return[$cat["ica_id"]]["name"]													= $cat["ica_name"];
							$array_return[$cat["ica_id"]]["title"]													= $cat["ica_title"];
							$array_return[$cat["ica_id"]]["total_value"]											= $arrayAttribute[$cat["ica_id"]];
							$array_return[$cat["ica_id"]]["info"][$row_value["icv_id"]]['real_value']	= $row_value['icv_real_value'];
							$array_return[$cat["ica_id"]]["info"][$row_value["icv_id"]]['alias']			= ($row_value["icv_name_alias"] != "" ? $row_value["icv_name_alias"] : 'name:' . $row_value["icv_name"]);
							$array_return[$cat["ica_id"]]["info"][$row_value["icv_id"]]['name']			= $row_value["icv_name"];
						}
					}
				}
				unset($db_value);
			}
			unset($db_select);
		}
		
		if($config_memcache == 1 && $array_return && $use_memcache == 1){
			$memcache->set("Attribute_default_". $pha_id, $array_return);
		}
		
		return $array_return;				
	}
	
	/**
	 * Lay anh cua 1 deal theo gia tri cua thuoc tinh duoc chon de filter anh
	 * generate_infomation::getImagesAttribute()
	 * 
	 * @param integer $pha_id : Ma pha gia
	 * @param mixed $attribute_value :id cua gia tri thuoc tinh( vd :mau do(23), size S(15)...)
	 * @param integer $use_memcache : Co su dung memcache hay khong
	 * @return void
	 */
	function getImagesAttribute($pha_id = 0, $attribute_value = 0, $use_memcache = 1){
		
		global $config_memcache;
		$array_return 		= array();
		$pha_id				= intval($pha_id);
		$attribute_value	= intval($attribute_value);
		
		$memcache			= new memcached_store();
		if($config_memcache == 1 && $use_memcache == 1){
			$array_return	= $memcache->get("images_attribute_" . $pha_id . "_" . $attribute_value);
		}
		if($array_return){
			return $array_return;
		}
		
		$ArrayInfoDeal		= getInfoDeal($pha_id);
		if(!$ArrayInfoDeal) return $array_return;
		
		$query	= "SELECT * FROM phagia_pictures WHERE ppic_phagia_id = " . $pha_id;

		// Là sản phẩm con
		if($ArrayInfoDeal['pha_parent_id'] > 0 && $ArrayInfoDeal['pha_attribute_picture'] > 0){
			$array_value	= array();
			// Lấy tên cột lưu giá trị filter theo ảnh
			$array_colum	= $this->getAttributeOfCateInColum($ArrayInfoDeal['pha_category_id']);
			if(isset($array_colum[$ArrayInfoDeal['pha_attribute_picture']])){
				// Lấy id giá trị thuộc tính mà Deal này có
				$db_value_attribute	= new db_query("	SELECT * FROM phagia_multi
																	WHERE pmu_phagia_self_id = " . $pha_id . " AND pmu_phagia_id = " . $ArrayInfoDeal['pha_parent_id'], __FILE__, "USE_SLAVE");
				while($row_value	= mysql_fetch_assoc($db_value_attribute->result)){
					
					if(isset($row_value['pmu_' . $array_colum[$ArrayInfoDeal['pha_attribute_picture']]]) && $row_value['pmu_' . $array_colum[$ArrayInfoDeal['pha_attribute_picture']]] > 0){
						$array_value[]	= $row_value['pmu_' . $array_colum[$ArrayInfoDeal['pha_attribute_picture']]];
					}
				}
				unset($db_value_attribute);
			}
			$query	= "SELECT * FROM phagia_pictures WHERE ppic_phagia_id = " . $ArrayInfoDeal['pha_parent_id'] . " AND ppic_attribute IN(" . convert_array_to_list($array_value) . ")";
		}

		if($attribute_value > 0){
			$query	.= " AND ppic_attribute = ". $attribute_value;
		}
		$db_query	= new db_query($query, __FILE__ . ': line ' . __LINE__);
		while($row = mysql_fetch_assoc($db_query->result)){
			$array_return[$row['ppic_attribute']][$row['ppic_id']]	= $row;
		}
		unset($db_query);
		
		if($config_memcache == 1 && $array_return){
			$memcache->set("images_attribute_" . $pha_id . "_" . $attribute_value, $array_return);
		}
		
		return $array_return;
	}
	
	
	/**
	 * Array Images theo gia tri thuoc tinh duoc chon dung de show
	 * generate_infomation_attribute::getImagesToShow()
	 * 
	 * @param mixed $array_images			: Array chua danh sach anh ban dau
	 * @param integer $attribute_value	: ID gia tri thuoc tinh duoc chon
	 * @return void
	 */
	function getImagesToShow($array_images	= array(), $attribute_value = 0){
	
		$array_return	= array(	"main_picture" 	=> "",		// Ảnh chính
										"filter_picture"	=> "",		// Ảnh filter
										"images"				=> array()); // Array chứa ảnh để show

		$array_images_show	= array();
		// Nếu đã chọn 1 giá trị thuộc tính-> Lấy ảnh của giá trị này
		if($attribute_value > 0){
			if(isset($array_images[$attribute_value]) && $array_images[$attribute_value]){
				foreach($array_images[$attribute_value] as $value_img){
					// Không dùng ảnh được chọn làm ảnh filter
					if(!isset($value_img['ppic_filter_pic']) || $value_img['ppic_filter_pic'] != 1){
						$array_images_show[]	= $value_img['ppic_pictures'];
						// Ảnh chính
						if(isset($value_img['ppic_main_pic']) && $value_img['ppic_main_pic'] == 1){
							$array_return['main_picture']	= $value_img['ppic_pictures'];	
						}
					}else{
						$array_return['filter_picture']	= $value_img['ppic_pictures'];	
					}
				}
			}
		}else{
			// Lấy toàn bộ ảnh
			if($array_images){
				foreach($array_images as $arr_img){
					foreach($arr_img as $key_img => $value_img){
						// Không dùng ảnh được chọn làm ảnh filter
						if(!isset($value_img['ppic_filter_pic']) || $value_img['ppic_filter_pic'] != 1){
							$array_images_show[$key_img] = $value_img['ppic_pictures'];
							// Ảnh chính
							if(isset($value_img['ppic_main_pic']) && $value_img['ppic_main_pic'] == 1){
								$array_return['main_picture']	= $value_img['ppic_pictures'];	
							}
						}else{
							$array_return['filter_picture']	= $value_img['ppic_pictures'];	
						}
					}
				}
			}
		}

		$array_return['images']	= $array_images_show;
		
		return $array_return;
	}
	
	/**
	 * Function tra ve mang cac thuoc tinh cua danh muc duoc dinh nghia trong colum_attribute
	 * generate_infomation_attribute::getAttributeOfCateInColum()
	 * 
	 * @param integer $cat_id
	 * @param integer $use_memcache
	 * @return void
	 */
	function getAttributeOfCateInColum($cat_id = 0, $use_memcache	= 1){
		
		global $config_memcache;
		$cat_id			= intval($cat_id);
		$array_return 	= array();
		$memcache		= new memcached_store();
		
		if($cat_id == 0) return $array_return;
		
		if($config_memcache == 1 && $use_memcache == 1){
			$array_return	= $memcache->get("Attribut_cate_colum_". $cat_id);
		}
		if($array_return) return $array_return;
		
		$db_query	= new db_query("SELECT * FROM colum_attribute WHERE coa_category_id = ". $cat_id, __FILE__ . ': line ' . __LINE__, "USE_SLAVE");
		while($row	= mysql_fetch_assoc($db_query->result)){
			$array_return[$row['coa_define']]	= $row['coa_name'];
		}
		unset($db_query);
		
		if($config_memcache == 1 && $array_return && $use_memcache == 1){
			$memcache->set("Attribut_cate_colum_". $cat_id, $array_return);
		}
		return $array_return;
	}

	
	/**
	 * Function tra ve mang thong tin cac thuoc tinh mac dinh, loc theo cookie, cac trang thai loc cua Deal
	 * generate_infomation_attribute::getAttributeToShow()
	 * 
	 * @param mixed $pha_id
	 * @return
	 */
	function getAttributeToShow($pha_id){
		
		$pha_id				= intval($pha_id);
		$status_filter		= 1;//Biến xác định có phẩm theo thuộc tính đã chọn không
   	$status_select		= 1;//Biến xác định user đã chọn đủ các thuộc tính chưa
   	$array_return		= array(	"data_default" => array(),
											"data" => array(),
											"filter"=> array(),
											"cookie" => array(),
											"attribute" => array(),
											"status_select" => $status_select,
											"status_filter" => $status_filter);

		if($pha_id	== 0)	return $array_return;
		
		// Mảng thông tin Deal
		$arrayInfoDeal	= getInfoDeal($pha_id);
		if(!$arrayInfoDeal) return $array_return;
		
		if(isset($arrayInfoDeal['pha_has_child']) && $arrayInfoDeal['pha_has_child'] == 0){
			return $array_return;
		}

		// Mảng chứa các thuộc tính được định nghĩa trong coloum_attribute tương ứng với danh mục Deal
		$arrayColum		= $this->getAttributeOfCateInColum($arrayInfoDeal['pha_category_id']);
		if(!$arrayColum) return $array_return;
		
		// Mảng thông tin mặc định
		$array_phagia_infomation	= $this->getAttributeOfDeal($pha_id);
		if(!$array_phagia_infomation){
			return $array_return;
		}
		
		$array_default	= array();
		
		// Thuộc tính phải được định nghĩa trong colum_attribute thì mới show
		foreach($array_phagia_infomation as $key => $value){
			if(isset($arrayColum[$key])){
				$array_default[$key]	= $array_phagia_infomation[$key];
			}
		}
		
		if(!$array_default) return $array_return;
		
		// Mảng thông tin lọc theo Cookie
		$arrayInfoCookie	= array();
		// Lấy thông tin theo Cookie
		$arrCookie	= array();
		foreach($array_default as $key => $value){
			if(isset($_COOKIE['attribute_' . $pha_id . '_' . $key]) && $_COOKIE['attribute_' . $pha_id . '_' . $key] > 0){
				$arrCookie[$key]	= $_COOKIE['attribute_' . $pha_id . '_' . $key]; 
			}
		}
		
		$arrayInfofilter	= $array_default; // Mảng thông tin lọc theo từng thuộc tính
		// Nếu tồn tại cookie thì lấy data từ phagia_multi
		if($arrCookie){
			
			// Filter theo từng giá trị được chọn
			$arrayinfo		= array();
			foreach($arrCookie as $key => $value){
				$sql_where	= "";
				if(isset($arrayColum[$key])){
					
					foreach($arrayColum as $key_search => $value_search){
						if($key != $key_search){
							//Xóa dữ liệu của key này thay bằng dữ liệu lọc được
							unset($arrayInfofilter[$key_search]);
						}	
					}
					$sql_where	= " AND pmu_" . $arrayColum[$key] . " = " . $value;
					$db_query	= new db_query("SELECT * FROM phagia_multi WHERE pmu_phagia_id = " . $pha_id . $sql_where, __FILE__, "USE_SLAVE");
					while($row	= mysql_fetch_assoc($db_query->result)){
						for($i = 1; $i <= 10; $i++){
							if($row['pmu_col_' . $i] > 0 && 'pmu_col_' . $i != 'pmu_' . $arrayColum[$key]){
								$arrayinfo['col_' . $i][$row['pmu_col_' . $i]]	= $row['pmu_col_' . $i];
							}
						}
					}
				} // End isset($arrayColum[$key])
			}// End foreach $arrCookie
			
			// Tạo mảng thông tin theo cookie
			if($arrayinfo){
				foreach($arrayColum as $key => $value){
					if(isset($arrayinfo[$value]) && isset($array_default[$key])){
						
						$arrayInfofilter[$key]['name']	= $array_default[$key]['name'];
						foreach($arrayinfo[$value] as $key_cat => $value_cat){
							if(isset($array_default[$key]['info'][$key_cat])){
								$arrayInfofilter[$key]['info'][$key_cat]	= $array_default[$key]['info'][$key_cat];
							}
						}
					}
				}
			}
			
			//Filter theo tất cả các giá trị được chọn
			$sql_where	= "";
			foreach($arrayColum as $key => $value){
				if(isset($arrCookie[$key])){
					$sql_where	.= " AND pmu_". $arrayColum[$key] ." = ". $arrCookie[$key]; 
				}
			}
			
			$arrayinfo		= array();
			if($sql_where != ""){
				$db_query	= new db_query("SELECT * FROM phagia_multi WHERE pmu_phagia_id = " . $pha_id . $sql_where);
				while($row	= mysql_fetch_assoc($db_query->result)){
					for($i = 1; $i <= 10; $i++){
						if($row['pmu_col_' . $i] > 0){
							$arrayinfo['col_' . $i][$row['pmu_col_' . $i]]	= $row['pmu_col_' . $i];
						}
					}
				}
				unset($db_query);
			}
			
			// Tạo mảng thông tin theo cookie
			if($arrayinfo){
				foreach($arrayColum as $key => $value){
					if(isset($arrayinfo[$value]) && isset($array_default[$key])){
						
						$arrayInfoCookie[$key]['name']	= $array_default[$key]['name'];
						foreach($arrayinfo[$value] as $key_cat => $value_cat){
							if(isset($array_default[$key]['info'][$key_cat])){
								$arrayInfoCookie[$key]['info'][$key_cat]	= $array_default[$key]['info'][$key_cat];
							}
						}
					}
				}
			}
		}// End has cookie
		
		// Đưa ra các trạng thái
		if(count($arrCookie) < count($array_default)){
			$status_select		= 0;// Chưa chọn đủ thuộc tính
		}else{
			if(!$arrayInfoCookie){
				$status_filter		= 0;//Không lọc được sản phẩm nào
			}
		}
		
		$array_return['data_default']		= $array_default;
		$array_return['data']				= $arrayInfoCookie;
		$array_return['filter']				= $arrayInfofilter;
		$array_return['cookie']				= $arrCookie;
		$array_return['attribute'] 		= $array_phagia_infomation;
		$array_return['status_filter']	= $status_filter;
		$array_return['status_select']	= $status_select;
		
		return $array_return;
	}
	
	
	function show_phagia_detail($array_default, $array, $array_cookie, $pha_id){
		
		global $images_path;
		$strForm	= "";
		$pha_id	= intval($pha_id);
		if($pha_id <= 0){
			return  $strForm;
		}
		
		//Lấy array ảnh theo giá trị thuộc tính
		$array_images	= $this->getImagesAttribute($pha_id);
		
		//Lay id thuoc tính duoc chon de filter theo anh
		$pha_attribute	= 0;
		$db_query		= new db_query("SELECT pha_attribute_picture FROM phagia WHERE pha_id = " . $pha_id, "File :generate_infomation_attribute.php", "USE_SLAVE");
		if($row	= mysql_fetch_assoc($db_query->result)){
			$pha_attribute	= $row['pha_attribute_picture'];
		}
		unset($db_query);

		$strForm		= '<div class="pha_information">';
		
		foreach($array_default as $key => $value){
			$text_curent	= "";
			// Lay ten cua gia tri thuoc tinh duoc chon
			if(isset($array_cookie[$key])){
				$text_curent	= $array_default[$key]['info'][$array_cookie[$key]]['name'];
			}

			$strForm	.= '<span>' . $value["name"] . ' : '. $text_curent .'</span>';
			$strForm	.= '<div class="pha_information_list">';
			
			foreach($value['info'] as $info_val	=> $info_name){
				$arrNameTemp	= explode(":", $info_name['alias']);
				if(count($arrNameTemp) == 2){
					$nameType	= $arrNameTemp[0];
					$nameVal		= $arrNameTemp[1];
					$class		= "";
					$href			= 'javascript:filterDealAttribute('. $pha_id .', ' . $key . ',' . $info_val . ', 0)';
					$check_style	= 0;
					
					//  Neu dung la gia tri thuoc tinh dang chon
					if(isset($array_cookie[$key]) && $array_cookie[$key] == $info_val){
						$check_style	= 1;
						$href	= "javascript:;"; // Khong tao link goi ham
					}
					
					// Neu da chon thuoc tinh va gia tri nay khong nam trong $array
					if($array_cookie && !isset($array[$key]['info'][$info_val])){
						// Neu chua chon thuoc tinh nay hoac gia tri thuoc tinh khong la 1 gia tri dang chon
						if(!isset($array_cookie[$key]) || (isset($array_cookie[$key]) && $array_cookie[$key] != $info_val)){
							$class	= "no_attribute";	
						}
						// Link co chi so thu 4 la 1 => neu chon thuoc tinh nay thi them phan xoa cac thuoc tinh da chon truoc -> chon lai tu dau
						$href		= 'javascript:filterDealAttribute('. $pha_id .', ' . $key . ',' . $info_val . ', 1)';
					}
					
					if($pha_attribute == $key && isset($array_images[$info_val])){
						$main_picture	= "";
						foreach($array_images[$info_val] as $key_img => $value_img){
							$main_picture	= $value_img['ppic_pictures'];
							if($value_img['ppic_main_pic'] == 1){
								$main_picture	= $value_img['ppic_pictures'];
								break;	
							}
						}

						$class	.= " filter_attribute_img";
						if($check_style == 1){
							$class	.= " select_attribute_img";
						}
						$strForm	.= '<div class="'. $class .'">
											<a title="'. $info_name['name'] .'" href="'. $href .'">
												<img src="'. $images_path .'pictures/phagia/small/small_'. $main_picture .'">
											</a>
										</div>';
					}else{
						switch($nameType){
							case 'color':
								$class	.= " nomal_attribute_color";
								if($check_style == 1){
									$class	.= " select_attribute_color";
								}
								$strForm	.= '<div style="background:#' . $nameVal . '" class="'. $class .'"><a title="'. $info_name['name'] .'" href="'. $href .'"></a></div>';
								break;
							case 'box':
								$class	.= " nomal_attribute_box";
								if($check_style == 1){
									$class	.= " select_attribute_box";
								}
								$strForm	.= '<div class="'. $class .'" ><a title="'. $info_name['name'] .'" href="'. $href .'">' . $nameVal . '</a></div>';
								break;
							default:
								$class	.= " nomal_attribute_default";
									if($check_style == 1){
										$class	.= " select_attribute_default";
									}
								$strForm	.= '<div class="'. $class .'" ><a title="'. $info_name['name'] .'" href="'. $href .'">' . $nameVal . '</a></div>';
								break;
						}
					}
				}
			}
			$strForm	.= '<div class="clear"></div>';
			$strForm	.= '</div>';		
		}
		$strForm	.= "</div>";
		
		return $strForm;
	}
	
	
	function show_phagia_detail_v2($array_default, $array, $array_cookie, $pha_id){
		
		global $images_path;
		$strForm	= "";
		$pha_id	= intval($pha_id);
		if($pha_id <= 0){
			return  $strForm;
		}
		
		//Lấy array ảnh theo giá trị thuộc tính
		$array_images	= $this->getImagesAttribute($pha_id);
		
		// Lấy id thuộc tính được chọn để filter theo ảnh
		$pha_attribute	= 0;
		$db_query		= new db_query("SELECT pha_attribute_picture FROM phagia WHERE pha_id = " . $pha_id, __FILE__, "USE_SLAVE");
		if($row	= mysql_fetch_assoc($db_query->result)){
			$pha_attribute	= $row['pha_attribute_picture'];
		}
		unset($db_query);

		$strForm		= '<div class="pha_information">';
		
		foreach($array_default as $key => $value){
			$text_curent	= "";
			// Lấy tên của giá trị thuộc tính được chọn
			if(isset($array_cookie[$key])){
				$text_curent	= $array_default[$key]['info'][$array_cookie[$key]]['name'];
			}

			$strForm	.= '<span class="fl">' . $value["name"] . '</span>';
			$strForm	.= '<div class="pha_information_list">';
			
			foreach($value['info'] as $info_val	=> $info_name){
				$arrNameTemp	= explode(":", $info_name['alias']);
				if(count($arrNameTemp) == 2){
					$nameType		= $arrNameTemp[0];
					$nameVal			= $arrNameTemp[1];
					$class			= "";
					$href				= 'javascript:filterDealAttribute('. $pha_id .', ' . $key . ',' . $info_val . ', 0)';
					$check_style	= 0;
					
					//  Nếu là giá trị thuộc tính đang chọn
					if(isset($array_cookie[$key]) && $array_cookie[$key] == $info_val){
						$check_style	= 1;
						$href	= "javascript:;";
					}

					// Nếu đã chọn thuộc tính và giá trị này không nằm trong $array
					if(!isset($array[$key]['info'][$info_val])){
						$check_style	= 2;
						$href		= 'javascript:filterDealAttribute('. $pha_id .', ' . $key . ',' . $info_val . ', 1)';
					}
					
					if($pha_attribute == $key && isset($array_images[$info_val])){
						$main_picture	= "";
						foreach($array_images[$info_val] as $key_img => $value_img){
							$main_picture	= $value_img['ppic_pictures'];
							
							// Lấy ảnh được chọn để show filter
							if($value_img['ppic_filter_pic'] == 1){
								$main_picture	= $value_img['ppic_pictures'];
								break;
							}else{
								// Lấy đến ảnh được chọn là ảnh chính
								if($value_img['ppic_main_pic'] == 1){
									$main_picture	= $value_img['ppic_pictures'];
								}
							}
						}

						$class	= " filter_attribute_img";
						if($check_style == 1){
							$class	.= " select_attribute_img";
						}
						if($check_style == 2){
							$class	.= " no_attribute_img";
						}
						$strForm	.= '<div class="attribute_img fl">
											<a title="'. $info_name['name'] .'" href="'. $href .'">
												<img src="'. $images_path .'pictures/phagia/50x50/'. $main_picture .'">
											
												<div class="' . $class . '"></div>
											</a>
										</div>';
					}else{
						switch($nameType){
							case 'color':
								$class	= " nomal_attribute_color fl";
								if($check_style == 1){
									$class	.= " select_attribute_color";
								}
								if($check_style == 2){
									$class	.= " no_attribute_color";
								}
								$strForm	.= '<div style="background:#' . $nameVal . '" class="' . $class . '"><a title="'. $info_name['name'] .'" href="'. $href .'">&nbsp;</a></div>';
								break;
							case 'box':
								$class	.= " nomal_attribute_box fl";
								if($check_style == 1){
									$class	.= " select_attribute_box";
								}
								if($check_style == 2){
									$class	.= " no_attribute_box";
								}
								$strForm	.= '<div class="'. $class .'" ><a title="'. $info_name['name'] .'" href="'. $href .'">' . $nameVal . '</a></div>';
								break;
							default:
								$class	= " nomal_attribute_default fl";
									if($check_style == 1){
										$class	.= " select_attribute_default";
									}
									if($check_style == 2){
										$class	.= " no_attribute_default";
									}
								$strForm	.= '<div class="'. $class .'" ><a title="'. $info_name['name'] .'" href="'. $href .'">' . $nameVal . '</a></div>';
								break;
						}
					}
				}
			}
			$strForm	.= '<div class="clear"></div>';
			$strForm	.= '</div>';		
		}
		$strForm	.= "</div>";
		
		return $strForm;
	}
	
	/**
	 * generate_infomation_attribute::form()
	 * 
	 * @param integer $phagia_id : ID phagia
	 * @param integer $cat_id	  : ID danh muc	
	 * @param string $field_name : ten truong
	 * @return
	 */
	function form($phagia_id = 0, $cat_id = 0, $business_id = 0){
		
		//Biến return
		$strreturn 					= '';
		$array_Category_Value	= array(); // Array chứa danh sách các thuộc tính đã chọn
		$phagia_id					= intval($phagia_id);
		$business_id				= intval($business_id);
		
		// Lấy danh mục
		$category_id	= 0;
		if($cat_id <= 0 ){
			if($phagia_id > 0){
				$db_cat		= new db_query("SELECT pha_category_id FROM phagia WHERE pha_id = " . $phagia_id, __FILE__, "USE_SLAVE");
				if($row_cat	= mysql_fetch_assoc($db_cat->result)){
					$category_id	= $row_cat['pha_category_id'];
				}
				unset($db_cat);
			}
		}else{
			$category_id	= $cat_id;
		}
		
		// Nếu là edit phá giá
		if($phagia_id != 0){
			$array_Category_Value	= $this->getAttributeOfDeal($phagia_id);
		}else{
			//kiểm tra giá trị đã chọn khi edit doanh nghiệp
			if($business_id != 0){
				$sql = "	SELECT buc_icategory_id AS cat_id, buc_total_value AS total_value
							FROM business_information_category
							WHERE buc_business_id = " . $business_id;

				$db_select = new db_query($sql, __FILE__ . ': line ' . __LINE__, "USE_SLAVE");		
				while($row = mysql_fetch_assoc($db_select->result)){
					$array_Category_Value[$row["cat_id"]]['total_value']	= $row["total_value"];
				}
				unset($db_select);	
			}
		}
		
		//Lấy danh sách attribute mặc định
		$array_attribute	= array();
		if($category_id > 0){
			$array_attribute	= $this->getAttributeOfCategory($category_id, 1, 1);	
		}else{
			$array_attribute	= $this->getAttributeOfGroup($this->group_id, 0);
		}
		
		if($array_attribute){
			foreach($array_attribute as $key => $value){
			
			//đưa ra các gia tri thuoc tinh de lua chon
			$db_value = new db_query("	SELECT icv_name,icv_real_value 
												FROM information_category_value
												WHERE icv_icategory = " . $key . " AND icv_active = 1
												ORDER BY icv_order ASC", __FILE__ . ': line ' . __LINE__, "USE_SLAVE");
			$total	= mysql_num_rows($db_value->result);
			if($total > 0){
				// Kiểm tra kiểu dữ liệu
				switch(intval($value["ica_type"])){
					//kiểu so sánh bằng, select one
					case 2:
						//------------------------------------------------------------------------>
						$strreturn 	.= '<div class="info_category">' . $value["ica_name"];
						$strreturn 	.= ' : <select name="' . $this->field_name . '_' . $value["ica_id"] . '" id="' . $this->field_name . '_' . $value["ica_id"] . '[]">';
						
						while($row = mysql_fetch_assoc($db_value->result)){
							$checked		= ''; //khai báo checked 
							$catValue	= 0;
							//kiểm tra xem có checked hay không
							if(isset($array_Category_Value[$value["ica_id"]]['total_value'])){
								//Gián giá trị đã luu 
								$catValue  = $array_Category_Value[$value["ica_id"]]['total_value'];
							
							}else{ 
								// ngược lại thì getValue để lấy giá trị
								$catValue  = getValue($this->field_name . '_' . $value["ica_id"], "int", "POST", 0);
							}
							
							//nếu tồn tại thì kiểm tra có checked hay không
							if(((doubleval($row["icv_real_value"]) & doubleval($catValue))!=0)){
								$checked = 'selected="selected"';
							}
							
							$strreturn 	.= '<option value="' . $row["icv_real_value"] . '" ' . $checked . '>';
							$strreturn 	.= $row["icv_name"];
							$strreturn 	.= '</option>';
						}
	
						$strreturn 	.= '</select>';
						$strreturn 	.= '</div>';
						//------------------------------------------------------------------------>						
					break;
					//kiểu multi select
					case 1:
						//------------------------------------------------------------------------>
							//chèn tiêu đề infomation tintuc vào
							$strreturn 	.= '<div class="info_category">' . $value["ica_name"] . '</div>';
							//hiển thị theo dạng 2 cột
							
							$strreturn .= '<table cellpadding="1" cellspacing="0" border="0" bordercolor="#E7E7E7" style="border-collapse:collapse"><tr>';
							$i	= 0;
							$strreturn .= '<td width="350">';
							while($row = mysql_fetch_assoc($db_value->result)){
								$i++;
									//---------------------------------------------------------------->
									$checked = ''; //khai báo checked 
									$catValue = 0;
									//kiểm tra xem có checked hay không
									if(isset($array_Category_Value[$value["ica_id"]]['total_value'])){
										//Gián giá trị đã luu 
										$catValue  = $array_Category_Value[$value["ica_id"]]['total_value'];
									
									}else{ 
										// ngược lại thì getValue để lấy giá trị 		
										$catValue  = array_sum(getValue($this->field_name . '_' . $value["ica_id"],"arr","POST",array()));
									}

									//nếu tồn tại thì kiểm tra có checked hay không
									if(((doubleval($row["icv_real_value"]) & doubleval($catValue))!=0)){
										$checked = 'checked="checked"';
									}
									
									$strreturn .= '<div><input type="checkbox" name="' . $this->field_name . '_' . $value["ica_id"] . '[]" value="' . $row["icv_real_value"] . '" ' . $checked . ' /> ' . $row["icv_name"] . '</div>';
									if($i == round($total/$this->num_col)) $strreturn .= '</td><td>';
							}
							$strreturn .= '</td></tr></table>';												
						break;
				}
			} //end if
			unset($db_value);
				
			}
		}
		return $strreturn;								
	}
	
	
	function generate_add_search($pha_id = 0){	
		// Khai báo biến trả về
		$strreturn  = '';
		
		$db_select = new db_query("SELECT bus_id, igp_name,bus_name,bua_address,t2.cit_name AS qua_name,t1.cit_name AS city_name,bua_phone,bus_website,bua_email
											FROM phagia
											STRAIGHT_JOIN business ON(pha_business_id = bus_id)
											STRAIGHT_JOIN business_address ON(pha_busaddres_id = bua_id)
											STRAIGHT_JOIN city AS t2 ON(bua_city = t2.cit_id)
											STRAIGHT_JOIN city AS t1 ON(t2.cit_parent_id = t1.cit_id)
											STRAIGHT_JOIN information_group ON(igp_id = bus_group_id)
											WHERE pha_id = " . $pha_id,__FILE__ . ': line ' . __LINE__);
		if($row = mysql_fetch_assoc($db_select->result)){
			$strreturn  .= implode(" ", $row);
			
			// Select từ bảng cat name ra để ghép vào
			$db_select_value = new db_query("SELECT ica_name,ica_id,buc_total_value
														FROM business_information_category
														STRAIGHT_JOIN information_category ON(ica_id = buc_icategory_id)
														WHERE buc_business_id = " . $row["bus_id"], __FILE__ . ': line ' . __LINE__);
			while($ica = mysql_fetch_assoc($db_select_value->result)){
				
				$strreturn  .= ' ' . $ica["ica_name"];
				
				// Select value name ra để ghép vào
				$db_value = new db_query("SELECT icv_name
												  FROM information_category_value
												  WHERE (icv_real_value & " . doubleval($ica["buc_total_value"]) . ") AND icv_icategory = " . $ica["ica_id"],__FILE__ . ': line ' . __LINE__);
				while($icv = mysql_fetch_assoc($db_value->result)){
					$strreturn  .=  ' ' . $icv["icv_name"];
				}
				unset($db_value);
				
			}
			unset($db_select_value);
			
		}
		
		unset($db_select);	
		
		return $strreturn;	
	}
	
	/**
	 * Function insert thuoc tinh cua Product
	 * generate_infomation_attribute::insert_phagia()
	 * 
	 * @param integer $phagia_id
	 * @return
	 */
	function insert_phagia($phagia_id = 0){
		
		// Check id phagia trước
		if($phagia_id <= 0){
			return 'Lỗi không tồn tại ID';
		}else{
			//xóa các thông tin đã có để thêm mới từ đầu
			$db_ex = new db_execute("DELETE FROM phagia_information_category WHERE pic_phaiga_id = " . $phagia_id,__FILE__ . ': line ' . __LINE__);
			unset($db_ex);
		}
		//lay danh muc cua pha gia
		$db_query	= new db_query("SELECT pha_category_id FROM phagia WHERE pha_id = " . $phagia_id, __FILE__, "USE_SLAVE");
		if($row_query = mysql_fetch_assoc($db_query->result)){

			// Kiểm tra trong colum_attribute
			$array_colum	= array();
			$array_colum	= $this->getAttributeOfCategory($row_query['pha_category_id'], 1, 1);

			foreach($array_colum as $key => $value){
				$toalValue	= 0;
				// Lấy giá trị từ form gửi lên rồi count lại
				switch($value["ica_type"]){
					case 2: // Selectbox
						$toalValue = getValue($this->field_name . '_' . $key, "int", "POST");
						break;
					default: // Multi value (multi checkbox)
						$toalValue = array_sum(getValue($this->field_name . '_' . $key,"arr","POST",array()));
						break;
				}
				if($toalValue > 0){
					// Thực hiện lệnh thêm mới vào cơ sở dũ liệu
					$db_ex = new db_execute("INSERT INTO phagia_information_category(pic_phaiga_id,pic_phagia_category,pic_total_value) VALUES(" . $phagia_id . "," . $key . "," . $toalValue . ")");
					unset($db_ex);	
				}
			}								
			unset($db_select);	
		}else{
			return "Lỗi không tồn tại danh mục của phá giá";
		}
		unset($db_query);
	}

	/**
	 * Function add thong tin thuoc tinh cua doanh nghiep
	 * generate_infomation_attribute::insert_business()
	 * 
	 * @param integer $business_id
	 * @return void
	 */
	function insert_business($business_id = 0){

		$business_id	= intval($business_id);

		if($business_id <= 0){
			return 'Lỗi không tồn tại ID';
		}else{
			//xóa các thông tin đã có để thêm mới từ đầu
			$db_ex = new db_execute("DELETE FROM business_information_category WHERE buc_business_id = " . $business_id);
			unset($db_ex);
		}

		$db_select = new db_query("SELECT *
											FROM information_category,information_group_category
											WHERE ica_id = igc_icategory_id AND igc_group_id = " . $this->group_id, __FILE__ . ': line ' . __LINE__, "USE_SLAVE");							
		while($row = mysql_fetch_assoc($db_select->result)){
			// Lấy giá trị từ form gửi lên rồi count lại
			$toalValue	= 0;
			switch($row["ica_type"]){
				case 2:
					$toalValue = getValue($this->field_name . '_' . $row["ica_id"], "int", "POST");
				break;
				default:
					$toalValue = array_sum(getValue($this->field_name . '_' . $row["ica_id"], "arr", "POST", array()));
				break;
			}

			//thực hiện lệnh thêm mới vào cơ sở dũ liệu
			if($toalValue > 0){
				$db_ex = new db_execute("INSERT INTO business_information_category(buc_icategory_id,buc_business_id,buc_total_value) VALUES(" . $row["ica_id"] . "," . $business_id . "," . $toalValue . ")");
				unset($db_ex);	
			}
		}								
		unset($db_select);
	}


	/** 
	 * Function setcookie khi chon 1 gia tri thuoc tinh
	 * generate_infomation_attribute::createCookieAttribute()
	 * 
	 * @param integer $pha_id	: ID san pham
	 * @param integer $key		: ID thuoc tinh
	 * @param integer $value	: ID gia tri thuoc tinh
	 * @return void
	 */
	function createCookieAttribute($pha_id = 0, $key = 0, $value = 0){
		setcookie("attribute_" . $pha_id  . "_" . $key, $value, 1800, "/");
	}
	
	/**
	 * Function xoa cookie attribute cua 1 deal
	 * generate_infomation_attribute::delCookieAttribute()
	 * 
	 * @param mixed $pha_id : ID deal
	 * @param mixed $array_key    : mang chua id cua nhung thuoc tinh khong can xoa cookie
	 * @return void
	 */
	function delCookieAttribute($pha_id, $array_key = array()){
		
		$pha_id			= intval($pha_id);
		
		$attributeDeal	= $this->getAttributeOfDeal($pha_id);
		
		foreach($attributeDeal as $key => $value){
			if(isset($_COOKIE['attribute_'.  $pha_id . '_'. $key]) && !isset($array_key[$key])){
				setcookie('attribute_'.  $pha_id . '_'. $key, '', null, "/");
				unset($_COOKIE['attribute_'.  $pha_id . '_'. $key]);
				$_COOKIE['attribute_'.  $pha_id . '_'. $key]	= null;
			}
		}	
	}
	
}
?>