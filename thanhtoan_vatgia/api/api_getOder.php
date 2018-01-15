<?
/*
 * API lấy danh sách đơn hàng đã mua của user
 */

require_once("../../classes/database.php");
require_once("../../functions/functions.php");

// Chống bot truy cập
/* Get value $iUser
 * @param  $iUser
 * @return $iUser|integer|get|userId
 *
 */
$status = getValue("status", "int", "GET", 0); // get Status
$iUse = getValue("userId", "int", "GET", 0); // Id user

$response = new stdClass();
$response->code = 0;


// Phân trang


$sqlWhere = '';
$fs_table = "order_c2c";
$page_size = 5;
// tổng sô lượng
$db_count = new db_query("  SELECT count(*) AS count
							FROM " . $fs_table . "  ");

$listing_count = mysql_fetch_assoc($db_count->result);
$total_record = $listing_count["count"];
$page = getValue("page", "int", "GET", 0); // page
if ($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
else $num_of_page = (int)($total_record / $page_size) + 1;
if ($page > $num_of_page) $page = $num_of_page;
if ($page < 1) $page = 1;
unset($db_count);
//End phân trang


if ($iUse > 0) {
    $data = array();
    $query = "  SELECT *
                FROM order_c2c
                WHERE order_user_id = " . $iUse . " AND order_status = " . $status . "  LIMIT  " . ($page - 1) * $page_size . "," . $page_size." ";
    $db_query = new db_query($query);
    while ($rowProduct = mysql_fetch_assoc($db_query->result)) {
        $order_info = base64_decode($rowProduct['order_info']);
        $order_infos = json_decode($order_info, 1);
            $data[] = array(
                'orderID' => $rowProduct['order_id'],
                'orderProducts' => $order_infos,
                'orderDate' => $rowProduct['order_date'],
                'orderStatus' => $rowProduct['order_status'],
            );
    }


    $response->total = $total_record;
    $response->code = 1;
    $response->data = $data;
    $response->messages = "Success";


} else {
    $response->messages = "Missing userId parameter";
}

// Ghi log
if ($response->messages != "") {
    $dataLog = "URL: " . getURL(1, 1, 1, 1) . "\n";
    $dataLog .= "ErrorMsg: " . $response->messages . "\n";
    dump_log($dataLog, "C2C_LOG");
}

echo json_encode($response);
?>