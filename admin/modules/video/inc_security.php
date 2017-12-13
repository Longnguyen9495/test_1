<?
require_once("../../resource/security/security.php");

$module_id = 60;
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

$fs_table				= "video_category";
$id_field				= "vid_id";
$name_field				= "vid_title";
$vide_active            ="vid_active";


$fs_fieldupload		= "vid_images";
$fs_filepath			= "../../../data/videocategory/";
$fs_extension			= "gif,jpg,jpe,jpeg,png,swf";
$fs_filesize			= 5000;
$width_small_image	= 200;
$height_small_image	= 270;
$width_normal_image	= 270;
$height_normal_image	= 270;
$fs_insert_logo		= 0;
$break_page	= "{---break---}";

//Array variable
