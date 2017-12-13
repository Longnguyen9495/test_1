<?
	include("inc_security.php");

	//Khai báo biến khi thêm mới
	$fs_title				= "Cấu hình Website";
	$fs_action				= getURL();
	$fs_redirect			= getURL();
	$fs_errorMsg			= "";

	//Get data edit
	$record_id				= $lang_id;
	$db_edit					= new db_query("SELECT * FROM " . $fs_table . " WHERE " . $id_field . " = " . $record_id);
	if(mysql_num_rows($db_edit->result) == 0){
		//Redirect if can not find data
		redirect($fs_error);
	}
	$edit						= mysql_fetch_array($db_edit->result);
	unset($db_edit);
	$con_site_title = getValue("con_site_title", "str", "POST", $edit["con_site_title"]);

	$con_tangkem		= getValue("con_tangkem", "str", "POST", $edit["con_tangkem"]);
	$con_tangkem		= replaceFCK($con_tangkem, 1);

	$con_thongtinthanhtoan		= getValue("con_thongtinthanhtoan", "str", "POST", $edit["con_thongtinthanhtoan"]);
	$con_thongtinthanhtoan		= replaceFCK($con_thongtinthanhtoan, 1);

	/*
	Call class form:
	add các tên trường trước, sau đó add table sau
	1). Ten truong
	2). Ten form
	3). Kieu du lieu , 0 : string , 1 : kieu int, 2 : kieu email, 3 : kieu double, 4 : kieu hash password
	4). Noi luu giu data  0 : post, 1 : variable
	5). Gia tri mac dinh, neu require thi phai lon hon hoac bang default
	6). Du lieu nay co can thiet hay khong
	7). Loi dua ra man hinh
	8). Chi co duy nhat trong database
	9). Loi dua ra man hinh neu co duplicate

	*/
	$con_image_path	= getValue("con_image_path", "str", "POST", "", 1);
	$con_picture_path	= getValue("con_picture_path", "str", "POST", "", 1);

	$myform = new generate_form();
	$myform->add("con_admin_email", "con_admin_email", 0, 0, $edit["con_admin_email"], 0, "", 0, "");
	$myform->add("con_site_title", "con_site_title", 0, 1, " ", 1, "Bạn chưa nhập tiêu đề cho website", 0, "");
	$myform->add("con_product_page", "con_product_page", 0, 0, $edit["con_product_page"], 0, "", 0, "");
	$myform->add("con_meta_keywords", "con_meta_keywords", 0, 0, $edit["con_meta_keywords"], 0, "", 0, "");
	$myform->add("con_meta_description", "con_meta_description", 0, 0, $edit["con_meta_description"], 0, "", 0, "");
	$myform->add("con_tangkem", "con_tangkem", 0, 0, $edit["con_tangkem"], 0, "", 0, "");
	$myform->add("con_thongtinthanhtoan", "con_thongtinthanhtoan", 0, 0, $edit["con_thongtinthanhtoan"], 0, "", 0, "");
	$myform->add("con_hotline", "con_hotline", 0, 0, $edit["con_hotline"], 0, "", 0, "");
	$myform->add("con_hotline_banhang", "con_hotline_banhang", 0, 0, $edit["con_hotline_banhang"], 0, "", 0, "");
	$myform->add("con_hotline_hotro_kythuat", "con_hotline_hotro_kythuat", 0, 0, $edit["con_hotline_hotro_kythuat"], 0, "", 0, "");
	$myform->add("con_address", "con_address", 0, 0, $edit["con_address"], 0, "", 0, "");
   $myform->add("con_background_color", "con_background_color", 0, 0, $edit["con_background_color"], 0, "", 0, "");
	$myform->add("con_image_path", "con_image_path", 0, 0, $edit["con_image_path"], 0, "", 0, "");
   $myform->add("con_picture_path", "con_picture_path", 0, 0, $edit["con_picture_path"], 0, "", 0, "");
   $myform->add("con_facebook_id", "con_facebook_id", 0, 0, $edit["con_facebook_id"], 0, "", 0, "");

	//Add table insert data (add sau khi add het các trường để check lỗi)
	$myform->addTable($fs_table);
	$action					= getValue("action", "str", "POST", "");
	//Check $action for insert new data
	if($action == "execute"){
		//Check form data
		$fs_errorMsg .= $myform->checkdata();

      //Get $filename and upload
   	$filename	= "";
   	if($fs_errorMsg == ""){
   		$upload			= new upload($fs_fieldupload, $fs_filepath, $fs_extension, $fs_filesize);
   		$filename		= $upload->file_name;
   		$fs_errorMsg  .= $upload->warning_error;
   	}

      if($filename != "") {
			$$fs_fieldupload = $filename;
			$myform->add($fs_fieldupload, $fs_fieldupload, 0, 1, "", 0, "", 0, "");
		}//End if($filename != "")

		//Get $filename and upload bg detail
   	$filename2	= "";
   	if($fs_errorMsg == ""){
   		$upload2			= new upload($fs_fieldupload2, $fs_filepath, $fs_extension, $fs_filesize);
   		$filename2		= $upload2->file_name;
   		$fs_errorMsg  .= $upload2->warning_error;
   	}

      if($filename2 != "") {
			$$fs_fieldupload2 = $filename2;
			$myform->add($fs_fieldupload2, $fs_fieldupload2, 0, 1, "", 0, "", 0, "");
		}//End if($filename2 != "")

		if($fs_errorMsg == "") {

			//Insert to database
			$myform->removeHTML(0);

			$db_update = new db_execute($myform->generate_update_SQL($id_field, $record_id));
			unset($db_update);

			redirect($fs_redirect);

		}//End if($fs_errorMsg == "")

	}//End if($action ==1 "insert")

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
<?
$myform->checkjavascript();
//chuyển các trường thành biến để lấy giá trị thay cho dùng kiểu getValue
$myform->evaluate();
$fs_errorMsg .= $myform->strErrorField;
?>
<script language="javascript">
/* Đếm số ký tự còn lại */
function count_char(length) {
	a	= <?=$fs_sms_length?> - parseInt(length);
	$("#count").html('Bạn còn <font color=red>' + a + '</font> ký tự');
}

