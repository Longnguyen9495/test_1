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

        .checkout_btn {
            border: none;
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
<div class="inc_header" id="inc_header">
    <? include("../includes/inc_header.php"); ?>
</div>
<form action="" method="POST" name="fromPayment">
    <div class="inc_payment_bill" id="inc_payment_bill">
        <? include("../includes/inc_payment_bill.php"); ?>
    </div>

    <div class="inc_payment_method" id="inc_payment_method">
        <? include("../includes/inc_payment_method.php"); ?>
    </div>
</form>
<div class="checkout_button_boder">
    <div class="checkout_button">
        <button id="" class="checkout_btn" onclick="return submitStep1();"><a href="javascript:;">Tiếp tục</a></button>
        <span class="total_btn">Tổng: <span class="total_price">6.022.000₫</span></span>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    function submitStep1() {

        // check visible

        var paymentBill = $("#inc_payment_bill").is(":visible");

        var paymentMethod = $("#inc_payment_method").is(":visible");

        if (fromPayment) {
            $(paymentBill).hide();
            $(paymentMethod).show();
        }


        // if (paymentMethod) {
        //     var frm = $("form[name='fromPayment']");
        //     /*if(!checkPaymentUser()) return false;*/
        //     frm.find("a.pmt_button span.text").html("Vui lòng đợi...");
        //
        //     frm.submit();
        //
        //     return true;
        // }
        // return false;
    }
</script>