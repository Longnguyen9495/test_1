
<?
/**
 * Function tra ve danh sach banner
 * getBanner()
 *
 * @param integer $list_position	Vi tri (1->Banner top, 2->Banner left, 3->Banner right", 4->Banner bottom, 5->Banner tintuc, 6->Banner slibar)
 * @param integer $type			Loai banner (1->Banner Anh, 2->Banner Flash, 3->Banner HTML)
 * @param integer $active
 * @param integer $banner_id	ID banner
 * @param integer $ban_page	Page hien thi 0 -> All, 1 -> Trang chu, 2 -> Trang danh muc, 3 -> Trang season, 4 -> Trang chi tiet
 * @return
 */
function getBanner($list_position = 0, $type = 0, $active = 1, $banner_id = 0){

	$array_return	= array();
	$sqlWhere		= " 1";

	$banner_id		= intval($banner_id);
	if($banner_id > 0){
		$sqlWhere		.= " AND ban_id = " . $banner_id;
	}

	if($list_position != ""){
		$list_position		= convert_list_to_list_id($list_position);
		$sqlWhere	.= " AND ban_position IN(" . $list_position . ")";
	}

	$type				= intval($type);
	if($type > 0) $sqlWhere	.= " AND ban_type = " . $type;

	$active		= intval($active);
	if($active == 1 || $active == 0)	$sqlWhere	.= " AND ban_active = " . $active;

	$db_query	= new db_query("	SELECT *
											FROM banners
											WHERE " . $sqlWhere . "
											ORDER BY ban_order ASC, ban_id DESC",
											"File: " . __FILE__ . ". Line :" . __LINE__);
	while($row	= mysql_fetch_assoc($db_query->result)){
		if($row['ban_end_time'] == 0){
			// nếu là banner không set thời gian kết thúc
			$array_return[$row['ban_id']]	= $row;
		}else{
			// nếu banner đc set thời gian kết thúc thì kiểm tra điều kiện thời gian
			if($row['ban_end_time'] >= time()){
				$array_return[$row['ban_id']]	= $row;
			}
		}
	}
	unset($db_query);

	return $array_return;
}

function showBanner($arrBanner, $divId = 'box_banners'){
	echo '<ul class="box_banners" id="' . $divId . '">';
	foreach ($arrBanner as $key => $value) {
		echo '<li>';
		echo '<a href="' . $value['ban_link'] . '" target="' . $value['ban_target'] . '"><img src="' . PICTURE_PATH . 'banner/' . $value['ban_picture'] . '" alt="' . $value['ban_name'] . '" /></a>';
		echo '</li>';
	}
	echo '</ul>';
}

/**
 * [getMenu Function lay danh sach menu]
 * @param  integer $postion [vi tri menu 0: tat ca, 1: menu top, 2: menu footer]
 * @param  integer $active  [trang thai 1: active, 0: unactive, -1: tat ca]
 * @return [type]           [mang cac menu]
 */
function getMenu($postion = 0, $active = 1){
	$array_return 	= array();
	$sqlWhere 		= "";

	$postion 		= intval($postion);
	$active 			= intval($active);
	// Search theo vị trí
	if($postion > 0) $sqlWhere	.= " AND mnu_position = " . $postion;
	if($active >= 0) $sqlWhere	.= " AND mnu_active 	= " . $active;

	$query 		= "SELECT * FROM menus WHERE 1 " . $sqlWhere . " ORDER BY mnu_order ASC, mnu_id DESC";
	$db_query 	= new db_query($query);
	while ($row = mysql_fetch_assoc($db_query->result)){
		$array_return[$row['mnu_id']]	= $row;
	}
	unset($db_query);

	return $array_return;
}

function getArrayCatParentToShow($limit = 10){

	$array_return 	= array();
	$limit 	   = intval($limit);
	$query 		= "SELECT * FROM categories_multi
						WHERE cat_type = 'product' AND cat_active = 1 AND cat_show = 1 AND cat_parent_id = 0
						ORDER BY cat_order ASC, cat_id DESC
						LIMIT 0, " . $limit;
	$db_query 	= new db_query($query);
	while ($row = mysql_fetch_assoc($db_query->result)){
		$array_return[$row['cat_id']]	= $row;
	}
	unset($db_query);

	return $array_return;
}

/**
 * Hàm lấy thông tin của tintuc, có sử dụng memcache
 * getInfoCategory()
 *
 * @param mixed $cat
 * @return
 */
