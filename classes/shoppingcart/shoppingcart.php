<?
class shoppingcart{
	//Giá trị hiện hành của giỏ hàng
	var $current_cart			= array();
	var $server_name			= ".yte247.vn";
	/*
	Khởi tạo shopping cart
	$con_currency : Tỉ giá
	*/
	function shoppingcart(){
		//check cookie
		if (isset($_COOKIE["estore"])) $this->current_cart = @json_decode(@base64_decode($_COOKIE["estore"]), 1);
		//Nếu ko phải dạng array thì reset lại giỏ hàng
		if (!is_array($this->current_cart)){
			$this->current_cart = array();
			$this->clearCoookie();
			if(isset($_COOKIE["estore"])) unset($_COOKIE["estore"]);
		}
	}

	/**
	 * Function đưa 1 san pham vao gio hang
	 * shoppingcart::addtocart()
	 *
	 * @param mixed $pro_id     : ID product
	 * @param mixed $quantity   : So luong
	 * @param integer $received : 0->nhan hang tai dia chi dang ky, 1 nhan hang tai quay
	 * @return
	 */
	function addtocart($pro_id, $quantity){

		$return	= 0;
		if($quantity > 10){
			$quantity	= 10;
		}

		// Kiểm tra SP này đã có trong giỏ hàng hay chưa, có rồi return luôn
		//if($this->check_product_incart($pro_id)) return 1;

		if($quantity > 0){
			if(isset($this->current_cart[$pro_id]['quantity']) && $this->current_cart[$pro_id]['quantity'] > 0){

				$this->current_cart[$pro_id]['quantity']+=$quantity;
				
				
			}else{
				$this->current_cart[$pro_id]['quantity']=$quantity;
				
			}
			
			
			 
			//Save cookie
			$this->saveCookie();
			$return	= 1;
		}

		return $return;

	}

	/**
	 * Kiem tra xem san pham nay co trong cart chua
	 * shoppingcart::check_product_incart()
	 *
	 * @param mixed $pro_id
	 * @return void
	 */
	function check_product_incart($pro_id){

		if(isset($this->current_cart[$pro_id])) return 1;
		return 0;
	}

	/**
	 * Tra ve so luong cua san pham trong don hang
	 * shoppingcart::getQuantityDealInCart()
	 *
	 * @param mixed $pro_id : ID product
	 * @return
	 */
	function getQuantityDealInCart($pro_id){

		if(isset($this->current_cart[$pro_id]['quantity'])) return $this->current_cart[$pro_id]['quantity'];
		return 0;
	}

	/**
	 * Lay cac san pham trong gio hàng theo khu vuc(bao gom san pham mua ngay va san pham cho thanh toan)
	 * shoppingcart::getArrayPoinCartInEstore()
	 * @return void
	 */
	function getArrayPoinCart(){

		$array_return	= ($this->current_cart) ? $this->current_cart : array();

		// Đưa các sản phẩm mua sau lên trước
		if($array_return)		$array_return	= array_reverse($array_return, true);

		return $array_return;
	}

	/*
	Recount product
	*/
	/**
	 * shoppingcart::recount()
	 *
	 * @param integer $clear     : 0->recount product, 1->xoa 1 product, 2->xoa gio hang
	 * @param integer $product_id   : ID sản phẩm
	 * @param integer $quantity  : So luong moi
	 * @return void
	 */
	function recount($clear = 0, $product_id = 0, $quantity = 0){

		$clear 		= getValue("clear", "int", "GET", $clear);

		switch ($clear){

			// Xóa 1 sản phẩm
			case 3:
				if($this->current_cart){
					foreach ($this->current_cart as $key => $value){
						$deleteopt = "delete_" . $key;
						// Nếu đây là sản phẩm cần xóa(truyền theo GET hoặc trực tiếp)
						if (isset($_GET[$deleteopt]) || $key == $product_id){
							unset($this->current_cart[$key]);
						}
					}
				}
				break;

			//Clear all
			case 2:
				$this->current_cart = array();
				break;

			//Recount lại 1 sản phẩm
			default:
				//Nếu tồn tại cookie của cửa hàng bắt đầu count lại
				if($this->current_cart){
					foreach($this->current_cart as $key => $value){

						$nQuantity		= 0;
						$nQuantity		= getValue("quantity_". $key, "int", "POST", $value['quantity']);

						// Trường hợp recount 1 sản phẩm theo id truyền vào
						if($key == $product_id && $product_id > 0){
							$nQuantity	= $quantity;
						}

						if ($nQuantity < 0) $nQuantity	= 0;
						if ($nQuantity > 10) $nQuantity	= 10;
						if ($nQuantity > 0){
							$this->current_cart[$key]['quantity']	= $nQuantity;
						}
					}
				}
				break;
		}

		//Save lại cookie
		$this->saveCookie();
	}

