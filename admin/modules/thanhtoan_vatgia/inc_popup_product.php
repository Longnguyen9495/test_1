<?
require_once("inc_security.php");
$recode_id = getValue("recode_id", "int", "GET", 0);
$db_query_popup = new db_query("SELECT * FROM order_c2c WHERE order_id = " . $recode_id . " ");
$row = mysql_fetch_assoc($db_query_popup->result);
$id = $row['order_id'];
$name = $row['order_name'];
$email = $row['order_email'];
$adress = $row['order_adress'];
$phone = $row['order_phone'];


?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .textBold {
            padding: 3px;
            background-image: linear-gradient(to bottom, #FFFFFF, #E6E6E6);
            border-bottom: 1px solid #BBBBBB;
            border-left: none;
            font-size: 12px;
            font-weight: bold;
            text-align: left;
        }

        .table_popup {
            background: #f7f7f91f;
            padding: 5px;
            box-shadow: 0px 1px 2px #999999;
            border: 1px #DDDDDD solid;
        }

        .text_right {
            padding-right: 12px;
            width: 200px;
            padding-bottom: 5px;
        }

        .table_popup tr td {
            font-size: 12px;
        }
    </style>
</head>
<body>
<table class="table table-bordered table_popup" width="800" cellpadding="4" cellspacing="0" border="1"
       bordercolor="#999999"
       style="border-collapse:collapse;margin: 0 auto">
    <tbody>
    <tr>
        <td align="center"><a href="listing.php">.: Back :.</a></td>
    </tr>
    <tr>
        <td class="textBold">THÔNG TIN ĐẶT HÀNG</td>
    </tr>
    <tr>
        <td>
            <table width="100%" cellpadding="3">
                <tbody>
                <tr>
                    <td align="right" class="text text_right" width="150">Người đặt hàng :</td>
                    <td align="left" class="text" style="font-weight:bold; color:#0000FF"><a
                                href="" target="_blank">demo38</a></td>
                </tr>
                <tr>
                    <td align="right" class="text text_right" width="150">Mã số đơn hàng :</td>
                    <td align="left" class="text" style="font-weight:bold; color:#FF0000"><?= $id ?></td>
                </tr>
                <tr>
                    <td align="right" class="text text_right" width="150">Họ tên người đặt hàng :</td>
                    <td align="left" class="text"><?= $name ?></td>
                </tr>
                <tr>
                    <td align="right" class="text text_right" width="150">Email :</td>
                    <td align="left" class="text"><?= $email ?></td>
                </tr>
                <tr>
                    <td align="right" class="text text_right" width="150">Địa chỉ :</td>
                    <td align="left" class="text"><?= $adress ?></td>
                </tr>
                <tr>
                    <td align="right" class="text text_right" width="150">Điện thoại :</td>
                    <td align="left" class="text"><?= $phone ?></td>
                </tr>


                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td class="textBold">THÔNG TIN NHẬN HÀNG</td>
    </tr>
    <tr>
        <td>
            <table width="100%" cellpadding="3">
                <tbody>
                <tr>
                    <td align="right" class="text text_right" width="150">Họ tên người nhận :</td>
                    <td align="left" class="text"><?= $name ?></td>
                </tr>
                <tr>
                    <td align="right" class="text text_right" width="150">Địa chỉ :</td>
                    <td align="left" class="text"><?= $adress ?></td>
                </tr>
                <tr>
                    <td align="right" class="text text_right" width="150">Điện thoại :</td>
                    <td align="left" class="text"><?= $phone ?></td>
                </tr>


                <tr>
                    <td colspan="2">
                        <hr size="1" color="#CCCCCC">
                    </td>
                </tr>
                <tr>
                    <td align="right" class="text text_right" width="150">Đơn hàng của :</td>
                    <td class="" style="color:#FF0000">Cửa hàng điện tử công nghệ Online</td>
                </tr>
                <tr>
                    <td align="right" class="text text_right" width="150">Điện thoại :</td>
                    <td class="" style="color:#FF0000">01685480846</td>
                </tr>
                <tr>
                    <td align="right" class="text text_right" width="150">Di động :</td>
                    <td class="" style="color:#FF0000"></td>
                </tr>
                <tr>
                    <td align="right" class="text text_right" width="150">Loại gian hàng :</td>
                    <td class="">
                        Gian hàng chuyên nghiệp
                    </td>
                </tr>
                <tr>
                    <td align="right" class="text text_right" width="150">Thời gian tham gia VG :</td>
                    <td class="">23/07/2007</td>
                </tr>
                <tr>
                    <td align="right" class="text text_right" width="150">Thời gian đặt hàng :</td>
                    <td align="left" class="text">Thứ ba, 02/01/2018, 10:46 GMT+7</td>
                </tr>
                <tr>
                    <td align="right" class="text text_right" width="150">Tài khoản nhận tiền BK :</td>
                    <td align="left" class="text">tranoanhk61b@gmail.com</td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>

    <tr>
        <td>
            <table width="100%" cellspacing="0" cellpadding="5" border="1" bordercolor="#999999"
                   style="border-collapse:collapse;background: #f7f7f91f;
            padding: 5px;
            box-shadow: 0px 1px 2px #999999;
            border: 1px #DDDDDD solid;">
                <tbody>
                <tr bgcolor="#D4D4D4">
                    <td class="textBold" align="center">Stt.</td>
                    <td class="textBold" align="center">Tên mặt hàng</td>
                    <td class="textBold" align="center">Số lượng</td>
                    <td class="textBold" align="center">Đơn giá</td>
                    <td class="textBold" align="center">Thành tiền</td>
                    <td class="textBold" align="center">Xóa</td>
                </tr>

                <tr>
                    <? $db_query_product = new db_query("SELECT order_info FROM order_c2c WHERE order_id = " . $recode_id . " ");
                    $item = mysql_fetch_assoc($db_query_product->result);
                    $order_info = base64_decode($item['order_info']);
                    $row = json_decode($order_info, 1);
                    $name = array();
                    foreach ($row as $key => $value) {
                        ?>
                        <td style="text-align:center" class="text"><? echo $value['id'] ?></td>
                        <td class="text" style="text-align: left">
                            <div><a target="_blank" href=""></a><? echo $value['name'] ?></div>
                        </td>
                        <td align="left" class="" style="text-align:left"><? echo $value['quantity'] ?></td>
                        <td align="left" class="text text_right"
                            style="color:#FF0000; text-align:left"><? echo number_format($value['price']) ?>đ
                        </td>
                        <td align="left" class="text text_right"
                            style="color:#FF0000; text-align:left"><? echo number_format($value['price']) ?>đ
                        </td>
                        <td align="center"><a
                                    href="delete.php?record_id=<? echo $value['id'] ?>">Xoa</a>
                        </td>
                    <? } ?>
                </tr>

                <tr>
                    <td colspan="7" class="textBold" align="right" style="text-align: right">Tổng cộng : <font
                                color="#FF0000">40.000 đ</font>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center">
            :: Đơn hàng đã được chuyển đến E-Store ::

            <table style="border-collapse:collapse" border="1" bordercolor="#999999" cellpadding="5" cellspacing="0"
                   width="100%">
                <tbody>
                <tr>
                    <td align="center" width="50%" style="background: #f7f7f91f;
            padding: 5px;
            box-shadow: 0px 1px 2px #999999;
            border: 1px #DDDDDD solid;">
                        <div style="padding:5px">Thay đổi trạng thái đơn hàng thành</div>
                        <div style="padding:5px">
                            <select class="form_control" id="ord_status_2_change" name="ord_status_2_change"
                                    style="border: 1px #c3c3c3 solid;outline: none">
                                <?
                                $array_status[] = array(
                                    1 => "[Bước 1/5] Đang chờ xác nhận đơn hàng",
                                    2 => "[Bước 2/5] Gian hàng đã xác nhận đơn hàng",
                                    3 => "[Bước 3/5] Khách hàng đã xác nhận lại và thanh toán",
                                    4 => "[Bước 4/5] Gian hàng đã gửi hàng cho khách",
                                    5 => "[Bước 5/5] Khách đã nhận được hàng của mình",
                                    100 => "[Hủy đơn] Đơn hàng đã bị hủy"
                                );
                                foreach ($array_status as $key => $value) {
                                    ?>
                                    <option value="1"><? echo $value['1'] ?></option>
                                    <option value="2"><? echo $value['2'] ?></option>
                                    <option value="3"><? echo $value['3'] ?></option>
                                    <option value="4"><? echo $value['4'] ?></option>
                                    <option value="5"><? echo $value['5'] ?></option>
                                    <option value="100"><? echo $value['100'] ?></option>
                                <? } ?>
                            </select>
                        </div>
                        <input type="button" class="form_button" value="Xác nhận" style="background-image: linear-gradient(to bottom, #FFFFFF, #E6E6E6);
            padding: 5px;
            box-shadow: 0px 1px 2px #999999;
            border: 1px #DDDDDD solid;"
                               onclick="if(confirm('Bạn có chắc chắn đổi trạng thái đơn hàng này? !!!')) window.location.href='change_order_step.php?record_id=888&amp;step=' + document.getElementById('ord_status_2_change').value + '&amp;redirect=b3JkZXJfZGV0YWlsLnBocD9yZWNvcmRfaWQ9ODg4'">
                    </td>

                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
