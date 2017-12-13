<?
$keyword = getValue("search_text", "str", "GET", "");
?>
<nav class="header_navigate">
	<div class="row">
		<div class="col-lg-4 col-md-6 col-sm-6 col-xs-10">
			<div class="fl">
				<i class="glyphicon glyphicon-menu-hamburger header_icon_menu"></i>
			</div>
			<div class="header_menu">

				<ul class="list-unstyled">
					<?php
					$db_query = new db_query("SELECT * FROM video_category");
					while ($row = mysql_fetch_assoc($db_query->result)) {
						$linkcategoryvideo = createlink("category_cat", array("iData" => $row['vid_id'], "nTitle" => $row['vid_title']));
						?>
						<li>
							<a href="<?= $linkcategoryvideo ?>"><?= $row['vid_title'] ?></a>
						</li>
					<?php } ?>

				</ul>
			</div>
			<div class="fl">
				<a href="/">
					<img class="header_logo" src="/css/img/logo.png">
				</a>
			</div>
		</div>
		<div class="col-lg-4 col-md-6 col-sm-6 col-xs-2">
			<form name="frm_tkmobile" action="<?=LANG_PATH?>search.php" id="frmHeaderSearch">
				<div class="input-group header_search_input">
					<input id="search_text" type="text" name="search_text" autocomplete="off" value="<?=isset($keyword) ? $keyword : "<?=translate('Nhập tên, mã sản phẩm...')?>"?>" id="search_text"
						   class="form-control" placeholder="Video, Kênh tìm kiếm...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
					</span>
				</div>
				</form>
				<i class="icon_search glyphicon glyphicon-search"></i>
			
		</div>
	</div>
</nav>
<script type="text/javascript">
	$(document).ready(function() {
		$(".header_icon_menu").click(function(){
			var obj = $(".header_menu");

			if(obj.hasClass('active')){ 
				obj.removeClass('active');
			}else{ 
				obj.addClass('active');
			}
			
		})
			

	});


	function listenKey(e) {
	  e = e ? e : window.event;
	  if(e.keyCode == 13){
	      return chkSearch();
	  }
	}

	function chkSearch() {
		var txtPlaceHolder	= $("#search_text").attr("placeholder");
		var txtSearch			= $("#search_text").val();

		txtPlaceHolder			= $.trim(txtPlaceHolder);
		txtSearch				= $.trim(txtSearch);

		if(txtSearch == "" || txtSearch == txtPlaceHolder){
			alert("<?=translate('Bạn chưa nhập từ khóa tìm kiếm !')?>");
			$("#search_text").focus();

			return false;
		}
		else return true;
	}

</script>