<?
require_once('inc_security.php');
//check quyền them sua xoa
checkAddEdit('edit');
//Khai bao Bien
$fs_redirect	= base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
$fs_action		= getURL();

$record_id	= getValue("record_id","int","GET");
$field_id	= "cat_id";
checkRowUser($fs_table,$field_id,$record_id,$fs_redirect);
$cat_type	= getValue('cat_type','str','GET','');

if($cat_type=="") $cat_type 	= getValue("cat_type","str","POST","");
$sql 	= "1";
if($cat_type!="")  $sql 	= "cat_type = '" . $cat_type . "'";

//Call Class generate_form();
$myform = new generate_form();
//Loại bỏ chuc nang thay the Tag Html
$myform->removeHTML(0);

$db_edit	=	new db_query('SELECT * FROM categories_multi WHERE cat_id=' . $record_id);
$row		=	mysql_fetch_array($db_edit->result);
$sql		=	" cat_type='" . $row["cat_type"] . "'";
$menu		= 	new menu();
$listAll	= 	$menu->getAllChild("categories_multi","cat_id","cat_parent_id","0",$sql . " AND lang_id = " . $_SESSION["lang_id"], "cat_id,cat_name,cat_order,cat_type,cat_parent_id,cat_has_child","cat_order ASC, cat_name ASC","cat_has_child");
$myform->add('cat_name','cat_name',0,0,'',1,translate_text('Please enter tintuc name'),0,"");
$myform->add("admin_id", "admin_id", 1, 1, "", 0, "", 0, "");
if($array_config["upper"]==1) $myform->add("cat_parent_id","cat_parent_id",1,0,0,0,"",0,"");
if($array_config["description"]==1) $myform->add("cat_description","cat_description",0,0,"",0,"",0,"");

$myform->add("cat_seo_title","cat_seo_title",0,0,"",0,"",0,"");
$myform->add("cat_seo_keyword","cat_seo_keyword",0,0,"",0,"",0,"");
$myform->add("cat_seo_description","cat_seo_description",0,0,"",0,"",0,"");
//Active data
//Add table
$myform->addTable($fs_table);
//Warning Error!
$errorMsg	= "";
//Get Action.
$action		= getValue("action", "str", "POST", "");
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
		$db_ex = new db_execute($myform->generate_update_SQL("cat_id", $record_id));
		unset($db_ex);

		resetAllChild();

		//Redirect to:
		redirect($fs_redirect);
		exit();
	}
}
//add form for javacheck
$myform->addFormname("add_new");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
<?
$myform->checkjavascript();
?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<?=template_top(translate_text("Sửa danh mục") . ": " . $row["cat_name"])?>
<?
$form = new form();
echo $form->create_form("edit", $fs_action, "post", "multipart/form-data",'');
echo $form->create_table();
?>
<tr><td></td><td><?=$errorMsg?></td></tr>
<tr>
	<td align="right" nowrap class="textBold"><?=translate_text("Tên danh mục")?> :</td>
	<td>
		<input type="text" name="cat_name" id="cat_name" value="<?=$row["cat_name"]?>" size="50" maxlength="50" class="form-control">
	</td>
</tr>
<?
if($array_config["image"]==1){
?>
<tr>
	<td class="textBold" align="right"><?=translate_text("Ảnh")?>:</td>
	<td>
		<input type="file" name="picture" id="picture" class="" size="40">
	</td>
</tr>
<?
}
?>
<?
if($array_config["upper"]==1){
?>
<tr>
	<td align="right" nowrap="nowrap" class="textBold"><?=translate_text("Danh mục cha")?>:</td>
	<td>
		<select name="cat_parent_id" id="cat_parent_id" class="form-control">
		<option value="0">--[<?=translate_text("Chọn danh mục con")?>]--</option>
		<?
		foreach($listAll as $i=>$cat){
		?>
			<option value="<?=$cat["cat_id"]?>" <? if($cat["cat_id"] == $row["cat_parent_id"]) echo ' selected="selected"'?>>
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
<?=$form->text("Meta title", "cat_seo_title", "cat_seo_title", $row["cat_seo_title"], "Meta title", 0, 450, "", 255, "", "", "")?>
<?=$form->text("Meta keywords", "cat_seo_keyword", "cat_seo_keyword", $row["cat_seo_keyword"], "Meta keywords", 0, 450, "", 255, "", "", "")?>
<?=$form->text("Meta description", "cat_seo_description", "cat_seo_description", $row["cat_seo_description"], "Meta descriptio", 0, 450, "", 255, "", "", "")?>
<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", $form->ec, "");?>
<?=$form->hidden("action", "action", "insert", "");?>
<?
$form->close_table();
$form->close_form();
unset($form);
?>
<?=template_bottom() ?>
</body>
</html>