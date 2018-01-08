<?
require_once("config.php");
//
$recode_id                              = getValue("recode_id");
$db_query                               = new db_query("SELECT * FROM orders_c2c_temp WHERE oct_id = " . $recode_id);

$row                                    = mysql_fetch_assoc($db_query->result);
$temp                                   = array();
$temp['id']                             = $row['oct_id'];
$temp['name']                           = $row['oct_product_name'];
$temp['product_quantity']               = $row['oct_product_quantity'];
$temp['product_price']                  = $row['oct_product_price'];
$temp['seller_id']                      = $row['oct_seller_id'];
$temp['seller_email']                   = $row['oct_seller_email'];
$temp['price']                          = $row['oct_price'];
$temp['date']                           = $row['oct_date'];
$temp['product_id']                     = $row['oct_product_id'];


$dataInfo[] = $temp;

$order_info = json_encode($dataInfo);



// Call class form
$myform = new generate_form();

$myform->add("order_info", "order_info", 6, 1, "", 0, "", 0, "");
$myform->addTable("order_c2c");


//Get action variable for add new data
$action				= getValue("action", "str", "POST", "");
if($action == "themmoi"){
    //Insert to database

    $db_insert = new db_execute_return();
    $query = $myform->generate_insert_SQL();
    var_dump($db_insert->db_execute($query));
    $last_id = $db_insert->db_execute($query);

    unset($db_insert);
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

        .checkout_btn a {
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
    </style>
</head>
<body>
<div class="inc_header" id="inc_header">
    <? include("inc_header.php"); ?>
</div>
<form action="" method="POST" name="fromPayment">
    <div class="inc_payment_bill" id="inc_payment_bill">
        <? include("inc_payment_bill.php"); ?>
    </div>

    <div class="inc_payment_method" id="inc_payment_method" style="display: none">
        <? include("inc_payment_method.php"); ?>
    </div>

    <div class="checkout_title">Đơn hàng của bạn</div>
    <div class="check_oder">
        <div class="checkout">
            <div class="checkout_text">
                <span>đăng bởi:<strong>Nguyen Thanh Tung</strong></span>
                <i>Ngày tham gia: 22/07/2017</i>
            </div>
            <div class="img_user"><img src=""></div>
        </div>
        <div class="product">
            <div class="img_product">
                <img src="https://mediamyad.vatgia.vn/photo/users_b_upload/2017/12/wrk1513217620.png">
            </div>
            <div class="infomation_product">
                <p class="text_product">Chân máy giặt - tủ lạnh inox Cảnh Phong</p>
                <span></span><br>
                <span class="text_color">12.000.000đ</span>
            </div>
        </div>
    </div>
    <input type="hidden" name="action" value="themmoi">
    <div class="checkout_button_boder">
        <div class="checkout_button">
            <button id="button_buy" class="checkout_btn" onclick="return paymentSubmit();"><a href="javascript:;">Tiếp tục</a>
            </button>
            <span class="total_btn">Tổng: <span class="total_price">6.022.000₫</span></span>
        </div>
    </div>


</form>
</body>
</html>
<script type="text/javascript">
    //check phone
    function phonenumber(inputtxt)
    {
        var phoneno = /^[0-9]{10,11}$/;
        return phoneno.test(inputtxt);
    }

    function validate() {
        var uso_user_name  = $("#ord_name").val();
        var uso_user_phone = $("#ord_phone").val();
        var uso_user_address = $("#ord_address").val();

        if(uso_user_name == ""){
            $("#error").html("Vui lòng nhập tên khách hàng");
            $("#ord_name").focus();
            return false;
        }
        else{
            $('#error').text('');
        }
        if (uso_user_name == "" ||uso_user_name.length < 10) {
            $('#error').text('Tối thiểu 10 kí tự');
            $('#ord_name').focus();
            return false;
        }
        else{
            $('#error').text('');
        }
        if (uso_user_phone == "") {
            $('#error_phone').text('Mời nhập số điện thoại');
            $('#ord_phone').focus();
            return false;
        }
        else{
            $('#error_phone').text('');
        }
        if (phonenumber($('#ord_phone').val()) == false) {
            $('#error_phone').text('Số điện thoại phải nhập dạng số, có 10 hoặc 11 số');
            $('#ord_phone').focus();
            return false;
        }
        else {
            $('#error_phone').text('');
        }
        if(uso_user_address == ""){
            $("#error_address").html("Vui lòng nhập địa chỉ nhận hàng");
            $("#ord_address").focus();
            return false;
        }
        else{
            $('#error_address').text('');
        }
        $("#button_buy").css('cursor', 'not-allowed').attr("disabled", "disabled").val('Vui lòng đợi...').blur();
        return true;
    }
    function paymentSubmit() {

        if(!validate()) return false;


        // check visible
        var paymentBill = $("#inc_payment_bill").is(":visible");
        var paymentMethod = $("#inc_payment_method").is(":visible");


        if (paymentBill) {
            $("#inc_payment_method").show(500);
            $("#inc_payment_bill").hide(500);
            $(".pay").css('background-position', '-50px 0px');
            $(".pay_text").css('color', '#F44f00');
        }

        if (paymentMethod) {
            var frm = $("form[name='fromPayment']");
            /*if(!checkPaymentUser()) return false;*/
            frm.find("a.checkout_btn span.text").html("Vui lòng đợi...");

            frm.submit();

            return true;
        }


        return false;
    }
</script>