function getInfoCategory($iCat){
	global $config_memcache;
	global $memcached_store;

	$array_return 	= array();
	$iCat				= intval($iCat);
	$memcacheKey	= "arrCategoryInfo_" . $iCat;

	if($iCat <= 0) return $array_return;

	// Lấy từ memcache trước
	if($config_memcache == 1){
		if(!isset($memcached_store)) $memcached_store	= new memcached_store();
		$array_return	= $memcached_store->get($memcacheKey);
	}

	if(!$array_return){
		// Lấy từ db
		$db_query	= new db_query("	SELECT *
												FROM categories_multi
												WHERE cat_id = " . $iCat,
												"FILE: " . __FILE__ . ", LINE: " . __LINE__);
		if($row = mysql_fetch_assoc($db_query->result)){
			$array_return	= $row;

			if($config_memcache == 1){
				if(!isset($memcached_store)) $memcached_store	= new memcached_store();
				$memcached_store->set($memcacheKey, $array_return);
			}
		}
		$db_query->close();
		unset($db_query);
	}

	return $array_return;
}

	

function getListProduct($categoryID = 0, $nFilter = "", $start = 0, $limit = 0, $sqlWhere = "", $orderBy = "", $arrCondition = array()){
	$categoryID	= intval($categoryID);


	$start		= intval($start);
	if($start <= 0) $start = 0;
	if($limit <= 0) $limit = 0;
	$limit 		= intval($limit);
	$sqlWhere 	= replaceMQ($sqlWhere);
	$orderBy		= replaceMQ($orderBy);

	$arrayReturn	= array();
	if($categoryID > 0){
		$InfoCat		= getInfoCategory($categoryID);
		$listCat		= isset($InfoCat['cat_all_child']) ? convert_list_to_list_id($InfoCat['cat_all_child']) : $categoryID;
		print_r($listCat);
		$sqlWhere	.= " AND pro_category_id IN(" . $listCat . ")";
	}

	if(isset($arrCondition["getProductRelease"]) && $arrCondition["getProductRelease"] == 1) $sqlWhere	.= " AND pro_release = 1";
	else $sqlWhere	.= " AND pro_release = 0";

	$sqlWhere	.= " AND pro_notsale = 0";

	$sqlOrder 	= "";
	switch($nFilter){
		case "hot":
			$sqlOrder		= " ORDER BY pro_hot DESC, pro_order, pro_id DESC";
			break;
		case "view":
			$sqlOrder		= " ORDER BY ph_hit_count DESC, pro_order, pro_id DESC";
			break;
		case "cheep":
			$sqlOrder		= " ORDER BY pro_sale_price ASC, pro_order, pro_id DESC";
			break;
		case "buy":
			$sqlOrder		= " ORDER BY pro_total_buy DESC, pro_order, pro_id DESC";
			break;
		case 'noneorder':
			$sqlOrder		= "";
			break;
		default:
		case 'new':
			$sqlOrder		= " ORDER BY pro_id DESC, pro_date DESC";
			break;
		default:
			$sqlOrder		= " ORDER BY pro_order ASC, pro_id DESC";
			break;
	}

	// Gán lại sql order nếu truyền trực tiếp
	if($orderBy != "") $sqlOrder	= $orderBy;

	$sqlLimit 	= "";
	if($limit > 0) $sqlLimit	= " LIMIT " . $start . "," . $limit;

	$query	=	"SELECT *, product_vote.value as total_vote
					FROM products
					STRAIGHT_JOIN categories_multi ON(cat_id = pro_category_id)
					LEFT JOIN product_hits ON (pro_id = ph_product_id)
					LEFT JOIN product_vote ON (pro_id = p_id AND type='TOTAL_VOTE')
					WHERE pro_active = 1" . $sqlWhere . $sqlOrder . $sqlLimit;


	$db_query	= new db_query($query, "File: " . __FILE__ . ", Line: " . __LINE__, "USE_SLAVE");

	while($row	= mysql_fetch_assoc($db_query->result)){
		
		$arrayReturn[$row["pro_id"]] = $row;
	}

	$db_query->close();
	unset($db_query);

	return $arrayReturn;
}
function getinfovideo($iCat){
		global $config_memcache;
		global $memcached_store;

	$array_return 	= array();
	$iCat				= intval($iCat);
	$memcacheKey	= "arrCategoryInfo_" . $iCat;

	if($iCat <= 0) return $array_return;

	// Lấy từ memcache trước
	if($config_memcache == 1){
		if(!isset($memcached_store)) $memcached_store	= new memcached_store();
		$array_return	= $memcached_store->get($memcacheKey);
	}

	if(!$array_return){
		// Lấy từ db
		$db_query	= new db_query("	SELECT *
												FROM video_category
												WHERE vid_id = " . $iCat,
												"FILE: " . __FILE__ . ", LINE: " . __LINE__);
		if($row = mysql_fetch_assoc($db_query->result)){
			$array_return	= $row;
			


			if($config_memcache == 1){
				if(!isset($memcached_store)) $memcached_store	= new memcached_store();
				$memcached_store->set($memcacheKey, $array_return);
			}
		}
		$db_query->close();
		unset($db_query);
	}

	return $array_return;

	}