	/**
	 * Dem so san pham trong gio hang
	 * shoppingcart::count_product()
	 *
	 * @return
	 */
	function count_product(){
		return count($this->current_cart);
	}

	function getTemplateCart(){
		global $lang_path;
		$html 	= "";
		$arrayProductInCart 	= $this->getArrayPoinCart();
		if(!$arrayProductInCart){
			$html = '<p>Không có sản phẩm nào trong giỏ hàng của bạn. <a class="buy_more" href="javascript:;" onclick="(window.parent.location.href= \'' . $lang_path . '\');">Mua thêm sản phẩm khác <i class="icon_next"></i></a></p>';
			return $html;
		}
		$db_query	= new db_query("SELECT * FROM products WHERE pro_id IN (" . convert_array_to_list(array_keys($arrayProductInCart)) . ")");
		$html 	.= '<table width="100%" cellpadding="8" cellspacing="0" border="0">
							<tr class="th" style="font-weight:bold;">
								<td>Sản phẩm</td>
								<td width="100" align="center">Giá</td>
								<td width="80" align="center">Số lượng</td>
								<td width="100" align="center">Tổng cộng</td>
							</tr>
						</table>';

		$html 	.= '<div id="box_product" class="box_product" style="margin-top: 4px;">
							<table width="100%" cellpadding="6" cellspacing="0" border="0">';
							$stt_product 	= 0;
							$total_money	= 0;
							while ($row = mysql_fetch_assoc($db_query->result)) {
								$stt_product++;
								$bg_color 		=  ($stt_product % 2) == 0 ? '#FFFFFF' : '#f7f7f7';
								$total_money	+= $arrayProductInCart[$row['pro_id']]['quantity'] * $row['pro_price'];

								$html 	.=	'<tr bgcolor="' . $bg_color . '">
												<td>
													<p class="pro_name">' . $row['pro_name'] . '</p>
													<p class="delete_product"><a href="javascript:if(confirm(\'Bạn có muốn xóa sản phẩm này không?\')){ recountCart(3, ' . $row['pro_id'] . ', 0); }">Xóa</a></p>
												</td>
												<td width="100" valign="top" align="right">' . formatNumber($row['pro_price']) . ' Đ</td>
												<td width="80" valign="top" align="center">
												<select name="quantity_' . $row['pro_id'] . '" id="quantity_' . $row['pro_id'] . '" onchange="recountCart(1, ' . $row['pro_id'] . ', $(this).val());">';

												for($i = 1; $i <= 10; $i++){
													$selected	= ($arrayProductInCart[$row['pro_id']]['quantity'] == $i) ? 'selected="selected"' : '';
													$html 		.=	'<option ' . $selected . ' value="' . $i . '">' . $i . '</option>';
												}
									$html 	.=	'</select>
												</td>
										<td width="100" valign="top" align="right" style="padding-right: 15px;">' . formatNumber($arrayProductInCart[$row['pro_id']]['quantity'] * $row['pro_price']) . ' Đ</td>
									</tr>';
							}
		$html 	.= '</table>
						</form>
					</div>';

		$html 	.= '<table style="margin-top: 4px;" width="100%" cellpadding="8" cellspacing="0" border="0">
							<tr>
								<td align="right"><b style="font-size: 14px;">Thành tiền</b></td>
								<td width="120" valign="top" align="right" style="padding-right: 10px; font-size: 16px;">
									<b style="color: #253e80;">' . formatNumber($total_money) . ' Đ</b>
									<p style="color: #666; padding-top: 4px; font-size: 12px;">(Đã bao gồm VAT)</p>
								</td>
							</tr>
						</table>';

		return $html;
	}

	/*
	save cookie
	*/
	function saveCookie(){

		$cookieData	= base64_encode(json_encode($this->current_cart));
		//Set temporary cookie
		setcookie("estore", $cookieData, null, "/", $this->server_name, null, 1);
		setcookie("estore", $cookieData, null, "/", "", null, 1);
	}

	/**
	 * Xóa thông tin giỏ hàng
	 * shoppingcart::clearCoookie()
	 *
	 * @return void
	 */
	function clearCoookie(){

		setcookie("estore", "", null, "/", $this->server_name, null, 1);
		setcookie("estore", "", null, "/", "", null, 1);
	}
}
?>