<?
include("inc_security.php");
checkAddEdit("add");

//Call class menu
$menu = new menu();
$listAll = $menu->getAllChild("categories_multi", "cat_id", "cat_parent_id", 0, " cat_type='phagia' AND cat_active = 1", "cat_id,cat_name,cat_type", "cat_order ASC,cat_name ASC", "cat_has_child", 0);
unset($menu);

// khởi tạo đệ quy
$menu_parent = menu(0);

//Khai báo biến khi thêm mới
$after_save_data = getValue("after_save_data", "str", "POST", "add.php");
$add = "add.php";
$listing = "listing.php";
$fs_title = "Thêm mới tin tức bất động sản";
$fs_action = getURL();
$fs_redirect = $after_save_data;
$fs_errorMsg = "";
$db_date = time();
$ban_end_time = 0;
$ban_str_end_time = getValue('ban_str_end_time', "str", "POST", date("H:i:s", time()));
$ban_str_end_date = getValue('ban_str_end_date', "str", "POST", '');
if ($ban_str_end_date != '') {
    $ban_end_time = convertDateTime($ban_str_end_date, $ban_str_end_time);
}


// select mysql list_batdongsan
//$query = new db_query("SELECT db_id,db_categories_name from list_batdongsan");

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
$myform->add("db_parent_id", "db_parent_id", 0, 0, "", 0, "", 0, "");
$myform->add("db_name", "db_name", 0, 0, "", 1, "Bạn chưa nhập tên banner.", 0, "");
$myform->add("db_active", "db_active", 1, 0, 0, 0, "", 0, "");
$myform->add("db_price", "db_price", 1, 0, 0, 0, "", 0, "");
$myform->add("db_price_id", "db_price_id", 1, 0, "", 0, "", 0, "");
$myform->addTable($fs_table);
//Get action variable for add new data
$action = getValue("action", "str", "POST", "");
//Check $action for insert new data
if ($action == "execute") {
    //Check form data
    $fs_errorMsg .= $myform->checkdata();

    //Get $filename and upload
    $filename = "";
//    if ($fs_errorMsg == "") {
//        $upload = new upload($fs_fieldupload, $fs_filepath, $fs_extension, $fs_filesize, $fs_insert_logo);
//        $filename = $upload->file_name;
//        $fs_errorMsg .= $upload->warning_error;
//    }

    if ($fs_errorMsg == "") {
//        if ($filename != "") {
//            $$fs_fieldupload = $filename;
//            $myform->add($fs_fieldupload, $fs_fieldupload, 0, 1, "", 0, "", 0, "");
//            // resize
//            //$upload->resize_image($fs_filepath, $filename, $width_small_image, $height_small_image, "small_", $fs_filepath . "small/");
//            //$upload->resize_image($fs_filepath, $filename, $width_normal_image, $height_normal_image, "normal_");
//
//        }//End if($filename != "")

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
    <?= $load_header ?>
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
<?= template_top($fs_title) ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<p align="center" style="padding-left:10px;">
    <?
    $form = new form();
    $form->create_form("add", $fs_action, "post", "multipart/form-data");
    $form->create_table();
    ?>
    <?= $form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.') ?>
    <?= $form->errorMsg($fs_errorMsg) ?>
    <tr>
        <td align="right" nowrap class="textBold" width="100"><?= translate_text("Loại danh mục") ?> *</td>
        <td>
            <select name="db_parent_id" id="db_parent_id" class="form-control">
                <option value="">--[ <?= translate_text("Chọn loại danh mục") ?> ]--</option>
                <? foreach ($menu_parent as $key => $value) { ?>
                    <option value="<?= $value['db_id'] ?>"><?= $value['db_name'] ?></option>
                <? } ?>
            </select>
        </td>
    </tr>
    <?= $form->text("Tên City", "db_name", "db_name", $db_name, "Tên City", 1, 250, "", 255, "", "", "") ?>
    <?= $form->checkbox("Kích hoạt", "db_active", "db_active", 1, $db_active, "Kích hoạt", 0, "", "") ?>
    <?= $form->text("Đơn Giá", "db_price", "db_price", $db_price, "Tên banner", 1, 250, "", 255, "", "", "") ?>
    <?=$form->select("Hình thức vận chuyển", "db_price_id", "db_price_id", $arrayTransport, $db_price_id, "Vận chuyển", 0, 100, "", "", "", "")?>
    <?= $form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", $form->ec, ""); ?>
    <?= $form->hidden("action", "action", "execute", ""); ?>
    <?
    $form->close_table();
    $form->close_form();
    unset($form);
    ?>
</p>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?= template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>