function getlistvideopro($categoryID = 0,$nFilter = "", $start = 0, $limit = 0, $sqlWhere = "", $orderBy = "", $arrCondition = array()){
		$categoryID	= intval($categoryID);


		$arrayReturn	= array();
		if($categoryID > 0){
			$InfoCat		= getinfovideo($categoryID);
			
			$listCat1='';
			$listCat1		= isset($InfoCat['vid_id']) ? convert_list_to_list_id($InfoCat['vid_id']) : $categoryID;
			

			
}
			$query = "SELECT * FROM video_product
				JOIN video_category ON(vid_id=video_cate)
				WHERE video_cate=".$listCat1;




	$db_query	= new db_query($query,"File: " . __FILE__ . ", Line: " . __LINE__, "USE_SLAVE");

	while($rows	= mysql_fetch_assoc($db_query->result)){
	
		$arrayReturn[$rows["video_id"]] = $rows;
		

	}

	$db_query->close();
	unset($db_query);

	return $arrayReturn;

}
/*function getvideoproduct(){
	$db_query	= new db_query("SELECT *
											FROM video_product
										
											ORDER BY video_id DESC",
											"File: " . __FILE__ . ". Line :" . __LINE__);
	while($row	= mysql_fetch_assoc($db_query->result)){
		$arrayReturn[$row["video_id"]] = $row;
	}
	$db_query->close();
	unset($db_query);

	return $arrayReturn;



}*/
function gethotproduct($categoryID = 0, $nFilter = "", $start = 0, $limit = 0, $sqlWhere = "", $orderBy = "", $arrCondition = array()){
	$categoryID	= intval($categoryID);
	$start		= intval($start);
	if($start <= 0) $start = 0;
	if($limit <= 0) $limit = 0;
	$limit 		= intval($limit);
	$sqlWhere 	= replaceMQ($sqlWhere);
	$orderBy		= replaceMQ($orderBy);

	$arrayReturn	= array();
	if($categoryID > 0){
		$InfoCat		= getInfoCategory($categoryID);
		$listCat		= isset($InfoCat['cat_all_child']) ? convert_list_to_list_id($InfoCat['cat_all_child']) : $categoryID;
		$sqlWhere	.= " AND pro_category_id IN(" . $listCat . ")";
	}

	if(isset($arrCondition["getProductRelease"]) && $arrCondition["getProductRelease"] == 1) $sqlWhere	.= " AND pro_release = 1";
	else $sqlWhere	.= " AND pro_release = 0";

	$sqlWhere	.= " AND pro_notsale = 0";

	$sqlOrder 	= "";
	switch($nFilter){
		case "hot":
			$sqlOrder		= " ORDER BY pro_hot DESC, pro_order, pro_id DESC";
			break;
		case "view":
			$sqlOrder		= " ORDER BY ph_hit_count DESC, pro_order, pro_id DESC";
			break;
		case "cheep":
			$sqlOrder		= " ORDER BY pro_sale_price ASC, pro_order, pro_id DESC";
			break;
		case "buy":
			$sqlOrder		= " ORDER BY pro_total_buy DESC, pro_order, pro_id DESC";
			break;
		case 'noneorder':
			$sqlOrder		= "";
			break;
		default:
		case 'new':
			$sqlOrder		= " ORDER BY pro_id DESC, pro_date DESC";
			break;
		default:
			$sqlOrder		= " ORDER BY pro_order ASC, pro_id DESC";
			break;
	}

	// Gán lại sql order nếu truyền trực tiếp
	if($orderBy != "") $sqlOrder	= $orderBy;

	$sqlLimit 	= "";
	if($limit > 0) $sqlLimit	= " LIMIT " . $start . "," . $limit;

	$query	=	"SELECT *, product_vote.value as total_vote
					FROM products
					STRAIGHT_JOIN categories_multi ON(cat_id = pro_category_id)
					LEFT JOIN product_hits ON (pro_id = ph_product_id)
					LEFT JOIN product_vote ON (pro_id = p_id AND type='TOTAL_VOTE')
					WHERE pro_hot = 1" . $sqlWhere . $sqlOrder . $sqlLimit;


	$db_query	= new db_query($query, "File: " . __FILE__ . ", Line: " . __LINE__, "USE_SLAVE");

	while($row	= mysql_fetch_assoc($db_query->result)){
		$arrayReturnhot[$row["pro_id"]] = $row;
	}

	$db_query->close();
	unset($db_query);

	return $arrayReturnhot;


}

