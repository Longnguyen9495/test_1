$(document).ready(function(){
	// Khi chọn 1 phương thức thanh toán
	$(".payment_method_detail input.payment_radio").click(function(){
		$(".payment_method_detail .name").removeClass("bold");
		$(this).parents(".payment_method_detail").find(".name").addClass("bold");
		$(".payment_method_detail .data").hide();
		//$(".payment_method_detail .title").hide();
		$(this).parents(".payment_method_detail").find(".data").show();
		//this).parents(".payment_method_detail").find(".title").show();
	});

	$(".payment_method_detail .bank_orther .bank img").click(function(){
		$(".payment_method_detail .bank_orther .bank img").removeClass("selected");
		$(this).addClass("selected");
	});

	// Ẩn thông báo thanh toán qua BK
	$(".payment_method_notify_close").click(function(){
		$(".payment_method_notify").animate({	
			height: 'toggle'
		}, 300, function(){
		});

		SetCookie('close_paymentBK', 1, 1);
	});
});


/* Hiển thị input nhập số lượng SP */
function show_recount_cart(estore, tt){
	estore	= parseInt(estore, 10);
	tt			= parseInt(tt, 10);
	$("#show_recount_"+estore+"_"+tt).addClass('show_recount');
	$("#show_recount_"+estore+"_"+tt).find('input').val();
	$("#show_recount_"+estore+"_"+tt).find('button').show();
	$("#show_recount_"+estore+"_"+tt).find('a').show();
}

/* Ẩn input nhập số lượng SP */
function hiderecount(estore, tt){
	estore	= parseInt(estore, 10);
	tt			= parseInt(tt, 10);
	quantity	= parseInt($("#show_recount_"+estore+"_"+tt).find('input').attr('lang'), 10);
	$("#show_recount_"+estore+"_"+tt).removeClass('show_recount');
	$("#show_recount_"+estore+"_"+tt).find('button').hide();
	$("#show_recount_"+estore+"_"+tt).find('a').hide();
	$("#show_recount_"+estore+"_"+tt).find('input').val(quantity);

}

// Show from edit user
function show_form_user(){
	$("#user_content").attr("iData", 0); // Bắt buộc click hoàn tất mới được thực hiện
	$("#user_info_edit").css('display', 'block');
	$(".show_form_user").hide();
	$("#cancel_user_info").show();
}

//hide from edit user
function hide_form_user(){
	$("#user_content").attr("iData", 1);
	$(".show_form_user").show();
	$("#cancel_user_info").hide();
	$("#user_info_edit").hide();
}

//Edit user
function edit_user_info(){
	var use_name		= $("#use_name").val();
	var use_phone		= $("#use_phone").val();
	var use_state		= $("#use_state").val();
	var use_address	= $("#use_address").val();

	$("#warning_add_user_info").css('color', "#FF1C1C");
	if($("#use_name").val() === "") {
      $("#warning_add_user_info").html("Vui lòng nhập họ tên !");
      $("#use_name").focus();
      return false;
   } else if($("#use_phone").val() === "") {
      $("#warning_add_user_info").html("Vui lòng nhập số điện thoại !");
      $("#use_phone").focus();
      return false;
   } else if(use_state == undefined || use_state <= 0){
   	$("#warning_add_user_info").html("Vui lòng chọn quận huyện!");
      return false;
   }else if($("#use_address").val() === "") {
      $("#warning_add_user_info").html("Vui lòng nhập địa chỉ!");
      $("#use_address").focus();
      return false;
   } else{
		$.ajax({
			type: 'POST',
			url: "/ajax_v6/ajax_edit_user.php",
			data: {name: use_name, phone: use_phone, state: use_state, address: use_address},
			success: function(json){

				if(json.code == 1){
					hide_form_user();
					$("#user_content").html(json.html);
					alert(json.msg);
					$("#report_error").html("");
					$("#report_error").hide();
					// Tính lại phí vận chuyển nếu sử dụng thông tin user trùng với thông tin người nhận
					use_info_buyer	= $("#uso_use_info_buyer").val();
					if(use_info_buyer == 1){
						check_fee_transport("#use_state");	
					}
				}else{
					$("#warning_add_user_edit").html(json.msg);
				}
			},
			dataType: 'json'
		});
   }
}

function cancel_edit_user_friend(id){
	$("#cancel_addfriend_" + id).hide();
	$("#edit_user_addfriend_" + id).show();
	$("#form_add_user_friend_" + id).html("");
}

