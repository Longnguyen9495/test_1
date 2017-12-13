<?
include("inc_security.php");
checkAddEdit("add");

//Call class menu 

//Khai báo biến khi thêm mới
$after_save_data	= getValue("after_save_data", "str", "POST", "add.php");
$add					= "add.php";
$listing				= "listing.php";
$fs_title			= "Thêm mới video product";
$fs_action			= getURL();
$fs_redirect		= $after_save_data;
$fs_errorMsg		= "";
$gal_active 		= 1;
 
$temp_key					= md5(time() . "ototai");

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
$video_date			= time();

$myform = new generate_form();
$myform->add("video_title", "video_title", 0, 0, "", 1, "Bạn chưa nhập tên video.", 0, ""); 
$myform->add("video_cate", "video_cate", 1, 0, "", 0, "", 0, ""); 
$myform->add("video_youtobe", "video_youtobe", 0, 0, "", 0, "", 0, ""); 
$myform->add("video_date", "video_date", 1, 1, 0, 0, "", 0, "");
$myform->add("video_user", "video_user", 0, 0, "", 1, "Bạn chưa nhập tên user.", 0, ""); 
$myform->add("video_active", "video_activee", 1, 0, 0, 0, "", 0, "");



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
		<tr>
	<td class="form_name"><font color="red">*</font>&nbsp;Thể Loại :</td>
	<td>
		<select class="form-control" name="video_cate" id="video_cate" style="width: 180px;">
			<?
			foreach($arrayManufactory as $key => $value) {
			
				echo('<option value="' . $key . '"' . ($key == $video_cate ? ' selected="selected"' : '') . '>' . $value . '</option>');
			}
			?>
		</select>
	</td>
</tr>

		<?=$form->text("Tên", "video_title", "video_title", $video_title, "Tên", 1, 250, "", 255, "", "", "")?>
		

		<?=$form->getFile("Ảnh minh họa", "video_image", "video_image", "Ảnh minh họa", 0, 32, "", '<br />(Dung lượng tối đa <font color="#FF0000">' . $fs_filesize . ' Kb</font>)');?>
		

		<?=$form->text("Link nhúng youtube", "video_youtobe", "video_youtobe", $video_youtobe, "Link nhúng youtube", 1, 250, "", 255, "", "", "")?>

		<?=$form->text("Người đăng", "video_user", "video_user", $video_user, "Tên", 1, 250, "", 255, "", "", "")?>

		<?=$form->checkbox("Kích hoạt", "video_active", "video_activee", 1, $video_activee, "Kích hoạt", 0, "", "")?>
		
		
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