/**
 *
 */
function getInfoProduct($productId){
	$productId		= intval($productId);
	$arrayReturn 	= array();
	if($productId <= 0) return $arrayReturn;

	$query 		= "SELECT * FROM products
						STRAIGHT_JOIN categories_multi ON(cat_id = pro_category_id)
						LEFT JOIN product_hits ON ( pro_id = ph_product_id )
						WHERE pro_id = " . intval($productId);
	if($productId >= 50000000){
		$query 		= "SELECT * FROM product_size_color
							STRAIGHT_JOIN products ON ( pro_id = psc_product_id )
							STRAIGHT_JOIN categories_multi ON(cat_id = pro_category_id)
							LEFT JOIN product_hits ON ( pro_id = ph_product_id )
							WHERE psc_product_size_color_id = " . intval($productId);
	}
	$db_query 	= new db_query($query);
	if($row = mysql_fetch_assoc($db_query->result)){
		$arrayReturn	= $row;
	}
	$db_query->close();
	unset($db_query);

	// Có dữ liệu thì lấy thêm lượng vote
	if($arrayReturn){
		$db_query 	= new db_query("SELECT * FROM product_vote WHERE p_id = " . $productId);
		while($row = mysql_fetch_assoc($db_query->result)){
			$arrayReturn[$row["type"]]	= $row;
		}
		$db_query->close();
		unset($db_query);
	}

	return $arrayReturn;
}
function getvideoproduct($videoID){
		$videoID		= intval($videoID);
		$arrayReturn 	= array();
		if($videoID <= 0) return $arrayReturn;
			$query 		= "SELECT * FROM video_product
						 JOIN video_category ON(vid_id = video_cate)
						
						WHERE video_id = " . intval($videoID);
			$db_query 	= new db_query($query);
			if($row = mysql_fetch_assoc($db_query->result)){
				$arrayReturn	= $row;
				
			}
				$db_query->close();
				unset($db_query);	
				return $arrayReturn;		
			
	}

function addtocart($pro_id){
$return	= 0;
		if($quantity > 10){
			$quantity	= 10;
		}

		// Kiểm tra SP này đã có trong giỏ hàng hay chưa, có rồi return luôn
		//if($this->check_product_incart($pro_id)) return 1;

		if($quantity > 0){

			$this->current_cart[$pro_id]['quantity']	= $quantity;
			//Save cookie
			$this->saveCookie();
			$return	= 1;
		}

		return $return;
}

function getInfoNew($newId){
	$newId			= intval($newId);
	$arrayReturn	= array();
	if($newId <= 0) return $arrayReturn;

	$query 		= "SELECT *
						FROM news_multi
						WHERE new_active= 1 AND new_id = " . intval($newId);
	$db_query	= new db_query($query);
	if($row = mysql_fetch_assoc($db_query->result)){
		$arrayReturn	= $row;
	}
	$db_query->close();
	unset($db_query);

	return $arrayReturn;
}

function getImageProduct($namePicture = "", $type = ""){
	$urlImage 	= "";
	if($namePicture == "") return $urlImage;

	$urlImage 	= IMAGE_PATH;
	switch ($type) {
		case 'medium':
			$urlImage	.= "medium/medium_" . $namePicture;
			break;

		case 'small':
			$urlImage	.= "small/small_" . $namePicture;
			break;

		case '':
			$urlImage 	.= $namePicture;
			break;

		default:
			if(file_exists(".." . $urlImage . $namePicture)) $urlImage	= "/" . $type . $urlImage . $namePicture;
			else $urlImage 	.= $namePicture;
			break;
	}

	return $urlImage;
}

function getImageNew($namePicture = "", $type = ""){
	$urlImage 	= "";
	if($namePicture == "") return $urlImage;

	$urlImage 	= PICTURE_PATH . 'new/';
	switch ($type) {
		case 'medium':
			$urlImage	.= "medium/medium_" . $namePicture;
			break;

		case 'small':
			$urlImage	.= "small/small_" . $namePicture;
			break;

		case '':
			$urlImage 	.= $namePicture;
			break;

		default:
			if(file_exists(".." . $urlImage . $namePicture)) $urlImage	= "/slir/" . $type . $urlImage . $namePicture;
			else $urlImage 	.= $namePicture;
			break;
	}

	return $urlImage;
}

