<?
$record_id  = getValue("recode_id");
$query      = "  SELECT *
            FROM orders_c2c_temp
            WHERE oct_id = " . $record_id . "
            LIMIT 1";
$db_query   = new db_query($query);
?>
<div class="checkout_title">Đơn hàng của bạn</div>
<div class="check_oder">
        <?while ($row = mysql_fetch_assoc($db_query->result)){?>
        <div class="checkout">
            <div class="checkout_text">
                <span>Đăng bởi:<strong><?= $row['oct_seller_id']?></strong></span>
                <i>Ngày tham gia: 22/07/2017</i>
            </div>
            <div class="img_user"><img src=""></div>
        </div>
        <div class="product">
            <div class="img_product">
                <img src="https://mediamyad.vatgia.vn/photo/users_b_upload/2017/12/wrk1513217620.png">
            </div>
            <div class="infomation_product">
                <p class="text_product"><?= $row['oct_product_name']?></p>
                <span></span><br>
                <span class="text_color"><?= number_format($row['oct_product_price'])?> đ </span>
            </div>
        </div>
        <?}?>
    </div>