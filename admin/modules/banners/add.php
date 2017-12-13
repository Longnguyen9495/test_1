<?
include("inc_security.php");
checkAddEdit("add");

//Call class menu
$menu					= new menu();
$listAll				= $menu->getAllChild("categories_multi", "cat_id", "cat_parent_id", 0, " cat_type='phagia' AND cat_active = 1", "cat_id,cat_name,cat_type", "cat_order ASC,cat_name ASC", "cat_has_child", 0);
unset($menu);

//Khai báo biến khi thêm mới
$after_save_data	= getValue("after_save_data", "str", "POST", "add.php");
$add					= "add.php";
$listing				= "listing.php";
$fs_title			= "Thêm mới banner";
$fs_action			= getURL();
$fs_redirect		= $after_save_data;
$fs_errorMsg		= "";
$ban_date			= time();
$ban_end_time 		= 0;
$ban_str_end_time = getValue('ban_str_end_time', "str", "POST", date("H:i:s", time()));
$ban_str_end_date = getValue('ban_str_end_date', "str", "POST", '');
if($ban_str_end_date != ''){
	$ban_end_time		= convertDateTime($ban_str_end_date, $ban_str_end_time);
}

/*
Call class form:
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
$myform = new generate_form();
$myform->add("ban_name", "ban_name", 0, 0, "", 1, "Bạn chưa nhập tên banner.", 0, "");
$myform->add("ban_target", "ban_target", 0, 0, "", 0, "", 0, "");
$myform->add("ban_type", "ban_type", 1, 0, "", 0, "", 0, "");
$myform->add("ban_position", "ban_position", 1, 0, 0, 1, "", 0, "");
$myform->add("ban_link", "ban_link", 0, 0, "", 1, "Bạn chưa nhập link.", 0, "");
$myform->add("ban_description", "ban_description", 0, 0, "", 0, "", 0, "");
$myform->add("ban_date", "ban_date", 1, 1, 0, 0, "", 0, "");
$myform->add("admin_id", "admin_id", 1, 1, "", 0, "", 0, "");
$myform->add("lang_id", "lang_id", 1, 1, "", 0, "", 0, "");
$myform->addTable($fs_table);
//Get action variable for add new data
$action				= getValue("action", "str", "POST", "");
//Check $action for insert new data
if($action == "execute"){
	//Check form data
	$fs_errorMsg .= $myform->checkdata();

	//Get $filename and upload
	$filename	= "";
	if($fs_errorMsg == ""){
		$upload			= new upload($fs_fieldupload, $fs_filepath, $fs_extension, $fs_filesize, $fs_insert_logo);
		$filename		= $upload->file_name;
		$fs_errorMsg	.= $upload->warning_error;
	}

	if($fs_errorMsg == ""){
		if($filename != ""){
			$$fs_fieldupload = $filename;
			$myform->add($fs_fieldupload, $fs_fieldupload, 0, 1, "", 0, "", 0, "");
			// resize
			//$upload->resize_image($fs_filepath, $filename, $width_small_image, $height_small_image, "small_", $fs_filepath . "small/");
			//$upload->resize_image($fs_filepath, $filename, $width_normal_image, $height_normal_image, "normal_");

		}//End if($filename != "")

		//Insert to database
		$myform->removeHTML(0);
		$db_insert = new db_execute($myform->generate_insert_SQL());
		unset($db_insert);

		//Redirect after insert complate
		redirect($fs_redirect);

	}//End if($fs_errorMsg == "")

}//End if($action == "insert")
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
<?
//add form for javacheck
$myform->addFormname("add");
$myform->checkjavascript();
//chuyển các trường thành biến để lấy giá trị thay cho dùng kiểu getValue
$myform->evaluate();
$fs_errorMsg .= $myform->strErrorField;
?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_top($fs_title)?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
	<p align="center" style="padding-left:10px;">
		<?
		$form = new form();
		$form->create_form("add", $fs_action, "post", "multipart/form-data");
		$form->create_table();
		?>
		<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
		<?=$form->errorMsg($fs_errorMsg)?>
		<?=$form->text("Tên banner", "ban_name", "ban_name", $ban_name, "Tên banner", 1, 250, "", 255, "", "", "")?>
		<?=$form->getFile("Ảnh minh họa", "ban_picture", "ban_picture", "Ảnh minh họa", 0, 32, "", '<br />(Dung lượng tối đa <font color="#FF0000">' . $fs_filesize . ' Kb</font>)');?>
		<?=$form->text("Link", "ban_link", "ban_link", $ban_link, "Link", 1, 250, "", 255, "", "", "")?>
		<?=$form->textarea("Mô tả chi tiết", "ban_description", "ban_description", $ban_description, "Mô tả chi tiết", 0, 450, 250, "", "", "")?>
		<?=$form->select("Mở ra", "ban_target", "ban_target", $arrTarget, $ban_target, "Mở ra", 0, 100, "", "", "", "")?>
		<?=$form->select("Vị trí", "ban_position", "ban_position", $arrPositon, $ban_position, "Vị trí", 0, 100, "", "", "", "")?>
		<?=$form->select("Loại Banner", "ban_type", "ban_type", $arrType, $ban_type, "Loại Banner", 0, 100, "", "", "", "")?>
		<?=$form->radio("Sau khi lưu dữ liệu", "add_new" . $form->ec . "return_listing", "after_save_data", $add . $form->ec . $listing, $after_save_data, "Thêm mới" . $form->ec . "Quay về danh sách", 0, $form->ec, "");?>
		<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", $form->ec, "");?>
		<?=$form->hidden("action", "action", "execute", "");?>
		<?
		$form->close_table();
		$form->close_form();
		unset($form);
		?>
	</p>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>