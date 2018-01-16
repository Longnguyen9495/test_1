<?
/*
 * API lấy danh sách đơn hàng đã mua của user
 */

require_once("../../classes/database.php");
require_once("../../functions/functions.php");

$record_id = getValue("recode_id", "int", "POST", 0);
$update_status = getValue("status", "int", "POST", 0);

//$db_update_status = "UPDATE order_c2c SET order_status = ". $update_status ." WHERE order_id = " . $record_id ." ";
//$update_query = new db_execute($db_update_status);

$query_update = "SELECT * FROM order_c2c WHERE order_id = " . $record_id . " ";
$db_query_update = new db_query($query_update);
if ($row_order_status = mysql_fetch_assoc($db_query_update->result)) {
    $record_id = $row_order_status['order_id'];
    $db_query_update = new db_execute("UPDATE order_c2c SET order_status = " . $update_status . " WHERE order_id = " . $record_id . " ");
    echo "Update status thành công";
    unset($query_update);
}else{
    echo "Chưa Thành Công";
}