function getimagesvideo($namePicture = "", $type = ""){
	$urlImage 	= "";
	if($namePicture == "") return $urlImage;

	$urlImage 	= PICTURE_PATH . 'gallery/';
	switch ($type) {
		case 'medium':
			$urlImage	.= "medium/medium_" . $namePicture;
			break;

		case 'small':
			$urlImage	.= "small/small_" . $namePicture;
			break;

		case '':
			$urlImage 	.= $namePicture;
			break;

		default:
			if(file_exists(".." . $urlImage . $namePicture)) $urlImage	= "/slir/" . $type . $urlImage . $namePicture;
			else $urlImage 	.= $namePicture;
			break;
	}

	return $urlImage;
}


function showListProduct($arrayData = array(), $classAdd = "", $type="home", $showProType2 = 0){

	global $arrayListProductUserLike;
	$htmlReturn 	= "";
	if(!isset($arrayData['pro_id'])) return $htmlReturn;
	$arrayData['pro_type_show'] = 0;

	$linkProduct 	= createlink("product", array("iData" => $arrayData['pro_id'], "nTitle" => $arrayData['pro_short_name']));
	$htmlReturn .= '<div class="product_detail product_show_' . $arrayData['pro_type_show'] . ' ' . $classAdd . '">';
	$htmlReturn .= '<div class="product_detail_content">';

	// Lấy ảnh sản phẩm
	$url_image 		= getImageProduct($arrayData['pro_picture']);

	// TH kiểu show 2 thì lấy ảnh banner
	if($arrayData['pro_type_show'] == 1 && $showProType2 == 1)  $url_image 	= getImageProduct($arrayData['pro_banner']);

	// Show ảnh nào
	$htmlReturn .= '<div class="product_image">
							<a href="' . $linkProduct . '" title="' . $arrayData['pro_short_name'] . '">
								<img alt="' . $arrayData['pro_short_name'] . '" src="' . $url_image . '" />
							</a>
						</div>';
	$price_show 	= ($arrayData['pro_sale_prices'] > 0) ? '<span class="price">' . formatCurrency($arrayData['pro_sale_prices']) .'</span>&nbsp;<span class="unit">vnđ</span>' : '<span>Liên hệ</span>';
	$name_show		= $arrayData['pro_short_name'];

	// Show tên giá nào
	$htmlReturn .= '<div class="product_info">';
	if($type == "tintuc"){
		$htmlReturn .= '<p class="product_name">
								<a href="' . $linkProduct . '" title="' . $arrayData['pro_short_name'] . '">' . $arrayData['pro_short_name'] . '</a>
							</p>
							<p class="product_price">Giá: ' . $price_show . '</p>
							<div class="clear"></div>';
	}else{
		$htmlReturn .= '<p class="product_name">
								<a href="' . $linkProduct . '" title="' . $arrayData['pro_short_name'] . '">' . cut_string($arrayData['pro_short_name'], 20) . '</a>
							</p>
							<p class="product_price">' . $price_show  . '</p>
							<p class="product_quantity"><i>Trong kho: Còn hàng</i></p>
							<div class="clear"></div>';
	}
	// Phần các tag
	$htmlReturn .= '<div class="list_tag">';
	if($arrayData['pro_hot'] == 1) $htmlReturn	.= '<i class="tag_hot"></i>';
	if($arrayData['pro_sale'] == 1) $htmlReturn	.= '<i class="tag_sale"></i>';
	if($arrayData['pro_deal'] == 1) $htmlReturn	.= '<i class="tag_deal"></i>';
	if($arrayData['pro_new'] == 1) $htmlReturn	.= '<i class="tag_new"></i>';
	$htmlReturn	.= '</div>';

	// Phần giá tốt or bán chạy
	if($arrayData['pro_giatot'] == 1) $htmlReturn	.= '<i class="tag_giatot"></i>';
	if($arrayData['pro_banchay'] == 1) $htmlReturn	.= '<i class="tag_banchay"></i>';
	$htmlReturn	.= '</div>';
	$htmlReturn	.= '<div class="clear"></div>';

	$htmlReturn	.= '</div>';
	$htmlReturn	.= '</div>';
	return $htmlReturn;
}

