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

if ($iUse > 0) {
    $data = array();
    $query = "  SELECT *
                FROM order_c2c
                WHERE order_user_id = " . $iUse . " AND order_status = " . $status . "
                LIMIT 1";
    $db_query = new db_query($query);
    while ($rowProduct = mysql_fetch_assoc($db_query->result)) {
        $order_info = base64_decode($rowProduct['order_info']);
        echo '<pre>';
        $order_infos = json_decode($order_info, 1);
            $data[] = array(
                'orderID' => $rowProduct['order_id'],
                'orderProducts' => $order_infos,
                'orderDate' => $rowProduct['order_date'],
                'orderStatus' => $rowProduct['order_status'],
            );
    }


    $response->total = 1;
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

// phân trang

?>