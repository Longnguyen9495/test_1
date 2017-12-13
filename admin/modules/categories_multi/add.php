<?
require_once("inc_security.php");
//check quyền them sua xoa
checkAddEdit("add");

//Khai bao Bien
$after_save_data			= getValue("after_save_data", "str", "POST", "add.php");
$add_new						= "add.php";
$listing						= "listing.php";
$fs_title					= "Thêm mới danh mục";
$fs_action					= getURL();
$fs_redirect				= $after_save_data;
$fs_errorMsg				= "";

$cat_type			= getValue("cat_type","str","GET","");
if($cat_type=="") $cat_type	=	getValue("cat_type","str","POST","");
$sql					= "1";
if($cat_type!="")  $sql =" cat_type = '" . $cat_type . "'";
$menu 				= new menu();
$listAll 			= $menu->getAllChild("categories_multi","cat_id","cat_parent_id","0",$sql . " AND lang_id = " . $_SESSION["lang_id"],"cat_id,cat_name,cat_order,cat_type,cat_parent_id,cat_has_child","cat_order ASC, cat_name ASC","cat_has_child");

//Call Class generate_form();
$myform 				= new generate_form();
//Loại bỏ chuc nang thay the Tag Html
$myform->removeHTML(0);

$myform->add("cat_type","cat_type",0,0,$cat_type,1,translate_text("Chọn danh mục"),0,"");
$myform->add("cat_name","cat_name",0,0,"",1,translate_text("Tên danh mục"),0,"");
$myform->add("admin_id", "admin_id", 1, 1, "", 0, "", 0, "");
$myform->add("lang_id", "lang_id", 1, 1, "", 0, "", 0, "");
if($array_config["order"]==1)  $myform->add("cat_order","cat_order",1,0,0,0,"",0,"");
if($array_config["upper"]==1) $myform->add("cat_parent_id","cat_parent_id",1,0,0,0,"",0,"");
if($array_config["description"]==1) $myform->add("cat_description","cat_description",0,0,"",0,"",0,"");
$myform->add("cat_seo_title","cat_seo_title",0,0,"",0,"",0,"");
$myform->add("cat_seo_keyword","cat_seo_keyword",0,0,"",0,"",0,"");
$myform->add("cat_seo_description","cat_seo_description",0,0,"",0,"",0,"");

//Active data
$myform->add("cat_active","active",1,1,1,0,"",0,"");
//Add table
$myform->addTable($fs_table);
//Warning Error!
$errorMsg = "";
//Get Action.
$action	= getValue("action", "str", "POST", "");
if($action == "insert"){
	if($array_config["image"]==1){
		$upload_pic = new upload("picture", $fs_filepath, $extension_list, $limit_size);
		if ($upload_pic->file_name != ""){
			$picture = $upload_pic->file_name;
			//resize_image($fs_filepath,$upload_pic->file_name,100,100,75);
			$myform->add("cat_picture","picture",0,1,"",0,"",0,"");
		}
		//Check Error!
		$errorMsg .= $upload_pic->show_warning_error();
	}
	$errorMsg .= $myform->checkdata();
	if($errorMsg == ""){
		$db_ex 	= new db_execute_return();
		$last_id = $db_ex->db_execute($myform->generate_insert_SQL());
		$iParent = getValue("cat_parent_id","int","POST");
		if($iParent > 0){
			$db_ex = new db_execute("UPDATE categories_multi SET cat_has_child = 1 WHERE cat_id = " . $iParent);
		}

		$save 		= getValue("save","int","POST",0);
		$cat_order 	= getValue("cat_order","int","POST",0);
		// Redirect to add new
		$fs_redirect = "add.php?save=1&cat_order=".$cat_order."&iParent=" . $iParent . "&cat_type=" . getValue("cat_type","str","POST") . "&cat_order=" . getValue("cat_order","int","POST");
		if($save == 0) $fs_redirect = "listing.php";

		resetAllChild();

		//Redirect to:
		redirect($fs_redirect);
		exit();
	}
}
//add form for javacheck
$myform->addFormname("add_new");
$myform->checkjavascript();
$myform->evaluate();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<?=template_top(translate_text("Thêm mới danh mục"))?>
<?
$form = new form();
echo $form->create_form("add_new", $fs_action, "post", "multipart/form-data",'');
echo $form->create_table();
?>
<tr>
	<td></td>
	<td align="left">Những trường có dấu * là bắt buộc phải nhập</td>
