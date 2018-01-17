<?
require_once("config.php");
//
$record_id = getValue("recode_id");
$query = "  SELECT *
            FROM orders_c2c_temp
            WHERE oct_id = " . $record_id . "
            LIMIT 1";
$db_query = new db_query($query);
if (mysql_num_rows($db_query->result) <= 0) exit("Don hang khong ton tai !");
$rowOrderTmp = mysql_fetch_assoc($db_query->result);
$order_user_id = $rowOrderTmp['oct_seller_id'];
$temp = array();
$temp['id'] = $rowOrderTmp['oct_id'];
$temp['name'] = $rowOrderTmp['oct_product_name'];
$temp['quantity'] = $rowOrderTmp['oct_product_quantity'];
$temp['price'] = $rowOrderTmp['oct_product_price'];
$temp['picture'] = $rowOrderTmp['oct_price'];
$temp['product_id'] = $rowOrderTmp['oct_product_id'];


$data_info[] = $temp;

$order_total_money = $rowOrderTmp['oct_product_price'] * $rowOrderTmp['oct_product_quantity'];
$order_info = json_encode($data_info);

$order_info = base64_encode($order_info);


$pmt_method_payment_cod = getValue("pmt_method_payment_cod", "int", "POST", 0); // Lưu cụ thể user chọn thẻ nào
$order_name = getValue("order_name", "str", "POST", 0);
$order_email = getValue("order_email", "str", "POST", 0);
$order_phone = getValue("order_phone", "str", "POST", 0);
$order_city = getValue("order_city", "int", "POST", 0);
$order_district = getValue("order_nCity", "int", "POST", 0);
$order_address = getValue("order_address", "str", "POST", 0);
$order_address = getValue("order_address", "str", "POST", 0);
$order_user_id = getValue("order_user_id", "str", "POST", $order_user_id);
$order_date = time();
$order_status = 1;


$myform = new generate_form();
$myform->add("order_payment_method", "pmt_method_payment_cod", 1, 1, 0, 0, "", 0, "");
$myform->add("order_title_money", "order_total_money", 1, 1, 0, 0, "", 0, "");
$myform->add("order_info", "order_info", 0, 1, "", 0, "", 0, "");
$myform->add("order_name", "order_name", 0, 1, " ", 1, "Bạn chưa nhập họ tên người đặt hàng.", 0, "");
$myform->add("order_email", "order_email", 2, 1, " ", 1, "Email người đặt hàng không hợp lệ.", 0, "");
$myform->add("order_adress", "order_address", 0, 1, " ", 1, "Bạn chưa nhập địa chỉ người đặt hàng.", 0, "");
$myform->add("order_city", "order_city", 1, 1, 1, 1, "Bạn chưa chọn Tỉnh/TP người đặt hàng", 0, "");
$myform->add("order_sdistrict", "order_district", 1, 1, 1, 1, "Bạn chưa chọn Quận/Huyện người đặt hàng", 0, "");
$myform->add("order_phone", "order_phone", 0, 1, " ", 1, "Bạn chưa nhập số điện thoại người đặt hàng.", 0, "");
$myform->add("order_user_id", "order_user_id", 0, 1, " ", 0, "", 0, "");
$myform->add("order_date", "order_date", 1, 1, 0, 0, "", 0, "");
$myform->add("order_status", "order_status", 1, 1, 0, 0, "", 0, "");

$myform->addTable("order_c2c");

$action = getValue('action', 'str', 'POST', '');
if ($action == "themmoi") {


    $fs_errorMsg = $myform->checkdata();

    $db_insert = new db_execute_return();
    $query = $myform->generate_insert_SQL();
    $last_id = $db_insert->db_execute($query);
    unset($db_insert);


    // Thanh toán sử dụng TK Bảo Kim


    if ($pmt_method_payment_cod == 1) {
        $linkRedirect = 'inc_payment_user.php?record_id=' . $last_id . '';
        redirectHeader($linkRedirect);
    }

}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.js"
            integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        img {
            max-width: 100%;
            border-radius: 4px;
        }

        div {
            display: block;
        }

        body {
            height: 100%;
            width: 100%;
            color: #333;
            background: #fff;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 20px;
            font-size: 14px;
            min-width: 320px;
        }

        .checkout_button_boder {
            width: 100%;
            display: block;
            clear: both;
            height: 50px;
            position: relative;
        }

        .checkout_button {
            width: 100%;
            height: 45px;
            background: #fff;
            position: fixed;
            bottom: 0;
            border-top: 1px #d6d6d6 solid;
            border-bottom: 1px #d6d6d6 solid;
        }

        .checkout_btn {
            border: none;
            float: right;
        }

        .checkout_btn {
            width: 150px;
            background: #F44f00;
            height: 45px;
            float: right;
            margin-top: -1px;
            text-align: center;
            color: white;
            cursor: pointer;
            line-height: 45px;
            display: inline-block;
            font-weight: 700;
            text-decoration: none;
        }

        .total_btn {
            display: block;
            height: 100%;
            color: #404040;
            font-size: 16px;
            line-height: 45px;
            font-weight: 700;
            padding: 0 15px;
        }
        .product .text_color{
            font-size: 16px;
            font-weight: 600;
            color: #f44f00;
        }
        .product .text_product{
            font-size: 20px;
            font-weight: 600;
            line-height: initial;
        }
        .img_product {
            width: 30%;
            float: left;
            overflow: hidden;
        }

        .infomation_product {
            width: 70%;
            float: right;
        }
    </style>
