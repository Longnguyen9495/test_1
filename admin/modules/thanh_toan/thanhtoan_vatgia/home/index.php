<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>
<body>
<form action="" method="POST" name="">
    <div class="" id="">
        <? include("../includes/inc_payment_user.php"); ?>
    </div>

    <div class="paymentMethod fl hidden" id="inc_payment_method_c2c">
        <? include("../includes/inc_payment_method.php"); ?>
    </div>
1
    <div class="customerInfo">
        <? include("../includes/inc_payment_bill.php"); ?>
    </div>

    <div style="position: fixed; bottom: 0px; background: #FFFFFF; z-index: 10; width: 100%; left: 0px; border-top: 1px solid #dcdcdc; box-shadow: 0px -1px 3px #999;">
        <input type="hidden" name="action" value="themmoi">


        <input type="hidden" name="bank_payment_method" id="bank_payment_method" value="<?= $bank_payment_method ?>">
        <input type="hidden" name="payment_method_baokim" id="payment_method_baokim"
               value="<?= $payment_method_baokim ?>">
        <input type="hidden" name="baokim_payment" id="baokim_payment" value="1">

        <div class="box_btn">
            <div class="staf">
                <b>Tổng:</b>
                <span class="price" id="total_price" data-price="60285000" data-fee_cod="510700"
                      data-fee_shipping="265700"><?= format_number($order_total_money) ?>₫</span>
            </div>
            <button id="pmt_button" class="pmt_button" onclick="return checkFormPayment();">Tiếp tục</button>
        </div>
    </div>
</form>
</body>
</html>