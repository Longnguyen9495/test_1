<?
/*
Hàm tạo link
*/
function createlink($module = "", $row = array()){
	$strlink = '';
	switch($module){
		case "category":
			$strlink = ROOT_PATH . 'category/' . removeTitle($row["nTitle"]) . '-id' . $row["iCat"];
			break;

		case "manufacture":
			$strlink = ROOT_PATH . 'manufacturers/' . removeTitle($row["nTitle"]) . '-id' . $row["iData"];
			break;
			case 'hang':
				$strlink = ROOT_PATH . 'hang/' . removeTitle($row["nTitle"]) . '-id' . $row["iData"];
				break;
		case "product":
			$strlink = ROOT_PATH . 'detail/product/' . removeTitle($row["nTitle"]) . '-id' . $row["iData"];
			break;
			case "foroto":
			$strlink = ROOT_PATH . 'detail/foroto/' . removeTitle($row["nTitle"]) . '-id' . $row["iData"];
			break;

			case "video":
			$strlink = ROOT_PATH . 'detail/video/'. removeTitle($row["nTitle"]) . '-id' . $row["iData"];
			break;
			case "category_cat":
			if(isset($row["iData"]) && $row["iData"] > 0){
				$strlink = ROOT_PATH . 'categoryvideo/cat/' . removeTitle($row["nTitle"]) . '/' . $row["iData"];
			}
			else{
				$strlink = ROOT_PATH . 'categoryvideo/';
			}
			break;


			case "addtocart":
			$strlink = ROOT_PATH . 'addtocart/' . removeTitle($row["nTitle"]) . '-id' . $row["iData"];
			break;
			case "giohang":
			$strlink = ROOT_PATH . 'giohang/' . removeTitle($row["nTitle"]) . '-id' . $row["iData"];
			break;
			case "muahang":
			$strlink = ROOT_PATH . 'muahang/' . removeTitle($row["nTitle"]) . '-id' . $row["iData"];
			break;
			case "delete":
			$strlink = ROOT_PATH . 'delete/' . removeTitle($row["nTitle"]) . '-id' . $row["iData"];
			break;
		case "news":
			$strlink = ROOT_PATH . 'detail/news/' . removeTitle($row["nTitle"]) . '-id' . $row["iData"];
			break;
		case 'fornews':
				$strlink = ROOT_PATH . 'detail/fornews/' . removeTitle($row["nTitle"]) . '-id' . $row["iData"];
			break;
			
		case "news_cat":
			if(isset($row["iData"]) && $row["iData"] > 0){
				$strlink = ROOT_PATH . 'news/cat/' . removeTitle($row["nTitle"]) . '/' . $row["iData"];
			}
			else{
				$strlink = ROOT_PATH . 'news/';
			}
			break;
			
		case "static":
			$strlink = ROOT_PATH . 'detail/static/' . removeTitle($row["nTitle"]) . '-id' . $row["iData"];
			break;
		case "gallery":
			$strlink = ROOT_PATH . 'show/' . removeTitle($row["gal_title"]) . '-id' . $row["gal_id"];
			break;	
	}

    return $strlink;
}

/*
ham remove de rewrite
*/
function removeTitle($string,$keyReplace = "/"){
	$string	=	removeAccent($string);
	$string 	=  trim(preg_replace("/[^A-Za-z0-9]/i"," ",$string)); // khong dau
	$string 	=  str_replace(" ","-",$string);
	$string	=	str_replace("--","-",$string);
	$string	=	str_replace("--","-",$string);
	$string	=	str_replace("--","-",$string);
	$string	=	str_replace("--","-",$string);
	$string	=	str_replace("--","-",$string);
	$string	=	str_replace("--","-",$string);
	$string	=	str_replace("--","-",$string);
	$string	=	str_replace($keyReplace,"-",$string);
	return strtolower($string);
}

/*
Function generate module url
*/
function generate_module_url($module){
	global $con_mod_rewrite;
	if($con_mod_rewrite == 0){
		$link	= lang_path() . "module.php?module=" . $module;
	}
	else{
		$link	= lang_path() . $module . ".html";
	}
	return $link;
}


/*
Function generate country destination
*/
function generate_country_destination_url($nCou){
	global $con_mod_rewrite;
	$nCou	= urlencode($nCou);
	if($con_mod_rewrite == 0){
		$link	= lang_path() . "module.php?module=Destiantion&nCou=" . $nCou;
	}
	else{
		$link	= lang_path() . "Destination/" . $nCou . ".html";
	}
	return $link;
}