/* Function lấy html của form add */
function show_form_user_friend(id){
	id	= parseInt(id, 10);
	if(id > 0){
		$("#edit_user_addfriend_" + id).hide();
		$("#cancel_addfriend_" + id).show();
	}
	$.ajax({
		type: 'POST',
		url: "/ajax_v6/ajax_form_user_friend.php",
		data: {id: id},
		success: function(json){
			$(".form_add_user_friend").html("");
			$("#form_add_user_friend_" + id).html(json.html);
		},
		dataType: 'json'
	});
}

/* Function thêm mới hoặc edit một user friend */
function add_user_friend(id){

	var usf_id			= parseInt(id, 10);
	var usf_name		= $("#usf_name").val();
	var usf_email		= $("#usf_email").val();
	var usf_phone		= $("#usf_phone").val();
	var usf_state		= $("#usf_state").val();
	var usf_address	= $("#usf_address").val();
	var usf_security	= $("#usf_security").val();

	$("#warning_add_user_friend").css('color', "#FF1C1C");
	if($("#usf_name").val() === "") {
      $("#warning_add_user_friend").html("Bạn chưa nhập họ tên !");
      $("#usf_name").focus();
      return false;
   } else if($("#usf_email").val() === "") {
      $("#warning_add_user_friend").html("Bạn chưa nhập email !");
      $("#usf_email").focus();
      return false;
   } else if($("#usf_phone").val() === "") {
      $("#warning_add_user_friend").html("Bạn chưa nhập số điện thoại !");
      $("#usf_phone").focus();
      return false;
   } else if($("#usf_state").val() === "") {
      $("#warning_add_user_friend").html("Bạn chưa nhập quận huyện !");
      return false;
   } else if($("#usf_address").val() === "") {
      $("#warning_add_user_friend").html("Bạn chưa nhập địa chỉ nhận hàng !");
      $("#usf_address").focus();
      return false;
   } else if($("#usf_security").val() === "") {
      $("#warning_add_user_friend").html("Bạn chưa nhập mã bảo mật !");
      $("#usf_security").focus();
      return false;
   }else {
		$.ajax({
			type: 'POST',
			url: "/ajax_v6/ajax_add_user_friend.php",
			data: {id: usf_id, name: usf_name, email: usf_email, phone: usf_phone, state: usf_state, address: usf_address, security: usf_security},
			success: function(json){

				if(json.code == 1){

					if(usf_id == 0){
						$(".user_friend_list").append(json.html);
					}
					$("#user_friend_detail_"+ usf_id).html(json.html);
					$("#edit_user_addfriend_" + usf_id).show();
					$("#cancel_addfriend_" + usf_id).hide();
					$("#form_add_user_friend_" + usf_id).html("");

					select_user_friend(json.id);

				}else{
					$("#warning_add_user_friend").html(json.msg);
				}
				// Thay đổi giá trị hiển thị của Session security
				//$(".security_code_cart").html("<img src='/vn/securitycode.php?rand=" + Math.random() + "' align='absmiddle' />");
			},
			dataType: 'json'
		});
   }
}

/* Function xoa 1 user friend */
function delete_user_friend(id){
	id	= parseInt(id, 10);
	if(confirm('Bạn chắc chắn muốn xóa địa chỉ này?')){
		if(id){
				$.ajax({
				type: 'POST',
				url: "/ajax_v6/ajax_delete_user_friend.php",
				data: {id: id},
				success: function(json){
					if(json.code == 1){
						alert(json.msg);
						var uso_user_friend	= $('input[name=uso_user_friend]:checked').val();
						if(uso_user_friend == id){
							$("#select_user_friend").hide();
							SetCookie('uso_user_friend', 0, 1);
						}
						$("#user_friend_detail_" + id).html('');
						$("#user_friend_detail_" + id).hide();
					}else{
						alert(json.msg);
					}
				},
				dataType: 'json'
			});
		}
	}
}

/* Function ẨN/HIỆN thanh toán tại nhà nếu khách nhận hàng ngoại tỉnh */
/* cart_city: city của đơn hàng/sản phẩm, cityRoot: City của địa chỉ nhận hàng
*/
function hidePaymentHome(cart_city, cityRoot){
	// Nhận hàng ngoài khu vực -> ẩn
	if(cart_city != cityRoot){
		$("#pmb_method_8").parent(".payment_method_detail").hide();
		$("#pmb_method_8").attr("checked", false);
		bank_id = $('#bank_id').val();
		if(bank_id == "home"){
			$('#bank_id').val('');
		}
	}else{
		// Show lại
		$("#pmb_method_8").parent(".payment_method_detail").show();
	}
}

