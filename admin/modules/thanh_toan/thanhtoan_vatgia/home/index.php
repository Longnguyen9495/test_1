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
<div class="inc_header" id="inc_header">=
    <? include("../includes/inc_header.php"); ?>
</div>
<form action="" method="POST" name="fromPayment" onsubmit="return validatelogin()">
    <div class="inc_payment_bill" id="inc_payment_bill">
        <? include("../includes/inc_payment_bill.php"); ?>
    </div>

    <div class="inc_payment_method" id="inc_payment_method" style="display: none">
        <? include("../includes/inc_payment_method.php"); ?>
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
</form>
<div class="checkout_button_boder">
    <div class="checkout_button">
        <button id="" class="checkout_btn" onclick="return paymentSubmit();"><a href="javascript:;">Tiếp tục</a>
        </button>
        <span class="total_btn">Tổng: <span class="total_price">6.022.000₫</span></span>
    </div>
</div>
</body>
</html>
<script type="text/javascript">

    //check phone
    function phonenumber(inputtxt) {
        var phoneno = /^[0-9]{10,11}$/;
        return phoneno.test(inputtxt);
    }

    function validatelogin() {

        // check name
        if ($('#ord_name').val() == "" || $('#ord_name').val().length < 10) {
            $('.requiredfirstname').text('Tối thiểu 10 kí tự');
            $('#ord_name').focus();
            return false;
        }
        else {
            $('.requiredfirstname').text('');
        }
        //street_address
        if ($('#ord_phone').val() == "" || $('#ord_phone').val().length < 20) {
            $('.requiredstreet_address').text('Tối thiểu 20 kí tự');
            $('#ord_phone').focus();
            return false;
        }
        else {
            $('.requiredstreet_address').text('');
        }
        //phone

        if ($("#telephone").val() == "") {
            $('.requiredtelephone').text('Mời nhập số điện thoại');
            $('#telephone').focus();
            return false;
        }

        if (phonenumber($("#ord_address").val()) == false) {
            $('.requiredtelephone').text('Số điện thoại phải nhập dạng số, có 10 hoặc 11 số');
            $('#ord_address').focus();
            return false;
        }
        else {
            $('.requiredtelephone').text('');
        }
        // check if rồi thông báo thành công
        if ($("#ord_name").val() != "" &&
            $("#ord_phone").val() != "" &&
            $('#ord_address').val() != "" &&)
        {
            alert('Chúc mừng bạn đã đăng ký thành công !');
            $('.required_sub').text('thanh cong');
            // return false;
        }
    }

    function paymentSubmit() {

        // check visible
        var paymentBill = $("#inc_payment_bill").is(":visible");
        var paymentMethod = $("#inc_payment_method").is(":visible");


        if (paymentBill) {
            $("#inc_payment_method").show();
            $("#inc_payment_bill").hide();
        }
    }
</script>

