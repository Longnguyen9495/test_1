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
            padding: 0 18px 0 0;
            color: #404040;
            font-size: 14px;
            border-radius: 0;
            outline: none;
            width: 100%;
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
            padding-left: 30px;
            display: block;
            position: relative;
        }

        .form_input > .form_select {
            width: 50%;
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
                    <i class="ion-ios-person-outline" aria-hidden="true"></i>
                    <span class="form_input">
                    <input type="tel" name="ord_name" id="ord_name" value="" placeholder="Họ tên người nhận">
                </span>
                </label>
                <label class="form_label" id="label_ord_phone">
                    <i class="ion-ios-telephone-outline" aria-hidden="true"></i>
                    <span class="form_input">
                    <input type="tel" name="ord_phone" id="ord_phone" value="" placeholder="Điện thoại di động">
                </span>
                </label>
                <label class="form_label form_city" id="label_ord_city">
                    <i class="ion-ios-home-outline" aria-hidden="true"></i>
                    <span class="form_input">
                   <select name="ord_city" id="ord_city" class="form_select">
                       <option value="0">Tỉnh thành phố</option>
                       <option value="5">Hà Nội</option>
                       <option value="7">Hồ Chí Minh</option>
                       <option value="6">Đà Nẵng</option>
                       <option value="56">An Giang</option>
                       <option value="67">Bà Rịa - Vũng Tàu</option>
                       <option value="148">Bắc Cạn</option>
                       <option value="85">Bắc Giang</option>
                       <option value="731">Bạc Liêu</option>
                       <option value="76">Bắc Ninh</option>
                       <option value="138">Bến Tre</option>
                       <option value="104">Bình Định</option>
                       <option value="96">Bình Dương</option>
                       <option value="116">Bình Phước</option>
                       <option value="127">Bình Thuận</option>
                       <option value="235">Cà Mau</option>
                       <option value="157">Cần Thơ</option>
                       <option value="245">Cao Bằng</option>
                       <option value="686">Đắc Lắc</option>
                       <option value="715">Đắc Nông</option>
                       <option value="739">Điện Biên</option>
                       <option value="212">Đồng Nai</option>
                       <option value="700">Đồng Tháp</option>
                       <option value="259">Gia Lai</option>
                       <option value="277">Hà Giang</option>
                       <option value="289">Hà Nam</option>
                       <option value="296">Hà Tĩnh</option>
                       <option value="309">Hải Dương</option>
                       <option value="322">Hải Phòng</option>
                       <option value="723">Hậu Giang</option>
                       <option value="338">Hoà Bình</option>
                       <option value="349">Hưng Yên</option>
                       <option value="167">Khánh Hòa</option>
                       <option value="360">Kiên Giang</option>
                       <option value="376">Kon Tum</option>
                       <option value="386">Lai Châu</option>
                       <option value="394">Lâm Đồng</option>
                       <option value="407">Lạng Sơn</option>
                       <option value="186">Lào Cai</option>
                       <option value="419">Long An</option>
                       <option value="224">Nam Định</option>
                       <option value="434">Nghệ An</option>
                       <option value="455">Ninh Bình</option>
                       <option value="464">Ninh Thuận</option>
                       <option value="472">Phú Thọ</option>
                       <option value="486">Phú Yên</option>
                       <option value="496">Quảng Bình</option>
                       <option value="504">Quảng Nam</option>
                       <option value="523">Quảng Ngãi</option>
                       <option value="196">Quảng Ninh</option>
                       <option value="537">Quảng Trị</option>
                       <option value="548">Sóc Trăng</option>
                       <option value="560">Sơn La</option>
                       <option value="572">Tây Ninh</option>
                       <option value="582">Thái Bình</option>
                       <option value="591">Thái Nguyên</option>
                       <option value="601">Thanh Hoá</option>
                       <option value="177">Thừa Thiên Huế</option>
                       <option value="629">Tiền Giang</option>
                       <option value="640">Trà Vinh</option>
                       <option value="649">Tuyên Quang</option>
                       <option value="657">Vĩnh Long</option>
                       <option value="666">Vĩnh Phúc</option>
                       <option value="676">Yên Bái</option>
                   </select>
                        <!--                    <i class="form_tick flaticon-v9_checkout_tick"></i>-->
                </span>
                </label>
                <label class="form_label form_district" id="label_ord_district">
                <span class="form_input">
                   <select name="ord_district" id="ord_district" class="form_select">
                       <option value="0">Quận huyện</option>
                   </select>
                    <i class="form_tick flaticon-v9_checkout_tick"></i>
                </span>
                </label>
                <label class="form_label" id="label_ord_address">
                    <i class=""></i>
                    <span class="form_input">
                    <input type="text" name="ord_address" id="ord_address" value=""
                           placeholder="Số nhà, đường phố, toà nhà, ...">
                    <i class="form_tick flaticon-v9_checkout_tick"></i>
                </span>
                </label>
            </div>
            <div class="checkout_line"></div>

        </div>
    </div>
</div>

</body>
</html>