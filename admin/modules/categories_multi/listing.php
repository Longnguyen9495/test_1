<?
require_once('inc_security.php');

$list 	= new fsDataGird($field_id,$field_name,translate_text('Danh sách ảnh'));

$cat_type 			= getValue('cat_type','str','GET','');
$iCat		 			= getValue("iCat");
if($cat_type=="") $cat_type	= getValue('cat_type','str','POST','');
$sql 	= "1";
if($cat_type!="")  $sql 	= "cat_type = '" . $cat_type . "'";

$menu = new menu();
$menu->show_count = 1; // Tính count sản phẩm
$listAll = $menu->getAllChild("categories_multi", "cat_id", "cat_parent_id", $iCat, $sql . " AND lang_id = " . $lang_id, "cat_id,cat_name,cat_order,cat_type,cat_parent_id,cat_has_child,cat_picture,cat_active,admin_id,cat_show,cat_show_mob","cat_type ASC,cat_order ASC, cat_name ASC","cat_has_child");

$arrayCat = array(0=>translate_text("Categories"));
$db_cateogry = new db_query("	SELECT cat_type,cat_name,cat_id
										FROM categories_multi
										WHERE cat_parent_id = 0");
while($row = mysql_fetch_array($db_cateogry->result)){
	$arrayCat[$row["cat_id"]] = $row["cat_name"];
}

$list->addSearch(translate_text("Danh mục"),"cat_type","array",$array_value,$cat_type);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<div class="listing">
	<? /*------------------------------------------------------------------------------------------------*/ ?>
	<?=template_top(translate_text("Category listing"), $list->urlsearch())?>
	<?
	if(!is_array($listAll)) $listAll = array();
	?>
	<table class="table table-bordered table-striped" width="100%" bordercolor="<?=$fs_border?>">
		<tr>
			<td width="5" class="bold" >Chọn</td>
			<td class="bold" width="2%" nowrap="nowrap" align="center">Lưu</td>
			<?
			if($array_config["image"]==1){
			?>
			<td class="bold" width="5%" nowrap="nowrap" align="center"><?=translate_text("Ảnh")?></td>
			<?
			}
			?>
			<td class="bold" ><?=translate_text("Tên danh mục")?></td>
			<?
			if($array_config["order"]==1){
			?>
			<td class="bold" align="center"><?=translate_text("Thứ tự")?></td>
			<?
			}
			?>
			<td class="bold" align="center" width="5"><?=translate_text("Show trang chủ")?></td>
			<td class="bold" align="center" width="5"><?=translate_text("Show trang chủ mobile")?></td>
			<td class="bold" align="center" width="5"><?=translate_text("Active")?></td>
			<td class="bold" align="center" width="16">Sửa</td>
			<td class="bold" align="center" width="16">Xóa</td>
		</tr>
		<form action="quickedit.php?returnurl=<?=base64_encode(getURL())?>" method="post" name="form_listing" id="form_listing" enctype="multipart/form-data">
		<input type="hidden" name="iQuick" value="update">
		<?

		$i=0;
		$cat_type = '';
		foreach($listAll as $key=>$row){
			$i++;
			if($cat_type != strtolower($row["cat_type"])){
				$cat_type = strtolower($row["cat_type"]);
				?>
				<tr>
					<td colspan="14" align="center" class="bold" bgcolor="#FFFFCC" style="color:#FF0000; padding:6px;"><?=isset($array_value[$cat_type]) ?  $array_value[$cat_type] : ''?></td>
				</tr>
				<?
			}
			?>
			<tr>
				<td <? if($row["admin_id"] == $admin_id) echo ' bgcolor="#FFFF66"';?>>
					<input type="checkbox" name="record_id[]" id="record_<?=$row["cat_id"]?>_<?=$i?>" value="<?=$row["cat_id"]?>">
				 </td>
				<td width="2%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>save.png" border="0" style="cursor:pointer" onClick="document.form_listing.submit()" alt="Save"></td>
				<?
				if($array_config["image"]==1){
				?>
				<td align="center" style="width: 150px;">
					<?
					$path = $fs_filepath . $row["cat_picture"];
					if($row["cat_picture"] != "" && file_exists($path)){
						echo '<a href="#"><img  src="' . $fs_filepath . $row["cat_picture"] . '"  style="cursor:pointer" height=50 border=\'0\'></a>';
						?>
						<a href="delete_pic.php?record_id=<?=$row["cat_id"]?>&url=<?=base64_encode($_SERVER['REQUEST_URI'])?>"><img src="<?=$fs_imagepath?>delete.gif" border="0" /></a><?
					}
					?>
					<input type="file" name="picture<?=$row["cat_id"]?>" id="picture<?=$row["cat_id"]?>" class="" onchange="check_edit('record_<?=$row["cat_id"]?>_<?=$i?>')" >
				</td>
				<?
				}
				?>
				<td nowrap="nowrap">
					<?
					for($j=0;$j<$row["level"];$j++) echo "--";
					?>
					<input type="text" style="width: 90%;" name="cat_name<?=$row["cat_id"];?>" id="cat_name<?=$row["cat_id"];?>" onKeyUp="check_edit('record_<?=$row["cat_id"]?>_<?=$i?>')" value="<?=$row["cat_name"];?>" class="form-control" size="50">
				</td>

				<td align="center" style="width: 60px;"><input type="text" style="width: 40px;" class="form-control" value="<?=$row["cat_order"]?>" id="cat_order<?=$row["cat_id"]?>"  onKeyUp="check_edit('record_<?=$row["cat_id"]?>_<?=$i?>')"  name="cat_order<?=$row["cat_id"]?>"></td>
				<td align="center">
					<a href="active.php?record_id=<?=$row["cat_id"]?>&type=cat_show&value=<?=abs($row["cat_show"]-1)?>&url=<?=base64_encode($_SERVER['REQUEST_URI'])?>" onclick="loadactive(this); return false;"><img border="0" alt="Active!" src="<?=$fs_imagepath?>check_<?=$row["cat_show"];?>.gif"></a>
				</td>
				<td align="center">
					<a href="active.php?record_id=<?=$row["cat_id"]?>&type=cat_show_mob&value=<?=abs($row["cat_show_mob"]-1)?>&url=<?=base64_encode($_SERVER['REQUEST_URI'])?>" onclick="loadactive(this); return false;"><img border="0" alt="Active!" src="<?=$fs_imagepath?>check_<?=$row["cat_show_mob"];?>.gif"></a>
				</td>
				<td align="center"><a onClick="loadactive(this); return false;" href="active.php?record_id=<?=$row["cat_id"]?>&type=cat_active&value=<?=abs($row["cat_active"]-1)?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>check_<?=$row["cat_active"];?>.gif" title="Active!"></a></td>

				<td align="center" width="16"><a class="text" href="edit.php?record_id=<?=$row["cat_id"]?>&returnurl=<?=base64_encode(getURL())?>"><img src="<?=$fs_imagepath?>edit.png" alt="EDIT" border="0"></a></td>

				<td align="center"><img src="<?=$fs_imagepath?>delete.gif" alt="DELETE" border="0" onClick="if (confirm('Are you sure to delete?')){ window.location.href='delete.php?record_id=<?=$row["cat_id"]?>&returnurl=<?=base64_encode(getURL())?>'}" style="cursor:pointer"></td>

			</tr>
		<? } ?>
		</form>
		</table>
<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</div>
</body>
</html>
