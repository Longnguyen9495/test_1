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
        .process_line {
            width: 50%;
            height: 1px;
            position: absolute;
            left: -50%;
            top: 40px;
            padding: 0 32px;
        }

        .process_line > div {
            width: 100%;
            height: 100%;
            background: #fbb999;
        }

        .process_step.active .process_text(2) {
            color: #F44f00;
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

        .process_step .info {
            background-image: url(icon_new.png);
            background-position: 0 -50px;
            background-size: 150px;
        }

        .process_step .pay {
            background-image: url(icon_new.png);
            background-position: -50px 0px;
            background-size: 150px;
        }

        .process_step .success {
            background-image: url(icon_new.png);
            background-position: -100px -50px;
            background-size: 150px;
        }

        .process_step.center {
            margin: 0 auto;
        }

        .process_step {
            width: 33%;
            float: left;
            height: auto;
            text-align: center;
            position: relative;
        }

        #detail {
            width: 100%;
            text-align: center;
            position: relative;
            background: #f9f9fb;
        }

        .detail_info {
            font-size: 16px;
            line-height: 35px;
            font-weight: 600;
            color: #333;
            text-transform: uppercase;
        }

        .icon_detail {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            transform: translateX(100%) translateY(20%);
            font-size: 20px;
            color: #333;
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

        .process_bar {
            height: 100px;
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
            width: 70%;
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

        .text_color, .total_price {
            color: #f44f00;
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

        .checkout_btn a{
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
<div id="detail">
    <a class="icon_detail" href=""><i class="ion-chevron-left"></i></a>
    <span class="detail_info">Địa chỉ nhận hàng</span>
</div>
<div id="home">
    <div class="process_bar">
        <div class="process_step center active">
            <i class="img info"></i>
            <span class="process_text">Nhập thông tin</span>
        </div>
        <div class="process_step ">
            <i class="img pay"></i>
            <span class="process_text" style="color: #F44f00;">Thanh toán</span>
            <div class="process_line">
                <div></div>
            </div>

        </div>
        <div class="process_step ">
            <i class="img success"></i>
            <span class="process_text">Thành công</span>
            <div class="process_line">
                <div></div>
            </div>
        </div>
    </div>
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
        <div class="checkout_button_boder">
            <div class="checkout_button">
                <label class="checkout_btn" onclick="submitStep1()"><a href="Payment_success.php">Tiếp tục</a></label>
                <span class="total_btn">Tổng: <span class="total_price">6.022.000₫</span></span>
            </div>
        </div>
    </form>
</div>

</body>
</html>