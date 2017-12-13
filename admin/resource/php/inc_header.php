<?
$isAdmin = isset($_SESSION["isAdmin"]) ? intval($_SESSION["isAdmin"]) : 0;
?>
<div class="header">
	<table cellpadding="0" cellspacing="0"  width="100%">
		<tr>
			<td><a class="" href="javascript:;" target="_blank" title="Trang chủ">ADMINISTRATOR</a></td>
			<td><h3 style="color: #FFFFFF;font-family: arial; text-align: left; margin: 0; font-size: 14px;">Chào mừng bạn đến với trang quản trị website</h3></td>
			<td align="right">
				<span style="font-family: arial;">Xin chào!&nbsp;  <a href="resource/profile/myprofile.php" id="profile_myprofile" class="tab" rel="Thông tin tài khoản" style="color: #E43632; font-weight: bold;" onclick="return false;"><?=getValue("userlogin","str","SESSION","")?></a></span>
				&nbsp;|&nbsp;
				<?
				//kiem tra xem neu la o tren localhost thi moi co quyen cau hinh
				$url = $_SERVER['SERVER_NAME'];
				if($isAdmin == 1 || $url == "localhost"){
					?>
					<a href="resource/configadmin/configmodule.php" id="configadmin_configmodule" class="tab" rel="Website Setting" onclick="return false;">Website Setting</a>
					&nbsp;|&nbsp;
				<?
				}
				?>
				<a href="resource/logout.php"><?=translate_text("Logout")?></a>
			</td>
			<td>&nbsp;</td>
		</tr>
	</table>
</div>