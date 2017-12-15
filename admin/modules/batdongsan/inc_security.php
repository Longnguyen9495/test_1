<?
require_once("../../resource/security/security.php");

$module_id = 54;
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

$fs_table				= "batdongsan";
$id_field				= "db_id";
$name_field				= "db_name";
$fs_fieldupload		= "db_image";
$fs_filepath			= "../../../data/image-batdongsan/";
$fs_extension			= "gif,jpg,jpe,jpeg,png,swf";
$fs_filesize			= 500;
$width_small_image	= 200;
$height_small_image	= 270;
$width_normal_image	= 270;
$height_normal_image	= 270;
$fs_insert_logo		= 0;
$break_page	= "{---break---}";
//Array variable
$arrTarget				= array (	"_blank"=> "Trang mới",
											"_self"	=> "Hiện hành",
										);
$arrType             = array (	1 => "NHÀ ĐẤT BÁN",
                                 2 => "NHÀ ĐẤT CHO THUÊ",
                                 3 => "BÁN ĐẤT BÌNH DƯƠNG",
                                 4 => "BÁN ĐẤT ĐÀ NẴNG",
                                 5 => "TIN TỨC",
                                 6 => "LIÊN HỆ - GÓP Ý",
                                 7 => "LIÊN KẾT",
										);

$arrPositon				= array(	1 => "Banner top",
										2 => "Banner category left",
										3 => "Banner right",
										4 => "Banner bottom",
										5 => "Banner category center",
										6 => "Banner home product",
										7 => "Banner Tin tức - R1",
										8 => "Banner Tin tức - R2",
										9 => "Banner mobile Top"
                             );
?>