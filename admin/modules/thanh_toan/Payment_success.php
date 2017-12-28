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
            padding: 0px 35px;
        }

        .process_line > div {
            width: 100%;
            height: 100%;
            background: #fbb999;
        }

        .process_step.active .process_text {
            color: #F44f00;
        }

        .process_step > span {
            display: block;
            color: #f44f00;
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
            background-position: 0 0px;
            background-size: 150px;
        }

        .process_step .pay {
            background-image: url(icon_new.png);
            background-position: -50px 0px;
            background-size: 150px;
        }

        .process_step .success {
            background-image: url(icon_new.png);
            background-position: -100px 0px;
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

        .form_input input {
            vertical-align: middle;
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
            border-bottom: 1px #c2c2c263 solid;
        }

        .checkout_text i {
            font-size: 13px;
            color: #c2c2c2;
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
            width: 100%;
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
            text-transform: uppercase;
        }
        .checkout_button a{
            text-decoration: none;
            color: white;
        }

        .checkout_btn i {
            padding-right: 10px;
            font-size: 20px;
            vertical-align: middle;
        }

        #form_step_1 {
            text-align: center;
            color: #333;
        }

        #form_step_1 .img_success {
            text-align: center;
            margin: 15px 0;
        }

        #form_step_1 .text_t1 {
            font-size: 25px;
            font-weight: 600;
            line-height: 30px;
        }

        #form_step_1 .text_t2 {
            font-size: 14px;
            color: #777;
            line-height: 25px;
        }

        #form_step_1 .text_t2 span {
            color: #333;
        }

        #form_step_1 .line {
            width: 90%;
            height: 1px;
            background: #3333332e;
            margin: 15px auto;
        }

        #form_step_1 .text_h1 {
            font-size: 16px;
            line-height: 35px;
        }

        #form_step_1 .title {
            width: 80%;
            margin: 0 auto;
            font-size: 14px;
            color: #777;
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
            <span class="process_text">Thanh toán</span>
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
        <div class="img_success">
            <img src="logo2.png" alt="">
        </div>
        <span class="text_t1">Đặt hàng thành công !</span>
        <p class="text_t2">Mã đơn hàng: <span>txnc2002_306634519</span></p>
        <div class="line"></div>
        <h3 class="text_h1">Xin chúc mừng bạn đã đặt hàng thành công</h3>
        <p class="title">Số tiền thanh tóa sẽ được tạm giữ bởi Báo Kim, số tiền này sẽ được chuyển cho người bán khi
            giao dịch hoàn tất. Hoặc sẽ được trả về tài khoản ngân hàng của bạn trong trường hợp giao dịch không được
            thực hiện</p>
        <div class="checkout_button_boder">
            <div class="checkout_button">
                <a href="info.php">
                <label class="checkout_btn" onclick="submitStep1()"><i class="ion-ios-home-outline"></i>Quay Về Trang
                    Chủ</label></a>
            </div>
        </div>
    </form>
</div>

</body>
</html>