/* Function chọn 1 user friend làm thông  tin nhận hàng */
/* id: id cua dia chi, received = 0(nhan hang tai cucre -> khong tinh phi)
*/
function select_user_friend(id){
	id	= parseInt(id);
	if(id){
		$("#form_add_user_friend").html('');
		SetCookie('uso_user_friend', id, 1);
		$("#uso_user_friend").val(id);
		var received	= $("#payment_container").attr("iRecei");
		var estore		= $("#payment_container").attr("iStore");
		var record		= $("#payment_container").attr("iRecord");
		var quantity	= $("#payment_container").attr("iQuantity");
		var cart_city	= $("#payment_container").attr("iCartCity"); // City của đơn hàng
		var cityRoot	= $("#uso_user_friend_" + id).attr('iCit'); // City địa chỉ nhận hàng
		
		// Ản thanh toán tại nhà nếu nhận hàng ngoài khu vuc
		//hidePaymentHome(cart_city, cityRoot);
		
		// Nếu là nhận hàng tại nhà thì tính phí vận chuyển
		if(received == 1 && (estore > 0 || record)){
			// Show loading
			showloading();
			
			// Tính phí vận chuyển
			$.ajax({
				url: "/ajax_v6/ajax_fee_transport.php",
				type: "POST",
				data:{estore_id: estore, record_id: record, quantity: quantity},
				success: function(json){
					if(json.code != 1){
						alert(json.html);
						return false;
					}
					$("#paymentFeeTransport").html(json.html);
					$("#paymentFeeTransport").attr("iData", json.code);
					$(".user_friend_detail .errorMsg").hide();
					$("#user_friend_fee_transport").html(addCommas(json.money) + 'đ');
					/*$("#user_friend_fee_transport_" + id).show();*/

					/*---- Tính lại giá trị thanh toán khi sử dụng tài khoản baokim --*/
					total_money					= parseInt($("#total_value").attr("iData"), 10);

					// Gán lại giá trị phí vận chuyển
					fee_transport		= parseInt($("#paymentFeeTransport span").attr("iData"), 10);
					// Giá trị đơn hàng ở cột right
					$("#total_value").html(addCommas(total_money + fee_transport) + "đ");
					
					// Tính lại tiền
					check_money_baokim();
					
					// Hide loading
					hideloading();

				},
				dataType: "json"
			});
		}
	}
}

// Hàm tính phí vận chuyển khi user chọn quận huyện
function check_fee_transport(obj){
	
	var received		= $("#payment_container").attr("iRecei");
	var estore			= $("#payment_container").attr("iStore");
	var record			= $("#payment_container").attr("iRecord");
	var quantity		= $("#payment_container").attr("iQuantity");
	var distric			= $(obj).val();
	
	var cart_city	= $("#payment_container").attr("iCartCity"); // City của đơn hàng
	var cityRoot	= $("#use_city").val(); // City địa chỉ nhận hàng
	//hidePaymentHome(cart_city, cityRoot);
			
	// Nếu là nhận hàng tại nhà thì tính phí vận chuyển
	if(received == 1 && (estore > 0 || record > 0)){
		//$('#load_transport').show();
		showloading();
		// Post thông tin để lấy phí vận chuyển
		$.post(
				'/ajax_v6/ajax_fee_transport.php',
				{estore_id: estore, record_id: record, quantity: quantity, use_distric: distric},
				function(data){
					if(data.code != 1){
						alert(data.html);
						$('#load_transport').hide();
						return false;
					}else{						
						$("#paymentFeeTransport span").attr("iData", data.money);
						check_money_baokim();
						
						hideloading();
					}
				},
				'json'
			);
	}
}

function set_id_bank(id, name, bank_name, payment_key){

	$("#bank_id").val(id);
	$("#method_name").val(name);
	$("#bank_name").val(bank_name);
	$("#payment_key").val(payment_key);
	SetCookie('payment_key', payment_key, 1);
	SetCookie('bank_id', id, 1);
	SetCookie('method_name', name, 1);
	SetCookie('bank_name', bank_name, 1);
	
	// reset sử dụng tài khoản thưởng
	if(id != "bk"){
		SetCookie("account_promotion_use", 0);
		selectAccountPromotion(0);
		$("input[name='bk_account_promotion']:checked").each(function(){
			$(this).attr("checked", false);
		});
	}else{
		check_money_baokim();
	}
	
	// Show box hướng dẫn thanh toán qua BK nếu kh chọn hình thức thanh toán ko phải bảo kim và kh chưa chọn đóng box thông báo
	var check_closeBK = GetCookie('close_paymentBK');	
	if(id != 'bk' && check_closeBK == null){
		$(".payment_method_notify").show();
	}else{
		$(".payment_method_notify").hide();
	}	
}	
/**
 * [showFeeTransport Xu ly khi chon nhan hang tai cung dia chi hay khong]
 * @param  {[type]} id          [id tai khoan thuong]
 */
