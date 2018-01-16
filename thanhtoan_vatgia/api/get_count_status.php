<?
/*
 * API lấy danh sách đơn hàng đã mua của user
 */

require_once("../../classes/database.php");
require_once("../../functions/functions.php");

$arrOrderStatus = array(
                1 => "DonhangMoi",
                2 => "DangXuly",
                3 => "DaChuyenHang",
                4 => "DaNhanHang",
                5 => "ThanhCong",
                100 => "DaHuy"
);

// get value
$iUse = getValue("userId", "int", "GET", 0); // Id user
$update_status = getValue("status", "int", "POST", 0);
$fs_table = "order_c2c";
$response = new stdClass();
$response->code = 0;
$response->messages = "";
$arrOrdersPurchased = array();
// tổng sô lượng
$db_count = new db_query("  SELECT COUNT(*) as count, order_status
                            FROM " . $fs_table . "
                            WHERE order_user_id = " . $iUse . "
                            GROUP BY order_status",
    "USE_SLAVE");

while ($listing_count = mysql_fetch_assoc($db_count->result)) {
    if (isset($arrOrderStatus[$listing_count['order_status']])) $arrOrdersPurchased[$arrOrderStatus[$listing_count['order_status']]] = $listing_count['count'];
    $response->code = 1;
    $response->donmua = $arrOrdersPurchased;
};
echo json_encode($response);


