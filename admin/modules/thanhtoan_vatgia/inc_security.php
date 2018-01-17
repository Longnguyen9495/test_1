<?
require_once("../../resource/security/security.php");

$module_id = 21;
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

$fs_table				= "order_c2c";
$id_field				= "order_id";
$name_field				= "order_name";
$break_page	            = "{---break---}";
//Array variable
$arrOrderStatus = array(
                1 => "DonhangMoi",
                2 => "DangXuly",
                3 => "DaChuyenHang",
                4 => "DaNhanHang",
                5 => "ThanhCong",
                100 => "DaHuy"
);
$arrOrderStatus = array(
                    1 => "DonhangMoi",
                    2 => "DangXuly",
                    3 => "DaChuyenHang",
                    4 => "DaNhanHang",
                    5 => "ThanhCong",
                    100 => "DaHuy"
);
?>