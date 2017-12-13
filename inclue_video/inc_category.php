<? require_once("../functions/function_website.php");?>
<?require_once("../functions/functions.php");?>
<? require_once("../classes/generate_quicksearch.php");?>
<?require_once("../functions/pagebreak.php");?>
<?

	$iCat = getvalue("iCat", "int", "GET", 0);
			
			$page_prefix		= "";
			$normal_class		= "page_break";
			$selected_class	= "page_index_current";
			$previous			= "Trước";
			$next					= "Sau";
			$first				= "Trang đầu";
			$last					= "Trang cuối";
			$break_type			= 3;
			$url					= getURL(0,0,1,1,"page");
			$page_size			= 3;

			$count 				= 0;
			$db_count 			= new db_query("	SELECT COUNT(*) AS count
												FROM video_product
												WHERE  video_cate = " . $iCat);
			if($row_count = mysql_fetch_assoc($db_count->result)){
				$count = intval($row_count["count"]);
				}
				unset($db_count);

				$current_page		= getValue("page", "int", "GET", 1);
			

			
			

			if($count % $page_size	== 0){
				$num_of_page	= $count / $page_size;
			}else{
				$num_of_page	= (int)($count / $page_size) + 1;

			}

		// Nếu số lượng page lớn hơn 21 thì hiển thị phân trang dạng ...
			if($num_of_page > 5){
				$break_type	= 1;
				}

			if($current_page > $num_of_page) $current_page	= $num_of_page;

				if($current_page < 1) $current_page	= 1;

			
			$db_query = new db_query("SELECT *
											FROM video_product
											JOIN video_category ON(vid_id=video_cate)
											WHERE video_cate=".$iCat."
											
											LIMIT " . ($current_page-1) * $page_size . "," . $page_size);

?>

<div class="container_body">
	<div class="row container">
		<div class="col-lg-8 list_videos_left">
			<div id="list_video_show">
			<?
			while ($row = mysql_fetch_array($db_query->result)) {
				$linkvideo  = createlink("video", array("iData" => $row['video_id'], "nTitle" => $row['video_title']));
				 $url_image    = getimagesvideo($row['video_image']);

			?>
				
						<div class="row row_video_detail">
							<div class="col-lg-4 col-sm-6 col-xs-12  ">
								<a href="<?=$linkvideo?>">
									<div class="home_video_thumbs" style="">

										<img src="<?=$url_image?>" class="img-responsive">
									</div>
								</a>
							</div>
							<div class="col-lg-8  col-sm-6 col-xs-12 ">
								<a href="<?=$linkvideo?>" class="bold lead text-justify video_title"><?=$row['video_title']?></a>
								<p class="">Đăng bởi <strong><?=$row['video_user']?></strong></p>
								<p class="">Ngày đăng: <em><?= date("d/m/Y", $row["video_date"]);?> </em> </p>
							</div>	
						</div>
				<?}?>
			</div>
		
			<?
				if($count > $page_size){

		?>
		<div class="page_index" align="center"><?=generatePageBar_cucreHome($page_prefix, $current_page, $page_size, $count, $url, $normal_class, $selected_class, $previous, $next, $first, $last, $break_type, 0, 3)?></div>
		<div class="clear"></div>
		<?
	}
	?>
			
		</div>


		<div class="col-lg-4 list_videos_right">
			
			<?include 'inc_home_right.php';?>
		</div>
	</div>
</div>
<script type="text/javascript">

	$(".page_break").on("click", function(){
		var iPage 	= $(this).attr("iPage");
		var urlPage = '<?=createlink("category_cat", array("iData" => $iCat, "nTitle" => $nCat))?>';
		var urlPage = urlPage.replace("//", "/");
		window.location.href	= urlPage + "," + iPage;
	});
</script>

