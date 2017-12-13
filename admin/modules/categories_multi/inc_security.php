<?
$module_id 	= 35;

$fs_table			= "categories_multi";
$field_id			= "cat_id";
$field_name			= "cat_name";
$titleSEO			= 'cat_name';
$rewriteSEO			= 'cat_rewrite';
$md5SEO				= 'cat_md5';
$fs_filepath		= '../../../data/category/';
$extension_list 	= 'jpg,gif,swf,jpeg,png';
$limit_size			= 300000;

//check security...
require_once("../../resource/security/security.php");
checkLogged();
if (checkAccessModule($module_id) != 1){
	header("location: ../deny.htm");
	exit();
}
$array_value 		= array(
							'static'		=> translate_text('Trang tĩnh'),
							'news'		=> translate_text('Tin tức'),
							'product'	=> translate_text('Sản phẩm'),
							'gioithieu'	=> translate_text('Giới thiệu'),
							'phukien'	=> translate_text('Phụ kiện'),
							'giaiphap'	=> translate_text('Giải pháp'),
							'tuvan'		=> translate_text('Hỏi đáp')
							);
$array_config		= array("image" => 1, "upper" => 1, "order" => 1, "teaser" => 0, "description" => 0);

function resetAllChild($module = 'product'){
	$class_menu	= new menu;
	$arrayHeaderMenu	= $class_menu->getAllChild("categories_multi","cat_id","cat_parent_id", 0, "cat_type = '" . $module . "'","cat_id, cat_name , cat_has_child","cat_order ASC",0,1,0);

	// Lặp từ trên xuống dưới để lấy các cat con( dựa vào level)
	for($i = 0; $i < count($arrayHeaderMenu) ; $i++){
		$listid	= $arrayHeaderMenu[$i]['cat_id']; // Lấy id của chính nó
		// Lặp các danh mục tiếp theo nếu level của danh mục tiếp theo lớn hơn thì đấy chính là cấp con
		$cat_has_child = 0;
		for($j = $i + 1; $j < count($arrayHeaderMenu); $j++){
			if($arrayHeaderMenu[$j]['level'] > $arrayHeaderMenu[$i]['level']){
				$listid	.= ", " . $arrayHeaderMenu[$j]['cat_id'];
				$cat_has_child = 1;
			}else{
				// Đã hết cấp con
				break;
			}
		}
		$listid	= convert_list_to_list_id($listid);
		// Cập nhật database
		$db_update	= new db_execute("UPDATE categories_multi SET cat_has_child = " . $cat_has_child . ", cat_all_child = '" . $listid . "' WHERE cat_id = " . intval($arrayHeaderMenu[$i]['cat_id']));
		unset($db_update);
	}
}

?>