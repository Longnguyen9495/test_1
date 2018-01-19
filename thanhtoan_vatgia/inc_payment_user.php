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

        .checkout_button a {
            text-decoration: none;
            color: white;
        }

        .checkout_btn i {
            padding-right: 10px;
            font-size: 20px;
            vertical-align: middle;
        }

        #home {
            text-align: center;
            color: #333;
        }

        #home .img_success {
            text-align: center;
            margin: 15px 0;
        }

        #home .text_t1 {
            font-size: 25px;
            font-weight: 600;
            line-height: 30px;
        }

        #home .text_t2 {
            font-size: 14px;
            color: #777;
            line-height: 25px;
        }

        #home .text_t2 span {
            color: #333;
        }

        #home .line {
            width: 90%;
            height: 1px;
            background: #3333332e;
            margin: 15px auto;
        }

        #home .text_h1 {
            font-size: 16px;
            line-height: 35px;
        }

        #home .title {
            width: 80%;
            margin: 0 auto;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
<div id="home">
    <form id="form_step_1">
        <div class="img_success">
            <img src="css/image/logo2.png" alt="">
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
                <a href="">
                    <button class="checkout_btn" onclick="submitStep1()"><i class="ion-ios-home-outline"></i><a
                                href="index.php?recode_id=1">Quay Về
                            Trang
                            Chủ</a></button></a>
            </div>
        </div>
    </form>
</div>
</body>
</html>