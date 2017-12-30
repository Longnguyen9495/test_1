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
<div class="checkout_button_boder">
    <div class="checkout_button">
        <label class="checkout_btn" onclick="submitStep1()"><a href="Payment_success.php">Tiếp tục</a></label>
        <span class="total_btn">Tổng: <span class="total_price">6.022.000₫</span></span>
    </div>
</div>
</body>
</html>