/*
Function generate type url
*/
function generate_type_url($nCat, $iCat){
	global $con_mod_rewrite;
	$nCat		= replace_rewrite_url($nCat, "_");
	if($con_mod_rewrite == 0){
		$link	= lang_path() . "type.php?iCat=" . $iCat;
	}
	else{
		$link	= lang_path() . $nCat . "/" . $iCat . ".html";
	}
	return $link;
}


/*
Function generate detail url
*/
function generate_detail_url($module, $nCat, $nData, $iData){
	global $con_mod_rewrite;
	$nCat		= replace_rewrite_url($nCat, "_");
	$nData	= replace_rewrite_url($nData, "-");
	switch($module){
		case "news":
			$file = "detail_news.php";
			$ext	= ".html";
			break;
		case "culture":
			$file = "detail_culture.php";
			$ext	= ".chtml";
			break;
		case "static":
			$file	= "detail_static.php";
			$ext	= ".shtml";
			break;
	}
	$link = lang_path();
	if($con_mod_rewrite == 0){
		$link	.= $file . "?iData=" . $iData;
	}
	else{
		if($module == "static") $link	.= $nData . "/" . $iData . $ext;
		else $link .= $nCat . "/" . $nData . "/" . $iData . $ext;
	}
	return $link;
}


/*
Function generate detail tour url
*/
function generate_detail_tour_url($nCou, $nTs, $nData, $nTab=""){
	global $con_mod_rewrite;
	$nCou		= replace_rewrite_url($nCou, "_");
	$nTs		= replace_rewrite_url($nTs, "_");
	$nData	= replace_rewrite_url($nData, "-");
	$nTab		= replace_rewrite_url($nTab, "-");

	$link		= lang_path();
	if($con_mod_rewrite == 0){
		$link	.= "detail_tour.php?nData=" . $nData;
		if($nTab != "") $link .= "&nTab=" . $nTab;
	}
	else{
		if($nTab != "") $link .= $nCou . "/" . $nTs . "/" . $nData . "/" . $nTab . ".thtml";
		else $link .= $nCou . "/" . $nTs . "/" . $nData . ".thtml";
	}
	return $link;
}


/*
Function generate detail hotel url
*/
function generate_detail_hotel_url($nCou, $nCity, $nData, $nTab=""){
	global $con_mod_rewrite;
	$nCou		= replace_rewrite_url($nCou, "_");
	$nCity	= replace_rewrite_url($nCity, "_");
	$nData	= replace_rewrite_url($nData, "-");
	$nTab		= replace_rewrite_url($nTab, "-");

	$link		= lang_path();
	if($con_mod_rewrite == 0){
		$link	.= "detail_hotel.php?nData=" . $nData;
		if($nTab != "") $link .= "&nTab=" . $nTab;
	}
	else{
		if($nTab != "") $link .= $nCou . "/" . $nCity . "/" . $nData . "/" . $nTab . ".hhtml";
		else $link .= $nCou . "/" . $nCity . "/" . $nData . ".hhtml";
	}
	return $link;
}


/*
Function replace rewrite url
*/
function replace_rewrite_url($string, $rc="-", $urlencode=1){
	//$string	= mb_strtolower($string, "UTF-8");
	$string	= removeAccent($string);
	$string	= preg_replace('/[^A-Za-z0-9]+/', ' ', $string);
	$string	= str_replace("   ", " ", trim($string));
	$string	= str_replace("  ", " ", trim($string));
	$string	= str_replace(" ", $rc, $string);
	$string	= str_replace($rc . $rc, $rc, $string);
	$string	= str_replace($rc . $rc, $rc, $string);
	if($urlencode == 1) $string	= urlencode($string);
	return $string;
}

/**
 * Function rewrite_url_static
 * $row = array('cat'=>'32', 'sta_id'=>43, 'sta_name'=>'tinh hinh gi');
 */
function rewrite_url_static($row = array()){
	global $lang_path;
	$iCat		= isset($row['sta_category_id'])? intval($row['sta_category_id']) : 0;
	$iSta		= isset($row['sta_id'])? intval($row['sta_id']) : 0;
	$iName	= isset($row['sta_title'])? removeTitle($row['sta_title']) : '';
	$url		= $lang_path .  $iCat . '/dt' . $iSta . '/' . $iName . '.html';
	return $url;
}
?>