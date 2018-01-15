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

        .form_input_method .ord_name {
            height: auto !important;
            width: auto !important;
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
            width: 75%;
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
            margin-top: 0;
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
<div id="form_step_1">
    <div class="checkout_title" style="clear: both">Hình thức thanh toán</div>
    <div class="checkout_address" id="user_address">
        <div class="address" id="address">
            <div class="ord_address_form">
                <label class="form_label" id="label_ord_name">
                        <span class="form_input_method">
                    <input type="radio" name="pmt_method_payment_cod" class="ord_name" id="pmt_method_payment_cod" value="1">
                Thanh toán qua hình thức online</span>
                </label>
            </div>
            <div class="checkout_line"></div>
        </div>
    </div>
</div>

</body>
</html>