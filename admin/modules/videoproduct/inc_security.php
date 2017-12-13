<?
require_once("../../resource/security/security.php");

$module_id = 23;
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

$fs_table				= "video_product";
$id_field				= "video_id";
$name_field				= "video_title";
$vide_active            ="video_active";
$fs_fieldupload		= "video_image";
$fs_filepath			= "../../../data/gallery/";
$fs_extension			= "gif,jpg,jpe,jpeg,png,swf";
$fs_filesize			= 5000;
$width_small_image	= 200;
$height_small_image	= 270;
$width_normal_image	= 270;
$height_normal_image	= 270;
$fs_insert_logo		= 0;
$break_page	= "{---break---}";

//Array variable
$arrType 	= array(0 => "Chọn thể loại");
$db_query 	= new db_query("SELECT * FROM video_category ORDER BY vid_title ASC");

while($row = mysql_fetch_assoc($db_query->result)){
	$arrayManufactory[$row['vid_id']]	= $row['vid_title'];
	
}
$db_query->close();


unset($db_query);
?>