function showListProductMobile($arrayData = array(), $classAdd = ""){

	global $arrayListProductUserLike;
	$htmlReturn 	= "";
	if(!isset($arrayData['pro_id'])) return $htmlReturn;

	$linkProduct 	= createlink("product", array("iData" => $arrayData['pro_id'], "nTitle" => $arrayData['pro_short_name']));
	$htmlReturn .= '<div class="product_detail product_show_' . $arrayData['pro_type_show'] . ' ' . $classAdd . ' fl">';
	$htmlReturn .= '<div class="product_detail_content">';

	// Lấy ảnh sản phẩm
	$url_image 		= getImageProduct($arrayData['pro_picture'], "h150");
	if($arrayData['pro_picture_mob'] != "") $url_image 		= getImageProduct($arrayData['pro_picture_mob'], "100");

	// Show ảnh nào
	$htmlReturn .= '<div class="product_image">
							<a href="' . $linkProduct . '" title="' . $arrayData['pro_short_name'] . '">
								<img alt="' . $arrayData['pro_short_name'] . '" src="' . $url_image . '" />
							</a>
						</div>';

	$price_show 	= $arrayData['pro_sale_prices'];
	$name_show		= $arrayData['pro_short_name'];
	if(LOCATION == 'HN' && $arrayData['pro_sale_price_hn'] > 0) $price_show 	= $arrayData['pro_sale_price_hn'];
	if(LOCATION == 'HCM' && $arrayData['pro_sale_price_hcm'] > 0) $price_show 	= $arrayData['pro_sale_price_hcm'];
	if(LOCATION == 'HN' && $arrayData['pro_name_hn'] != "") $name_show 	= $arrayData['pro_name_hn'];
	if(LOCATION == 'HCM' && $arrayData['pro_name_hcm'] != "") $name_show 	= $arrayData['pro_name_hcm'];

	// Show tên giá nào
	$htmlReturn .= '<div class="product_info">';
	$htmlReturn .= '<p class="product_name">
							<a href="' . $linkProduct . '" title="' . $arrayData['pro_short_name'] . '">' . $arrayData['pro_short_name'] . '</a>
							<div>' . $name_show . '</div>
						</p>
						<p class="product_price">Giá: <span class="price">' . formatCurrency($price_show) . '</span>&nbsp;<span class="unit">vnđ</span></p>
						<div class="clear"></div>';

	$htmlReturn	.= '</div>';
	$htmlReturn	.= '<div class="clear"></div>';

	$htmlReturn	.= '</div>';
	$htmlReturn	.= '</div>';
	return $htmlReturn;
}

function showListProductMobile_v2($arrayData = array()){

	$htmlReturn 	= "";
	if(!isset($arrayData['pro_id'])) return $htmlReturn;

	$linkProduct 	= createlink("product", array("iData" => $arrayData['pro_id'], "nTitle" => $arrayData['pro_short_name']));

	$htmlReturn .= '<div class="item">';
	$htmlReturn .= '<div class="p_detail">';
	$htmlReturn .= '<div class="p_detail_content">';

	// Lấy ảnh sản phẩm
	$url_image 		= getImageProduct($arrayData['pro_picture'], "h250");
	if($arrayData['pro_picture_mob'] != "") $url_image 		= getImageProduct($arrayData['pro_picture_mob'], "100");

	// Show ảnh nào
	$htmlReturn .= '<div class="p_picture">
							<a href="' . $linkProduct . '" title="' . $arrayData['pro_short_name'] . '">
								<img alt="' . $arrayData['pro_short_name'] . '" src="' . $url_image . '" />
							</a>
						</div>';
	if($arrayData['pro_sale_prices'] > 0){
		$price_show 	= 'Giá: <span class="price">' . formatCurrency($arrayData['pro_sale_prices']) .'</span>&nbsp;<span class="unit">đ</span>';	
	}else{
		$price_show 	= '<span class="price">Liên hệ</span>';
	}
	

	$name_show		= $arrayData['pro_short_name'];
	if(LOCATION == 'HN' && $arrayData['pro_sale_price_hn'] > 0) $price_show 	= $arrayData['pro_sale_price_hn'];
	if(LOCATION == 'HCM' && $arrayData['pro_sale_price_hcm'] > 0) $price_show 	= $arrayData['pro_sale_price_hcm'];
	if(LOCATION == 'HN' && $arrayData['pro_name_hn'] != "") $name_show 	= $arrayData['pro_name_hn'];
	if(LOCATION == 'HCM' && $arrayData['pro_name_hcm'] != "") $name_show 	= $arrayData['pro_name_hcm'];

	// Show tên giá nào
	$htmlReturn .= '<div class="p_info">';
	$htmlReturn .= '<p class="p_name">
							<a href="' . $linkProduct . '" title="' . $arrayData['pro_short_name'] . '">' . $arrayData['pro_short_name'] . '</a>
							<div class="tab_price">' . $name_show . '</div>
						</p>
						<p class="p_price">' . $price_show . '</p>
						<div class="clear"></div>';

	$htmlReturn	.= '</div>';
	$htmlReturn	.= '<div class="clear"></div>';

	$htmlReturn	.= '</div>';
	$htmlReturn	.= '</div>';
	$htmlReturn	.= '</div>';

	return $htmlReturn;
}
/**
 * Lay danh sach cac nut cha -> tra ve mang gom id, name theo dung thu tu den cap cao nhat
 * menu::getAllParent_v2()
 *
 * @param mixed $table_name
 * @param mixed $id_field
 * @param mixed $parent_id_field
 * @param mixed $id					: ID danh muc
 * @return
 */
