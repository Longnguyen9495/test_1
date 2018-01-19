<?
// connect mysql city
$arrType    = array();
$db_city    = new db_query("SELECT cit_id,cit_name FROM city  WHERE cit_parent_id=0");
while ($city = mysql_fetch_array($db_city->result)) {
    $arrType[$city['cit_id']] = $city['cit_name'];

}
$db_city->close();
unset($db_city);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
            width: 96%;
            float: right;
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
            width: 47%;
            height: 35px;
            border: none;
            border-bottom: 1px #d9d9d9 solid;
            padding: 0 10px 0 0;
            color: #404040;
            font-size: 14px;
            border-radius: 0;
            background: #fff;
            float: left;
            outline: none;
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
        .required {
            color: red;
            font-size: 12px;
            text-align: left;
            line-height: 20px;
            margin-left: 55px;
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
                <label class="form_label" id="label_ord_name">
                    <div class="form_input">
                        <i class="icon_form_paymentBill ion-ios-person-outline" aria-hidden="true"></i>
                        <input type="tel" name="order_name" id="order_name" value="" placeholder="Họ tên người nhận">
                    </div>

                    <span id="error" class="required errorName_vi"></span>
                </label>
                <label class="form_label" id="label_ord_name">
                    <div class="form_input">
                        <i class="icon_form_paymentBill ion-ios-email-outline" aria-hidden="true"></i>
                        <input type="tel" name="order_email" id="order_email" value="" placeholder="Email người nhận">
                        <span id="error_email" class="required errorEmail_vi"></span>
                    </div>
                </label>
                <label class="form_label" id="label_ord_phone">
                    <div class="form_input">
                        <i class="icon_form_paymentBill ion-ios-telephone-outline" aria-hidden="true"></i>
                        <input type="tel" name="order_phone" id="order_phone" value="" placeholder="Điện thoại di động">
                        <span id="error_phone" class="required errorName_vi"></span>
                    </div>
                </label>
                <label class="form_label form_city" id="label_ord_city">
                    <i class="icon_form_paymentBill ion-ios-home-outline" aria-hidden="true"></i>
                        <div class="form_city">
                            <div class="form_input">
                                <select name="order_city" id="order_city" class="form-control form_select"
                                        onchange="loadDistrict('order_city','order_nCity',0)" style="margin-left: 25px">
                                    <option value="">Thành Phố</option>
                                    <? foreach ($arrType as $key => $nCit) { ?>
                                        <option title=""
                                                value="<?= $key ?>"<?= ($key == $city) ? "selected='selected'" : "" ?>><?= $nCit ?></option>
                                    <? } ?>
                                </select>
                            </div>
                            <span id="error" class="required errorName_vi"></span>
                        </div>
                        <div class="form_district">
                            <div class="form_input">
                                <select name="order_nCity" id="order_nCity" class="form-control form_select"
                                        style="margin-left: 15px">
                                    <option value="">Quận huyện</option>
                                </select>
                            </div>
                            <span id="error" class="required errorName_vi"></span>
                        </div>
                </label>
                <label class="form_label" id="label_ord_address">
                    <div class="form_input">
                        <input style="margin-left: 35px" type="text" name="order_address" id="order_address" value=""
                               placeholder="Số nhà, đường phố, toà nhà, ...">
                    </div>
                    <span id="error_address" class="required errorName_vi"></span>
                </label>

            </div>
            <div class="checkout_line"></div>
        </div>
    </div>
</div>
</body>
</html>