function showFeeTransport(fee){
	$("#paymentFeeTransport span").attr("iData", fee);
	// Tính lại tiền
	check_money_baokim();
}

/**
 * [showValuePay Show gia tri thanh toan, phi van chuyen, so tien khuyen mai o cot thanh toan]
 * @param  {[type]} id          [id tai khoan thuong]
 */
function showValuePay(total_pay, fee, amount_bk, money_promotion_other){

	if(total_pay < 0) total_pay = 0;
	// Gán lại giá trị phí vận chuyển
	$('#user_friend_fee_transport').html(addCommas(fee) + 'đ');
	$("#total_pay").html(addCommas(total_pay) + "đ");
	if(money_promotion_other > 0){
		$("#total_promotion_other").html("-" + addCommas(money_promotion_other) + "đ");
		$("#text_total_promotion_other").show();
	}else{
		$("#total_promotion_other").html(addCommas(money_promotion_other) + "đ");
		$("#text_total_promotion_other").hide();
	}
	// Set tiền cho tài khoản khuyến mại bảo kim(cột thanh toán)
	if(amount_bk > 0){
		$('#total_promotion').html('-' + addCommas(amount_bk) + "đ");
		$("#text_total_promotion_baokim").show();	
	}else{
		$('#total_promotion').html(addCommas(amount_bk) + "đ");
		$("#text_total_promotion_baokim").hide();
	}
	
	// Ẩn 
}

function remove_id_bank(payment_key){
	set_id_bank("", "", "", payment_key);
	var check_closeBK = GetCookie('close_paymentBK');
	if(check_closeBK == null){
		$(".payment_method_notify").show();
	}	
}

function selectAccountPromotion(id){
	SetCookie("account_promotion_use", id, 1);
	// ID tài khoản thưởng sử dụng
	$("#account_bk_promotion").val(id);
	if(id > 0){
		$("#bk_account_promotion_0").attr("checked", "checked");
	}else{
		// Nếu đã chọn 1 tài khoản thưởng thì bỏ check
		if($("input[name='bk_account_promotion']:checked").length > 0){
			$("input[name='bk_account_promotion']:checked").each(function(){
				$(this).attr("checked", false);
			});
		}else{ // Chưa chọn tài khoản nào, và nếu chỉ có 1 tài khoản thưởng thì check sử dụng tài khoản này luôn
			if($("input[name='bk_account_promotion']").length == 1){
				$("input[name='bk_account_promotion']").trigger("onclick");
				$("input[name='bk_account_promotion']").attr("checked", true);
			}
		}
	}
	
	check_money_baokim();
}

/**
 * [check_money_baokim Thong tin TK baokim khi mua hang]
 * @param  {[type]} id          [id tai khoan thuong]
 */