</tr>
<tr><td></td><td><?=$errorMsg?></td></tr>
<tr>
	<td align="right" nowrap class="textBold" width="200"><?=translate_text("Loại danh mục")?> *</td>
	<td>
		<select name="cat_type" id="cat_type" class="form-control" onChange="window.location.href='add.php?cat_type='+this.value">
			<option value="">--[ <?=translate_text("Chọn loại danh mục")?> ]--</option>
			<?
			foreach($array_value as $key => $value){
			?>
			<option value="<?=$key?>" <? if($key == $cat_type) echo "selected='selected'";?>><?=$value?></option>
			<? } ?>
		</select>
	</td>
</tr>
<tr>
	<td align="right" nowrap class="textBold"><?=translate_text('Tên danh mục')?> *</td>
	<td>
		<input type="text" name="cat_name" id="cat_name" value="<?=$cat_name?>" maxlength="50" class="form-control">
	</td>
</tr>
<?
$cat_order = getValue('cat_order','int','GET',0);
?>
<tr>
	<td align="right" nowrap class="textBold"><?=translate_text("Sắp xếp")?></td>
	<td>
		<input type="text" name="cat_order" id="cat_order" value="<?=$cat_order+1;?>" size="5" maxlength="5" class="form-control">
	</td>
</tr>
<?
if($array_config['image']==1){
?>
<tr>
	<td class="textBold" align="right"><?=translate_text('Ảnh')?></td>
	<td>
		<input type="file" name="picture" id="picture" size="40">
	</td>
</tr>
<?
}
?>
<?
if($array_config["upper"]==1){
?>
<tr>
	<td align="right" nowrap="nowrap" class="textBold"><?=translate_text("Danh mục cha")?></td>
	<td>
		<select name="cat_parent_id" id="cat_parent_id" class="form-control">
		<option value="0">--[<?=translate_text("Chọn danh mục cha")?>]--</option>
		<?
		$iParent = getValue("iParent","int","GET",0);
	
		foreach($listAll as $i=>$cat){

		?>
			<option value="<?=$cat["cat_id"]?>" <? if($cat["cat_id"] == $iParent) echo 'selected="selected"'?> >
			<?
			for($j=0;$j<$cat["level"];$j++) echo "---";
				echo $cat["cat_name"];
			?>
			</option>
		<?
		}
		?>
		</select>
	</td>
</tr>
<?
}
?>
<?=$form->text("Meta title", "cat_seo_title", "cat_seo_title", $cat_seo_title, "Meta title", 0, 450, "", 255, "", "", "")?>
<?=$form->text("Meta keywords", "cat_seo_keyword", "cat_seo_keyword", $cat_seo_keyword, "Meta keywords", 0, 450, "", 255, "", "", "")?>
<?=$form->text("Meta description", "cat_seo_description", "cat_seo_description", $cat_seo_description, "Meta descriptio", 0, 450, "", 255, "", "", "")?>
<tr>
	<td class="form_name">Sau khi lưu dữ liệu</td>
	<td>
		<span><input type="radio" checked="checked" name="after_save_data" value="<?=$add_new?>" id="add_new" /><label for="add_new">Thêm mới</label></span>
		<span><input type="radio" name="after_save_data" value="<?=$listing?>" id="listing" /><label for="listing">Về danh sách</label></span>
	</td>
</tr>
<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", $form->ec, "");?>
<?=$form->hidden("action", "action", "insert", "");?>
<?
$form->close_table();
$form->close_form();
unset($form);
?>
<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>