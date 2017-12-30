<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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

        /* home */

        .process_line > div {
            width: 100%;
            height: 100%;
            background: #fbb999;
        }

        .process_step.active .
        process_text

        (
        2
        )
        {
            color: #F44f00
        ;
        }

        .process_step > span {
            display: block;
            color: #000;
            margin-top: 8px;
        }

        .process_step > i {
            background: #fbb999;
            width: 50px;
            height: 50px;
            display: inline-block;
            border-radius: 25px;
            color: #fff;
            text-align: center;
            line-height: 50px;
            font-size: 20px;
            margin-top: 13px;
        }

        .checkout_title {
            border-top: 1px #f9f9fb solid;
            color: #333;
            background: #f9f9fb;
            line-height: 35px;
            padding: 0 15px;
        }

        .form_input input {
            vertical-align: middle;
        }

        #address {
            padding: 0 15px;
        }

        .form_label > i {
            width: auto;
            height: 35px;
            float: left;
            color: #b7b7b7;
            font-size: 37px;
            margin-top: 3px;
        }

        .form_label {
            display: block;
            margin: 10px 0;
        }

        .check_oder {
            margin: 10px 15px;
        }

        .check_oder .checkout {
            width: 100%;
            height: 100px;
            border-bottom: 1px #d9d9d9 solid;
        }

        .checkout .checkout_text {
            float: left;
            width: 55%;
            font-size: 16px;
        }

        .checkout_text i {
            font-size: 13px;
            color: #c2c2c2;
        }

        .checkout .img_user {
            float: right;
            border-radius: 50%;
            background-color: #333;
            width: 60px;
            height: 60px;
        }

        .check_oder .product {
            width: 100%;
            display: block;
            margin: 10px 0;
        }

        .img_product {
            width: 30%;
            float: left;
        }

        .infomation_product {
            width: 65%;
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
    </style>
</head>
<body>
<div class="inc_header" id="inc_header">
    <? include("../includes/inc_header.php"); ?>
</div>
<div id="home">
    <form id="form_step_1">
        <div class="checkout_title" style="clear: both">Hình thức thanh toán</div>
        <div class="checkout_address" id="user_address">
            <div class="address" id="address">
                <div class="ord_address_form">
                    <label class="form_label" id="label_ord_name">
                        <span class="form_input">
                    <input type="checkbox" name="ord_name" id="ord_name">
                Thanh toán qua hình thức online</span>
                    </label>
                </div>
                <div class="checkout_line"></div>
            </div>
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
        <div class="inc_input_payment" id="inc_input_payment">
            <? include("../includes/inc_input_payment.php"); ?>
        </div>
    </form>
</div>

</body>
</html>