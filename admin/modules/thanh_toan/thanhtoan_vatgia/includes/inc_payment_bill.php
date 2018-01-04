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

        #address {
            padding: 0 15px;
        }

        .form_input > input {
            height: 35px;
            border: none;
            border-bottom: 1px #d9d9d9 solid;
            padding: 0;
            color: #404040;
            font-size: 14px;
            border-radius: 0;
            outline: none;
            width: 97%;
        }

        .form_label > i {
            width: auto;
            height: 35px;
            float: left;
            color: #b7b7b7;
            font-size: 37px;
            margin-top: 3px;
        }

        .form_input {
            display: block;
            position: relative;
            width: 100%;
        }

        .form_input > .form_select {
            width: 48%;
            height: 35px;
            border: none;
            border-bottom: 1px #d9d9d9 solid;
            padding: 0 10px 0 0;
            color: #404040;
            font-size: 14px;
            border-radius: 0;
            background: #fff;
            float: left;
        }

        .form_label {
            display: block;
            margin: 10px 0;
        }

        .checkout_text i {
            font-size: 13px;
            color: #c2c2c2;
        }

        .checkout_btn a {
            width: 150px;
            background: #F44f00;
            height: 45px;
            float: right;
            margin-top: 0;
            text-align: center;
            color: white;
            cursor: pointer;
            line-height: 45px;
            display: inline-block;
            font-weight: 700;
            text-decoration: none;
        }

        .icon_form_paymentBill {
            width: 3%;
            font-size: 45px;
            vertical-align: middle;
            color: #b7b7b7;
        }

    </style>
</head>
<body>
<div id="form_step_1">
    <div class="checkout_title" style="clear: both">
        Thông tin đặt hàng
    </div>
    <div class="checkout_address" id="user_address">
        <div class="address" id="address">
            <div class="ord_address_form">
                <form action="" method="post">
                    <label class="form_label" id="label_ord_name">
                        <div class="form_input">
                            <i class="icon_form_paymentBill ion-ios-person-outline" aria-hidden="true"></i>
                            <input type="tel" name="ord_name" id="ord_name" value="" placeholder="Họ tên người nhận">
                        </div>
                        <span class="requiredfirstname"></span>
                    </label>
                    <label class="form_label" id="label_ord_phone">
                        <div class="form_input">
                            <i class="icon_form_paymentBill ion-ios-telephone-outline" aria-hidden="true"></i>
                            <input type="tel" name="ord_phone" id="ord_phone" value="" placeholder="Điện thoại di động">
                        </div>
                        <span class="requiredphone"></span>
                    </label>
                    <label class="form_label form_city" id="label_ord_city">
                        <i class="icon_form_paymentBill ion-ios-home-outline" aria-hidden="true"></i>
                        <div class="form_input">
                            <select name="ord_city" id="ord_city" class="form_select" style="margin-left: 5px">
                                <option value="0">Tỉnh thành phố</option>
                                <option value="5">Hà Nội</option>
                                <option value="7">Hồ Chí Minh</option>
                                <option value="6">Đà Nẵng</option>
                            </select>
                        </div>
                        <span class="requiredCity"></span>
                    </label>
                    <label class="form_label form_district" id="label_ord_district">
                        <div class="form_input">
<!--                            <i class="icon_form_paymentBill form_tick flaticon-v9_checkout_tick"></i>-->
                            <select name="ord_district" id="ord_district" class="form_select" style="margin-left: 10px">
                                <option value="0">Quận huyện</option>
                            </select>
                        </div>
                        <span class="requiredDistrict"></span>
                    </label>
                    <label class="form_label" id="label_ord_address">
                        <div class="form_input">
                            <input type="text" name="ord_address" id="ord_address" value=""
                                   placeholder="Số nhà, đường phố, toà nhà, ...">
                        </div>
                        <span class="requiredAddress"></span>
                    </label>
                </form>
            </div>
            <div class="checkout_line"></div>
        </div>
    </div>
</div>
</body>
</html>