<?
session_start();
require_once("../functions/translate.php");
require_once("../functions/functions.php");
require_once("../classes/database.php");

$loginpath	= "login.php";
if (!isset($_SESSION["logged"])){
	redirect($loginpath);
}
else{
	if ($_SESSION["logged"] != 1){
		redirect($loginpath);
	}
}
$lang_id	= 1;
if (isset($_GET["lang_id"])) $lang_id = $_GET["lang_id"];

$lang_id			= intval($lang_id);
$db_language	= new db_query("SELECT * FROM languages WHERE lang_id = " . $lang_id);
if($row	= mysql_fetch_array($db_language->result)){
	$_SESSION["lang_id"] 	= $lang_id;
	$_SESSION["lang_path"] 	= $row["lang_path"];
}
$framemainsrc 	= 'blank.htm';
$strLanguage	=	" SELECT tra_text, tra_keyword
						  FROM admin_translate
						  WHERE
						  lang_id = " . $lang_id;
$db_language			= new db_query($strLanguage);
$langAdmin 				= array();
while($row	= mysql_fetch_assoc($db_language->result)){
	$langAdmin[$row["tra_keyword"]] = $row["tra_text"];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Administrator Website</title>
	<link rel="stylesheet" type="text/css" media="screen" href="resource/css/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="resource/js/sortable/styles.css" />
	<link rel="stylesheet" type="text/css" href="resource/css/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="resource/css/custom.css" />

	<script type="text/javascript" src="resource/js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="resource/js/jquery.layout.js"></script>
	<script type="text/javascript" src="resource/js/jquery-ui.custom.js"></script>

	<script language="JavaScript">
		var hei = $(window).height();
		function calcHeight(id){
			var divHeight = hei - 100;
			$("#"+id).height(divHeight);
		}
	</script>

	<script type="text/javascript">
		jQuery(document).ready(function(){

			$("#test-list").sortable({
				handle : '.handle',
				axis: 'y',
				update : function () {
					var order = $('#test-list').sortable('serialize');
					$.ajax({
						url: "resource/process-sortable.php",
						type: "post",
						data: order,
						error: function(){
							alert("Lỗi load dữ liệu");
						}
					});
				}
			});

			/*----------------------------------------*/

			$('body').layout({
				resizerClass: 'ui-state-default',
				spacing_open: 11,
				spacing_closed: 11,
				slideTrigger_open: 'mouseleave'

			});

			/*----------------------------------------*/

			var maintab = jQuery('#tabs','#RightPane').tabs({
				add: function(e, ui) {
					// append close thingy
					$(ui.tab).parents('li:first')
						.append('<span class="ui-tabs-close ui-icon ui-icon-close" title="Close Tab"></span>')
						.find('span.ui-tabs-close')
						.click(function() {
							maintab.tabs('remove', $('li', maintab).index($(this).parents('li:first')[0]));
						});
					// select just added tab
					maintab.tabs('select', '#' + ui.panel.id);
				}
			});

			/* Fix lại vị trí của các panel (trai, phải, top) */
			$('body').find('.ui-state-default-north').css({'top':'40px', 'height':'9px'});
			$('body').find('#LeftPane').css('top','50px');
			$('body').find('#RightPane').css('top','50px');
			$('body').find('.ui-layout-north').css('height','40px');

		});
	</script>

	<style type="text/css">
		.ui-layout-north{
			background: #3b5998;
		}
	</style>
</head>
<body style="font-size: 11px;">
<div class="ui-layout-north"><? include("resource/php/inc_header.php");?></div>
<!-- LeftPane -->
<div id="LeftPane" class="ui-layout-west ui-widget ui-widget-content">
	<? include('resource/php/inc_left.php');?>
	<span id="abc"></span>
</div>
<!-- #LeftPane -->

<!-- RightPane -->
<div id="RightPane" class="ui-layout-center ui-helper-reset ui-widget-content" style="overflow: hidden;">
	<!-- Tabs pane -->
	<div id="tabs" class="jqgtabs">
		<ul>
			<li><a href="#tabs-1">Trang chủ</a></li>
		</ul>
		<div id="tabs-1" style="font-size:12px; display: block;">
			<iframe id="idframe_0" src="resource/intro.php" frameborder="0" width="100%" height="500"></iframe>
		</div>
	</div>
</div>
<!-- #RightPane -->

<script type="text/javascript">
	function reload_iframe(id){
		document.getElementById(id).src = document.getElementById(id).src;
	}

	$(".tab").click(function(){
		var obj				= $(this);
		var frame_id		= obj.attr("id");
		var idtab			= "#tab_" + frame_id;
		var frame_reload	= 'idframe_' + frame_id;
		var title			= '<span class="relo reload_hide glyphicon glyphicon-refresh" onclick="reload_iframe(\'' + frame_reload + '\')" title="Reload Tab"></span>' + obj.attr("rel");
		var source			= obj.attr("href");

		if($(idtab).html() != null) {
			$("#tabs").tabs("select", idtab);
			reload_iframe('idframe_' + frame_id);
		}
		else{
			$("#tabs").tabs("add", idtab, title);
			$(idtab).append("<iframe id='idframe_" + frame_id + "' src='" + source + "' frameborder='0' width='100%' onLoad=\"calcHeight('idframe_" + frame_id + "');\"></iframe>");
		}

		return false;
	});

	/* Window resize */
	$(window).resize(function(){
		/* Fix lại vị trí của các panel (trai, phải, top) */
		$('body').find('.ui-state-default-north').css({'top':'40px', 'height':'9px'});
		$('body').find('#LeftPane').css('top','50px');
		$('body').find('#RightPane').css('top','50px');
		$('body').find('.ui-layout-north').css('height','40px');
	});
</script>
</body>

</html>