$(function(){
	$('#con_tangkem').wysiwyg();
});
</script>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_top($fs_title)?>
	<p align="center" style="padding-left:10px;">
	<?
	$form = new form();
	$form->create_form("edit", $fs_action, "post", "multipart/form-data",'onsubmit="validateForm(); return false;"');
	$form->create_table();
	?>
	<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
	<?=$form->errorMsg($fs_errorMsg)?>
	<tr><td align="center" colspan="2" class="text_link_bold">A - Cấu hình chung:</td></tr>
	<?=$form->text("Admin email", "con_admin_email", "con_admin_email", $con_admin_email, "Admin email", 1, 200, "", 255, "", "", "")?>
	<?=$form->text("Tiêu đề Website", "con_site_title", "con_site_title", $con_site_title, "Tiêu đề Website", 1, 350, "", 255, "", "", "")?>
	<?//=$form->text("Số sản phẩm / trang", "con_product_page", "con_product_page", $con_product_page, "Số sản phẩm / trang", 1, 60, "", 255, "", "", "")?>
	<?=$form->textarea("Meta Keyword", "con_meta_keywords", "con_meta_keywords", $con_meta_keywords, "Meta Keyword", 0, 350, 75, "", "", "")?>
	<?=$form->textarea("Meta Description", "con_meta_description", "con_meta_description", $con_meta_description, "Meta Description", 0, 350, 100, "", "", "")?>
	<?=$form->text("Facebook ID", "con_facebook_id", "con_facebook_id", $con_facebook_id, "ID app facebook", 0, 350, "", 255, "", "", "")?>
	<tr>
		<td class="form_name" style="vertical-align: top;">Footer Link : </td>
		<td>
			 <?=$form->wysiwyg("", "con_tangkem", $con_tangkem, $wys_path, "80%", 218)?>
		</td>
	</tr>
	<? /*
	<tr>
		<td class="form_name" style="vertical-align: top;">Thông tin thanh toán : </td>
		<td>
			 <?=$form->wysiwyg("", "con_thongtinthanhtoan", $con_thongtinthanhtoan, $wys_path, "80%", 218)?>
		</td>
	</tr>
 	*/ ?>
	<?//=$form->text("Images_path", "con_image_path", "con_image_path", $con_image_path, "Đường dẫn images", 0, 350, "", 255, "", "", "")?>
	<?//=$form->text("Picture_path", "con_picture_path", "con_picture_path", $con_picture_path, "Đường dẫn pictuers", 0, 350, "", 255, "", "", "")?>
	<?//=$form->text("Theme_path", "con_theme_path", "con_theme_path", $con_theme_path, "Đường dẫn theme", 0, 350, "", 255, "", "", "")?>
	<?=$form->text("Số hotline", "con_hotline", "con_hotline", $con_hotline, "hotline", 1, 250, "", 250, "", "", "&nbsp(Gồm 2 số điện thoại cách nhau bởi dấu \"|\")")?>
	<?=$form->text("Số hotline bán hàng", "con_hotline_banhang", "con_hotline_banhang", $con_hotline_banhang, "Hotline bán hàng", 1, 250, "", 250, "", "", "&nbsp(Gồm 2 số điện thoại cách nhau bởi dấu \"|\")")?>
	<?=$form->text("Số hotline hỗ trợ kỹ thuật", "con_hotline_hotro_kythuat", "con_hotline_hotro_kythuat", $con_hotline_hotro_kythuat, "Hotline hỗ trợ kỹ thuật", 1, 250, "", 250, "", "", "&nbsp(Gồm 2 số điện thoại cách nhau bởi dấu \"|\")")?>
	<?=$form->text("Địa chỉ", "con_address", "con_address", $con_address, "address", 1, 250, "", 250, "", "")?>
	<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", $form->ec, "");?>
	<?=$form->hidden("action", "action", "execute", "");?>
	<?
	$form->close_table();
	$form->close_form();
	unset($form);
	?>
	</p>
<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>
<script type="text/javascript">
	function delete_background(id){
		$.post("delete_background.php",{
			id:id
		}, function(json){
			if(json.code == 1){
				alert("Xóa thành công");
				if (id == 1) {
					$("#con_background_img").html("");
				}else if(id == 2){
					$("#con_background_homepage").html("");
				};
			}else{
				alert("Xảy ra lỗi khi xóa");
			}
		}, 'json')
	}
</script>