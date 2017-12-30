<?
require_once("../../resource/security/security.php");

$module_id = 54;
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

$fs_table				= "list_batdongsan";
$id_field				= "db_id";
$name_field				= "db_categories_name";
$break_page	= "{---break---}";
//Array variable
$arrTarget				= array (	"_blank"=> "Trang mới",
                                    "_self"	=> "Hiện hành",
);
$arrTypes               = array (	1 => "NHÀ ĐẤT BÁN",
                                    2 => "NHÀ ĐẤT CHO THUÊ",
                                    3 => "BÁN ĐẤT BÌNH DƯƠNG",
                                    4 => "BÁN ĐẤT ĐÀ NẴNG",
                                    5 => "TIN TỨC",
                                    6 => "LIÊN HỆ - GÓP Ý",
                                    7 => "LIÊN KẾT",
);

$arrPositon				= array(	1 => "Banner top",
                                    2 => "Banner tintuc left",
                                    3 => "Banner right",
                                    4 => "Banner bottom",
                                    5 => "Banner tintuc center",
                                    6 => "Banner home product",
                                    7 => "Banner Tin tức - R1",
                                    8 => "Banner Tin tức - R2",
                                    9 => "Banner mobile Top"
);
?>