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

        /* process_line */
        .process_line {
            width: 50%;
            height: 1px;
            position: absolute;
            left: -25%;
            top: 40px;
        }

        .process_line > div {
            width: 100%;
            height: 100%;
            background: #fbb999;
        }

        .process_bar {
            height: 100px;
        }

        .process_step.active .process_text {
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
            background-image: url(css/image/icon_new.png);
            background-position: 0 0px;
            background-size: 150px;
        }

        .process_step .pay {
            background-image: url(css/image/icon_new.png);
            background-position: -50px -50px;
            background-size: 150px;
        }

        .process_step .success {
            background-image: url(css/image/icon_new.png);
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
    </style>
</head>
<body>
<div id="detail">
    <a class="icon_detail" href=""><i class="ion-chevron-left"></i></a>
    <span class="detail_info">Địa chỉ nhận hàng</span>
</div>
<div class="process_bar">
    <div class="process_step center active">
        <i class="img info"></i>
        <span class="process_text">Nhập thông tin</span>
    </div>
    <div class="process_step ">
        <i class="img pay"></i>
        <span class="process_text pay_text">Thanh toán</span>
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
</body>
</html>