</head>
<body>
<div class="inc_header" id="inc_header">
    <? include("inc_header.php"); ?>
</div>

<form action="" method="POST" name="frmPayment" ">
    <div class="inc_payment_bill" id="inc_payment_bill">
        <? include("inc_payment_bill.php"); ?>
    </div>


    <div class="inc_payment_method" id="inc_payment_method" style="display: none;">
        <? include("inc_payment_method.php"); ?>
    </div>

    <? include("inc_order_don.php"); ?>

    <div>
    <input type="hidden" name="action" value="themmoi">


    <div class="checkout_button_boder">
        <div class="checkout_button">
            <button id="pmt_button" class="pmt_button checkout_btn" onclick="return paymentSubmit();">Tiếp
                tục
            </button>
            <span class="total_btn">Tổng: <span class="total_price">6.022.000₫</span></span>

        </div>


    </div>
</div>
</form>
</body>
</html>


<script type="text/javascript">
    function loadDistrict(div_city, div_district, current) {

        $("#" + div_district).html('<option value="0">Quận Huyện</option>');
        var iCit = $("#" + div_city).val();
        if (iCit > 0) {
            var ajaxURL = "ajax_city.php?iCit=" + iCit;
            if (current > 0) ajaxURL += "&iDist=" + current;
            $("#" + div_district).load(ajaxURL, function (response, status, xhr) {
                if (status == "success") {
                    // Mở luôn ô chọn quận huyện
                    // if($("#" + div_district).val() <= 0) open($("#" + div_district));
                }
            });

        }
    }

    //check phone
    function phonenumber(inputtxt) {
        var phoneno = /^[0-9]{10,11}$/;
        return phoneno.test(inputtxt);
    }

    //check email
    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    function validatelogin() {
        var uso_user_name  = $("#order_name").val();
        var uso_user_phone = $("#order_phone").val();
        var uso_user_address = $("#order_address").val();
        var uso_user_email = $("#order_email").val();

        if(uso_user_name == ""){
            $("#error").html("Vui lòng nhập tên khách hàng");
            $("#order_name").focus();
            return false;
        }
        else{
            $('#error').text('');
        }
        if (uso_user_name == "" ||uso_user_name.length < 10) {
            $('#error').text('Tối thiểu 10 kí tự');
            $('#order_name').focus();
            return false;
        }
        else{
            $('#error').text('');
        }
        if (uso_user_email == "") {
            $('#error_email').text('Mời nhập email');
            $('#error_email').focus();
            return false;
        }
        else{
            $('#error_email').text('');
        }
        // if (IsEmail(uso_user_email == "") == false ) {
        //     $('#error_email').text('Email sai định dạng');
        //     $('#error_email').focus();
        //     return false;
        // }
        // else{
        //     $('#error_email').text('');
        // }
        if (uso_user_phone == "") {
            $('#error_phone').text('Mời nhập số điện thoại');
            $('#order_phone').focus();
            return false;
        }
        else{
            $('#error_phone').text('');
        }
        if (phonenumber($('#order_phone').val()) == false) {
            $('#error_phone').text('Số điện thoại phải nhập dạng số, có 10 hoặc 11 số');
            $('#order_phone').focus();
            return false;
        }
        else {
            $('#error_phone').text('');
        }
        if(uso_user_address == ""){
            $("#error_address").html("Vui lòng nhập địa chỉ nhận hàng");
            $("#order_address").focus();
            return false;
        }
        else{
            $('#error_address').text('');
        }
        $("#pmt_button").val('Vui lòng đợi...').blur();
        return true;
    }

    function paymentSubmit() {

        // if(!validate()) return false;


        // check visible
        var paymentBill = $("#inc_payment_bill").is(":visible");
        var checkPayment = $("#inc_payment_method").is(":visible");


        if (paymentBill) {
            if(!validatelogin()) return false;
            $("#inc_payment_bill").hide(500);
            $("#inc_payment_method").show(500);
            $(".pay").css("background-position","-50px 0");
            $(".pay_text").css("color","#F44f00");
        }

        if (checkPayment) {
            var frm = $("form[name='frmPayment']");
            /*if(!checkPaymentUser()) return false;*/
            frm.find("a.checkout_btn span.text").html("Vui lòng đợi...");

            frm.submit();

            return true;
        }


        return false;
    }
</script>

