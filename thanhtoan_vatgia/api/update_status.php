<?
/*
 * API lấy danh sách đơn hàng đã mua của user
 */

require_once("../../classes/database.php");
require_once("../../functions/functions.php");

$update_status = getValue("status","int","POST",0);

// Nếu chưa có địa chỉ người mua chuẩn thì cập nhật cho bản ghi này là địa chỉ người mua chuẩn
if ($update_status['status'] == 0) {
    $update_status = new db_execute("UPDATE order_status SET ua_order = 1 WHERE ua_id = " . intval($update_status['status']));
    unset($update_status);
}