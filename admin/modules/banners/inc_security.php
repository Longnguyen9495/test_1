<?
require_once("../../resource/security/security.php");

$module_id = 23;
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

$fs_table				= "db_tintuc";
$id_field				= "db_id";
$name_field				= "db_name";
$fs_fieldupload		= "db_picture";
$fs_filepath			= "../../../data/tintuc/";
$fs_extension			= "gif,jpg,jpe,jpeg,png,swf";
$fs_filesize			= 500;
$width_small_image	= 200;
$height_small_image	= 270;
$width_normal_image	= 270;
$height_normal_image	= 270;
$fs_insert_logo		= 0;
$break_page	= "{---break---}";
?>