function check_money_baokim(){
	
	// Lấy id tài khoản thưởng sử dụng
	var id = $("#account_bk_promotion").val();
	
	// Lấy phương thức thanh toán
	var methodPay	= $('#bank_id').val();
	
	// Số tiền khuyến mại bảo kim sử dụng
	var money_promotion_use	= 0;
	
	// Số tiền vpoint sử dụng
	var money_vpoint	= 0;
	if(methodPay == "bk"){
		money_promotion_use	= $("#bk_account_promotion_" + id).attr('lang');
		money_vpoint			= $("#amount_vpoint").val();
	}
	
	if(money_promotion_use != undefined && money_promotion_use != "undefined" && !isNaN(money_promotion_use)){
		money_promotion_use	= parseInt(money_promotion_use, 10);
	}else{
		money_promotion_use	= 0;
	}
	
	if(money_vpoint != undefined && money_vpoint != "undefined" && !isNaN(money_vpoint)){
		money_vpoint	= parseInt(money_vpoint, 10);
	}else{
		money_vpoint	= 0;
	}
	
	// Giá trị tiền vpoint post đi
	$("#amount_bk_promotion").val(money_vpoint);
	
	// Giá trị đơn hàng chưa bao gồm phí vận chuyển và chưa sử dụng tài khoản khuyến mại
	total_money	= parseInt($("#total_value").attr("iData"), 10);

	// Lấy phí vận chuyển 
	var money_fee_transport		= 0;
	money_fee_transport			= $("#paymentFeeTransport span").attr("iData");
	if(money_fee_transport != undefined && money_fee_transport != "undefined"){
		money_fee_transport	= parseInt(money_fee_transport, 10);
	}else{
		money_fee_transport	= 0;
	}
	
	// Lấy tiền khuyến mại khác
	var money_promotion_other	= $("#total_promotion_other").attr("lang");
	if(money_promotion_other != undefined && money_promotion_other != "undefined"){
		money_promotion_other	= parseInt(money_promotion_other, 10);
	}else{
		money_promotion_other	= 0;
	}
	
	// Mua hàng không đăng nhập thì return luôn
	if(user_logged != 1){
		money_pay	= parseInt((total_money + money_fee_transport - money_promotion_other), 10);
		// Giá trị thanh toán ở cột right
		showValuePay(money_pay, money_fee_transport, 0, money_promotion_other);
		return true;
	}
	
	// Lấy tài khoản chính
	var money_balance	= $('#money_balance').attr("lang");
	if(money_balance != undefined && money_balance != "undefined"){
		money_balance	= parseInt(money_balance, 10);
	}else{
		money_balance	= 0;
	}

	// Số tiền cần thanh toán
	money_pay			= parseInt((total_money + money_fee_transport - money_promotion_use - money_vpoint - money_promotion_other), 10);
	money_promotion	= money_promotion_use + money_vpoint;
	// Giá trị thanh toán ở cột right
	showValuePay(money_pay, money_fee_transport, money_promotion, money_promotion_other);
	
	if(money_pay <= money_balance){

		$("#alert_money_baokim").html("");
		$("#status_payment_baokim").val(1);
		$("#alert_money_baokim").html("Chú ý: Số tiền thanh toán chưa bao gồm phí giao dịch");
	}else{
		
		$("#alert_money_baokim").html("Tài khoản của quý khách không đủ. Vui lòng <a href='https://www.baokim.vn/transactions/charges' target='_blank' style='text-decoration:underline;'>nạp tiền </a> để thanh toán");
		$("#alert_money_baokim").attr("lang", "Tài khoản của quý khách không đủ. Vui lòng nạp tiền để thanh toán");
		$("#status_payment_baokim").val(0);
	}
}

function changeAmountPromotion(){
	
	// Số vpoint sử dụng
	var money_vpoint_use	= $("#amount_vpoint").val();
	//alert(money_vpoint_use);
	if(money_vpoint_use != "" && money_vpoint_use != undefined && money_vpoint_use != "undefined" && !isNaN(money_vpoint_use)){
		money_vpoint_use	= parseInt(money_vpoint_use, 10);
	}else{
		money_vpoint_use	= 0;
	}
	
	// Số vpoint hiện có
	var money_vpoint		= $("#money_vpoint").attr('lang');
	if(money_vpoint != undefined && money_vpoint != "undefined"){
		money_vpoint	= parseInt(money_vpoint, 10);
	}else{
		money_vpoint	= 0;
	}
	if(money_vpoint_use > money_vpoint){
		money_vpoint_use = money_vpoint;
	}
	
	$("#amount_vpoint").val(money_vpoint_use);
	check_money_baokim();
	
	if(money_vpoint_use > 0){
		$("#convert_money_promotion").html("= " + addCommas(money_vpoint_use));		
	}else{
		$("#convert_money_promotion").html("= 0");
	}
	
}

function check_promotion_ecoupon(name_object){
	var ecoupon	= $(name_object).val();
	if(typeof(ecoupon) != "undefined" && ecoupon != ""){
		$.ajax({
			url: "/ajax_v6/ajax_check_promotion_ecoupon.php",
			data: {ecoupon: ecoupon},
			type: "POST",
			success:function(json){
				if(json.code == 1){
					alert("Đơn hàng của quý khách được giảm " + addCommas(json.html) + "đ");
					$("#total_promotion_other").attr("lang", json.html);
					/* 
						Set cookie mã coupon để khi sang bên trang thanh toán sẽ tự động fill vào ô mã giảm giá nếu có
						rồi sẽ tự động xóa mã đi khi đơn hàng thành công
					*/
					SetCookie('code_promotion_ecoupon', ecoupon, 1);
				}else{
					$("#total_promotion_other").attr("lang", 0);
					alert(json.html);
				}
				
				// Show lai tiền
				check_money_baokim();
			},
			dataType: "json"
		});
	}else{
		alert("Vui lòng nhập mã khuyến mại!");
		$("#uso_promotion").focus();
		return false;
	}
}