function getAllParent_v2($table_name,$id_field,$parent_id_field, $list_field, $id){
	global $config_memcache;
	if(!isset($config_memcache)) $config_memcache	= 0;

	$array_return		= array();

	$id					= intval($id);
	if($array_return){
		return $array_return;
	}

	$finish			= false;
	$current_id 	= $id;
	while (!$finish){
		$db_getparent = new db_query ("SELECT " . $parent_id_field . ", ". $list_field . " " .
												"FROM " . $table_name . " " .
												"WHERE " . $id_field . "=" . $current_id,
												"File:" . __FILE__ . ", LINE : " . __LINE__, "USE_SLAVE");
		if($row = mysql_fetch_array($db_getparent->result)){
			$array_return[$current_id]	= $row;
			$current_id 					= $row[$parent_id_field];
		}
		else{
			$finish	= true;
		}
		unset($db_getparent);
	}

	return $array_return;
}

/**
 * Function delete thông tin khi user dislike một sản phẩm. Lưu theo PRODUCT
 * like_product_2_user()
 *
 * @param mixed $user_id
 * @param mixed $product_id
 * @return
 */
function dislikeProduct($user_id, $product_id){

	$table_name		= "like_product";
	$msg				= "";
	$code				= 0;
	$array_return	= array("msg" => $msg, "code" => $code);

	if($user_id <= 0){
		$array_return["msg"]	= translate("Vui lòng đăng nhập để thực hiện chức năng này");
		return $array_return;
	}

	$msg	= translate("Thông tin không hợp lệ");
	if($product_id > 0){

		/** Kiểm tra user này đã like deal này chưa */
		$db_delete	= new db_execute("DELETE FROM " . $table_name . "
												WHERE lpr_product_id = " . $product_id . " AND lpr_user_id = " . $user_id, 1);

		if($db_delete->msgbox > 0){
			$msg	= translate("Bạn đã bỏ thích");
			$code	= 1;
		}else{
			$msg	= translate("Xảy ra lỗi. Vui lòng thử lại sau");
		}
	}

	$array_return['msg']		= $msg;
	$array_return['code']	= $code;

	return $array_return;
}

/**
 * Function insert thông tin khi user like một sản phẩm. Lưu theo PRODUCT
 * like_product_2_user()
 *
 * @param mixed $user_id
 * @param mixed $product_id
 * @return
 */
function likeProduct($user_id, $product_id){

	$table_name		= "like_product";
	$msg				= "";
	$code				= 0;
	$array_return	= array("msg" => $msg, "code" => $code);

	if($user_id <= 0){
		$array_return["msg"]	= translate("Vui lòng đăng nhập để thực hiện chức năng này");
		return $array_return;
	}

	$msg	= translate("Thông tin không hợp lệ");
	if($product_id > 0){
		// Kiểm tra có tồn tại Deal này không
		$db_query	= new db_query("SELECT pro_id FROM products WHERE pro_id = " . $product_id, __FILE__, "USE_SLAVE");
		if($row	= mysql_fetch_assoc($db_query->result)){
			/** Kiểm tra user này đã like deal này chưa */
			$db_check	= new db_query("	SELECT * FROM " . $table_name . "
													WHERE lpr_user_id = " . $user_id . " AND lpr_product_id = " . $product_id
													);
			if($row_check	= mysql_fetch_assoc($db_check->result)){
				$msg	= translate("Bạn đã Like sản phẩm này");
			}else{
				// Insert data
				$db_insert	= new db_execute("INSERT INTO " . $table_name . " (lpr_product_id, lpr_user_id, lpr_date)
														VALUES(" . $product_id . ", " . $user_id . ", " . time() . ")", 1);

				if($db_insert->msgbox > 0){
					$msg	= translate("Bạn thích sản phẩm này");
					$code	= 1;
				}else{
					$msg	= translate("Xảy ra lỗi. Vui lòng thử lại sau");
				}
			}
			unset($db_check);
		}
	}

	$array_return['msg']		= $msg;
	$array_return['code']	= $code;

	return $array_return;
}

function getTypeBuy(){
	return array(	1 => "Đặt mua, giao hàng tận nơi",
						2 => "Mua trả góp",
						3 => "Giao nhanh",
						4 => "Đặt hàng trước");
}



/**
 *
 */
function addCommentProduct($product_id, $user_email, $user_name = "", $user_avatar = "", $comment = "", $parent_id = 0){

	$array_return 	= array("data" => 0, "msg" => "");
	$product_id 	= intval($product_id);
	$parent_id 		= intval($parent_id);
	$user_email 	= replaceMQ($user_email);
	$user_name 		= replaceMQ($user_name);
	$user_avatar 	= replaceMQ($user_avatar);
	$comment 		= replaceMQ($comment);

	if($comment == ""){
		$array_return['msg']	= "Thiếu thông tin đánh gía";
		return $array_return;
	}

	if($product_id <= 0 || $user_email == ""){
		$array_return['msg']	= "Thiếu thông tin sản phẩm, users";
		return $array_return;
	}

	// Lấy thông tin sản phẩm
	$db_query 	= new db_query("SELECT pro_id FROM products WHERE pro_id = " . $product_id . " LIMIT 0, 1");
	if($row = mysql_fetch_assoc($db_query->result)){
		// Nếu có comment cha
		if($parent_id > 0){
			$db_check 	= new db_query("SELECT * FROM product_comments WHERE prc_id = " . $parent_id);
			if(mysql_num_rows($db_check->result) <= 0){
				$array_return['msg']	= "Không có đánh giá chính";
				return $array_return;
			}
			$db_check->close();
			unset($db_check);
		}
		// Insert nào
		$db_execute 	= new db_execute_return();
		$last_id 		= $db_execute->db_execute("INSERT INTO product_comments (prc_product_id, prc_teaser, prc_email, prc_full_name, prc_avatar, prc_parent_id, prc_active, prc_date)
															VALUES(" . $product_id . ", '" . $comment . "', '" . $user_email . "', '" . $user_name . "', '" . $user_avatar . "', " . $parent_id . ", -1, " . time() . ")");
		if($last_id > 0){
			$array_return['data'] = $last_id;
		}else{
			$array_return['msg'] = "Xảy ra lỗi khi thêm mới. Vui lòng thử lại sau";
		}
		unset($db_execute);
	}else{
		$array_return['msg']	= "Không tồn tại sản phẩm trên hệ thống";
	}
	$db_query->close();
	unset($db_query);

	return $array_return;
}

function show_car_item($product_info = array() ){

	$html = '';
	if(count($product_info) <= 0) return $html;


	//link sản phẩm
	$linkProduct 	= createlink("product", array("iData" => $product_info['pro_id'], "nTitle" => $product_info['pro_short_name']));

	// Lấy ảnh sản phẩm
	$url_image 		= getImageProduct($product_info['pro_picture'], "h270");
	 
	$html .= '<div class="item_info"> 
					<a href="' .$linkProduct.'">
						<div class="item_img">
							<img src="' . $url_image . '" alt="'. $product_info['pro_short_name']. '">
						</div>
						<p class="item_name"> ' . $product_info['pro_short_name']. ' </p>
					</a>
				</div>';
	
	return $html;	 
}

function get_tags($record_id = 0, $type = ''){
	$return = array();

	if($record_id > 0){

		switch ($type) {
			case 'news':
				$sql_query = "SELECT tag_id, tag_text 
								  FROM tag_news  JOIN tags ON tagn_tag_id = tag_id 
								  WHERE tagn_news_id = " . $record_id . "
								  ORDER BY tag_id DESC LIMIT 12 ";
				break;
			
			default:
				$sql_query = "SELECT tag_id, tag_text 
								  FROM tag_products  JOIN tags ON tap_tag_id = tag_id 
								  WHERE tap_product_id = " .$record_id . "
								  ORDER BY tag_id DESC LIMIT 12 ";
				break;
		}

	}else{
		$sql_query = "SELECT * FROM tags WHERE tag_active = 1 ORDER BY tag_id DESC LIMIT 12 "; 
	}
	 
	// Query trong bản tag lấy ra 
	$db_query = new db_query($sql_query);

	while ($row = mysql_fetch_assoc($db_query->result)) {
		$return[$row['tag_id']] = $row['tag_text'];
	}
	unset($db_query);

	return $return;
}


?>