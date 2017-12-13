<?
include("inc_security.php");
checkAddEdit("add");
//khai báo biến
$fs_redirect 	= base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id 		= getValue("record_id");
$temp_key		= getValue("temp_key","str","GET","",1,1);
$fs_errorMsg	= '';
$galp_id 		= getValue("galp_id");


$galp_description = "";
$picture 			= "";

if($galp_id > 0){
	$db_query 	= new db_query("SELECT * FROM gallery_pictures WHERE galp_id = " . $galp_id);
	if($row	= mysql_fetch_assoc($db_query->result)){ 
		$galp_description = $row['galp_description']; 
		$picture 			= $row['galp_pictures'];
	}
}
 
$galp_description = getValue("galp_description", "str", "POST", $galp_description); 

$myform = new generate_form(); 
$myform->add("galp_description", "ppic_description", 0, 1, " ", 0, "", 0, ""); 
$myform->add("galp_temp_key", "ppic_temp_key", 0, 0, "", 0, "", 0, "");
$myform->add("galp_gallery_id", "record_id", 1, 1, 0, 0, "", 0, "");
//Add table insert data
$myform->addTable("gallery_pictures");

//Get action variable for add new data
$action				= getValue("action", "str", "POST", "");
//Check $action for insert new data
if($action == "execute"){

	$upload			= new upload($fs_fieldupload, $fs_filepath, $fs_extension, $fs_filesize, $fs_insert_logo);
	$fs_errorMsg	.= $upload->warning_error;
	
	if($galp_id <= 0) $fs_errorMsg	.= $upload->common_error;

	if($upload->file_name != "" && $fs_errorMsg == ""){
		$$fs_fieldupload = $upload->file_name;
		$myform->add("galp_pictures", $fs_fieldupload, 0, 1, "", 0, "", 0, "");

		// resize
		resize_image($fs_filepath, $upload->file_name, $width_small_image, $height_small_image, "small_", $fs_filepath . "small/", 100);
		resize_image($fs_filepath, $upload->file_name, $width_normal_image, $height_normal_image, "medium_", $fs_filepath . "medium/", 100);
	}

	//Check form data
	$fs_errorMsg .= $myform->checkdata();
	if($fs_errorMsg == ""){

		// Nếu là edit
		if($galp_id > 0){
			$db_ex = new db_execute($myform->generate_update_SQL("galp_id", $galp_id));
		}else{
			//Insert to database
			$db_insert		= new db_execute($myform->generate_insert_SQL());
		}

		redirectHeader(getUrl(0, 0, 1, 1, "ppic_id"));

	}//End if($fs_errorMsg == "")

}//End if($action == "execute")

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
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
	<?
	$form = new form();
	$form->create_form("add", $_SERVER['REQUEST_URI'], "post", "multipart/form-data",'onsubmit="validateForm(); return false;"');
	$form->create_table();
	?>
	<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
	<?=$form->errorMsg($fs_errorMsg)?>
	<?=$form->text("Miêu tả", "ppic_description", "ppic_description", $ppic_description, "Miêu tả", 0, 600, "", 255, "", "", "")?>
	<?
	if($galp_id > 0 && $picture != ""){
		?>
		<tr>
			<td></td>
			<td><img src="<?=$fs_filepath?>small/small_<?=$picture?>" width="50" height="40" /></td>
		</tr>
		<?
	}
	?>
	<?=$form->getFile("Ảnh", $fs_fieldupload, $fs_fieldupload, "Ảnh minh họa", 1, 30, "", "")?>
	<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Đóng cửa sổ", "Cập nhật" . $form->ec . "Đóng cửa sổ", $form->ec . ' onclick="window.parent.tb_remove()"', "");?>
	<?=$form->hidden("action", "action", "execute", "");?>
	<?=$form->hidden("ppic_temp_key", "ppic_temp_key", $temp_key, "");?>
	<?
	$form->close_table();
	$form->close_form();
	unset($form);
	?>

<? /*------------------------------------------------------------------------------------------------*/ ?>
	<div style="padding-left:3px; padding-right:3px;">
	<table class="table table-bordered">
		<tr>
			<th width="10">ID</th>
			<th>Ảnh</th> 
			<th>Miêu tả</th> 
			<th width="10">Edit</th>
			<th width="30" align="center">Xóa</th>
		</tr>
		<?
		$sql = '';
		if($temp_key != '') $sql .= " AND galp_temp_key = '" . $temp_key . "'";
		$db_picture = new db_query("SELECT *
											 FROM gallery_pictures
											 WHERE  galp_gallery_id = " . $record_id . $sql);
		?>
		<?
		$i	= 0;
		while($row = mysql_fetch_assoc($db_picture->result)){
			$i++;
			?>
			<tr <?=$fs_change_bg?>>
				<td align="center"><?=$i?></td>
				<td align="center" width="60"><img src="<?=$fs_filepath?>small/small_<?=$row["galp_pictures"]?>" width="50" height="40" /></td>
			   <td><?=$row["galp_description"]?></td>
				 <td align="center"><a onclick="window.location.href='more_picture.php?record_id=<?=$record_id?>&ppic_id=<?=$row["ppic_id"]?>'" href="#" class="edit"><img border="0" src="<?=$fs_imagepath?>edit.png"></a></td>
				<td align="center"><a onclick="if (confirm('Bạn muốn xóa bản ghi?')){ window.location.href='delete_picture.php?record_id=<?=$row["ppic_id"]?>&url=<?=base64_encode($_SERVER['REQUEST_URI'])?>' }" href="#" class="delete"><img border="0" src="<?=$fs_imagepath?>delete.gif"></a></td>
			</tr>
			<?
		}
		?>
	</table>
	</div>
<? /*------------------------------------------------------------------------------------------------*/ ?>

</body>
</html>