<?
include("inc_security.php");

$class_menu	= new menu;
$arrayHeaderMenu	= $class_menu->getAllChild("categories_multi","cat_id","cat_parent_id", 0, "1","cat_id, cat_name , cat_has_child","cat_order ASC",0,1,0);

// Lặp từ trên xuống dưới để lấy các cat con( dựa vào level)
for($i = 0; $i < count($arrayHeaderMenu) ; $i++){
	$listid	= $arrayHeaderMenu[$i]['cat_id']; // Lấy id của chính nó
	// Lặp các danh mục tiếp theo nếu level của danh mục tiếp theo lớn hơn thì đấy chính là cấp con

	for($j = $i + 1; $j < count($arrayHeaderMenu); $j++){
		if($arrayHeaderMenu[$j]['level'] > $arrayHeaderMenu[$i]['level']){
			$listid	.= ", " . $arrayHeaderMenu[$j]['cat_id'];
		}else{
			// Đã hết cấp con
			break;
		}
	}
	$listid	= convert_list_to_list_id($listid);
	// Cập nhật database
	$db_update	= new db_execute("UPDATE categories_multi SET cat_all_child = '" . $listid . "' WHERE cat_id = " . intval($arrayHeaderMenu[$i]['cat_id']));
	unset($db_update);
}

echo "Refresh thành công";
?>