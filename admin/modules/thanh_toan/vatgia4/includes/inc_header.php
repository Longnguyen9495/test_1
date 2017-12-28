<div id="home">
    <div class="process_bar">
        <div class="process_step center active">
            <i class="fa fa-pencil" aria-hidden="true"></i>
            <span class="process_text">Nhập thông tin</span>
        </div>
        <div class="process_step ">
            <i class="fa fa-credit-card" aria-hidden="true"></i>
            <span class="process_text">Thanh toán</span>
            <div class="process_line"><div></div></div>
        </div>
        <div class="process_step ">
            <i class="fa fa-check" aria-hidden="true"></i>
            <span class="process_text">Thành công</span>
            <div class="process_line"><div></div></div>
        </div>
</div>
    <form method="post" id="form_step_1" action="">
    <div class="checkout_title">
        Thông tin đặt hàng
    </div>
    <div class="checkout_address" id="user_address">
        <div class="address" id="address">
            <b>Long Nguyễn</b><br>
            <span>batuocbongdem_doncoi_1995@yahoo.com</span><br>
            <label class="ord_address_show" for="edit_user_address">
                <i class="flaticon-edit"></i>
                <span></span><br>
                <span></span>
            </label>
            <div class="ord_address_form">
                <label class="form_label" id="label_ord_phone">
                    <input type="hidden" name="ord_ua_id" id="ord_ua_id" value="0">
                </label>
                <label class="form_label" id="label_ord_phone">
                    <input type="hidden" name="ord_name" id="ord_name" value="Long Nguyễn">
                </label>
                <label class="form_label" id="label_ord_phone">
                    <input type="hidden" name="ord_email" id="ord_email" value="batuocbongdem_doncoi_1995@yahoo.com">
                </label>
                <label class="form_label" id="label_ord_phone">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                <span class="form_input">
                    <input type="tel" name="ord_phone" id="ord_phone" value="" placeholder="Điện thoại di động" onchange="validateFormPhone('#ord_phone','#label_ord_phone')">
                    <i class="form_tick flaticon-v9_checkout_tick"></i>
                </span>
                </label>
                <label class="form_label form_city" id="label_ord_city">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span class="form_input">
                   <select name="ord_city" id="ord_city" class="form_select" onchange="loadDistrict(this,'#ord_district');checkEchange();validateCityDistrict('#ord_city','#label_ord_city')">
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
                    <i class="form_tick flaticon-v9_checkout_tick"></i>
                </span>
                </label>
                <label class="form_label form_district" id="label_ord_district">
                <span class="form_input">
                   <select name="ord_district" id="ord_district" class="form_select" onchange="loadShipping();validateCityDistrict('#ord_district','#label_ord_district')">
                       <option value="0">Quận huyện</option>
                   </select>
                    <i class="form_tick flaticon-v9_checkout_tick"></i>
                </span>
                </label>
                <label class="form_label" id="label_ord_address">
                    <i class=""></i>
                <span class="form_input">
                    <input type="text" name="ord_address" id="ord_address" value="" placeholder="Số nhà, đường phố, toà nhà, ..." onchange="validateFormText('#ord_address','#label_ord_address')">
                    <i class="form_tick flaticon-v9_checkout_tick"></i>
                </span>
                </label>
            </div>
            <div class="checkout_line"></div>

        </div>
    </div>
    <div class="checkout_title">Đơn hàng của bạn</div>
    <div class="checkout">
        <div class="checkout_text">
            <span>đăng bởi:<strong>Nguyen Thanh Tung</strong></span><img src="">
            <i>Ngày tham gia: 22/07/2017</i>
        </div>
        <div class="img_user"><img src="../css/images/icon_black.png"></div>
    </div>
    <div class="sanpham">
        <div class="img_sanpham"><img src="../css/images/pic.png"></div>
        <p class="sanpham_text">Chân máy giặt - tủ lạnh inox Cảnh Phong</p><span class="text_color">12.000.000đ</span>
    </div>
    <div class="checkout_button_boder">
        <div class="checkout_button">
                <label class="checkout_btn" onclick="submitStep1()">Tiếp tục</label>
                <span class="total_btn">Tổng: <span id="total_price">6.022.000₫</span></span>
        </div>
    </div>