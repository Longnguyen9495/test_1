<?
function seo_category($id=0){
	$catname = '';
	$db_name = new db_query("SELECT cat_name FROM categories_multi WHERE cat_id = " . $id);
	if($row = mysql_fetch_assoc($db_name->result)){
		$catname = $row["cat_name"];
		unset($db_name);
	}else{
		return '';
	}
	$catname = removeTitle($catname,"-");
	$catname = strtolower($catname);
	$catname = str_replace("-","",$catname);
	$db_check = new db_query("SELECT cat_id FROM categories_multi WHERE cat_rewrite = '" . $catname . "' AND cat_id <> " . $id);
	if($row = mysql_fetch_assoc($db_check->result)){
		$catname = $catname . "-" . $id;
	}
	$db_ex = new db_execute("UPDATE categories_multi SET cat_rewrite = '" . $catname . "',cat_md5='" . md5($catname) . "' WHERE cat_id = " . $id);
	unset($db_ex);
	return $catname;
}
function seo_city($id=0){
	$catname = '';
	$db_name = new db_query("SELECT cit_name FROM city WHERE cit_id = " . $id);
	if($row = mysql_fetch_assoc($db_name->result)){
		$catname = $row["cit_name"];
		unset($db_name);
	}else{
		return '';
	}
	$catname = removeTitle($catname,"-");
	$catname = strtolower($catname);
	$catname = str_replace("-","",$catname);
	$db_check = new db_query("SELECT cit_id FROM city WHERE cit_rewrite = '" . $catname . "' AND cit_id <> " . $id);
	if($row = mysql_fetch_assoc($db_check->result)){
		$catname = $catname . "-" . $id;
	}
	$db_ex = new db_execute("UPDATE city SET cit_rewrite = '" . $catname . "',cit_md5='" . md5($catname) . "' WHERE cit_id = " . $id);
	unset($db_ex);
	return $catname;
}
function seo_product($id=0){
	$catname = '';
	$db_name = new db_query("SELECT pro_name FROM products WHERE pro_id = " . $id);
	if($row = mysql_fetch_assoc($db_name->result)){
		$catname = $row["pro_name"];
		unset($db_name);
	}else{
		return '';
	}
	$catname = removeTitle($catname,"-");
	$catname = strtolower($catname);
	$catname 	=  preg_replace("/-[a-z0-9]-/i","-",$catname);
	$catname 	=  preg_replace("/-[a-z0-9]-/i","-",$catname);

	$db_check = new db_query("SELECT pro_id FROM products WHERE pro_rewrite = '" . $catname . "' AND pro_id <> " . $id);
	if($row = mysql_fetch_assoc($db_check->result)){
		$catname = $catname . "-" . $id;
	}
	$db_ex = new db_execute("UPDATE products SET pro_rewrite = '" . $catname . "',pro_md5='" . md5($catname) . "' WHERE pro_id = " . $id);
	unset($db_ex);
	return $catname;
}
?>