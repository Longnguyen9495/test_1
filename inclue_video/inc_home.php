<?
$sort			= getValue("sort");
switch($sort){
	case 1: $sqlOrderBy = "video_title ASC"; break;
	case 2: $sqlOrderBy = "video_title DESC"; break;
	default:$sqlOrderBy = "video_title DESC"; break;
}

$page_size		= 10;
$page_prefix	= "Page(s): ";
$normal_class	= "page";
$selected_class= "page_current";
$previous		= "<";
$next				= ">";
$first			= "<<";
$last				= ">>";
$break_type		= 1;//"1 => << < 1 2 [3] 4 5 > >>", "2 => < 1 2 [3] 4 5 >", "3 => 1 2 [3] 4 5", "4 => < >"
$url				= getURL(0,0,1,1,"page");
$db_count		= new db_query("SELECT COUNT(*) AS count FROM video_product");
$row_count		= mysql_fetch_array($db_count->result);
$total_record	= $row_count["count"];
$current_page	= getValue("page", "int", "GET", 1);
if($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
else $num_of_page = (int)($total_record / $page_size) + 1;
if($current_page > $num_of_page)$current_page = $num_of_page;
if($current_page < 1) $current_page = 1;
$db_count->close();
unset($db_count);
$db_data_listing = new db_query("SELECT *
								FROM video_product
								ORDER BY " . $sqlOrderBy . "
								LIMIT " . ($current_page-1) * $page_size . "," . $page_size);


?>
<div class="container_body">
	<div class="row container">
		<div class="col-lg-8 list_videos_left">
			<div id="list_video_show">
				<?
				while($listing = mysql_fetch_assoc($db_data_listing->result)){
					$linkvideo  = createlink("video", array("iData" => $listing['video_id'], "nTitle" => $listing['video_title']));
					$url_image    = getimagesvideo($listing['video_image']);
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
							<a href="<?=$linkvideo?>" class="bold lead text-justify video_title"><?=$listing['video_title']?></a>
							<p class="">Đăng bởi <strong><?=$listing['video_user']?></strong></p>
							<p class="">Ngày đăng: <em> <?= date("d/m/Y", $listing["video_date"]);?></em></p>
						</div>
					</div>
				<?php }?>
			</div>
			<div class="box_btn_viewmore row">
				<?	if($total_record > $page_size){?>
				<div align="right"><?=generatePageBar($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous, $next, $first, $last, $break_type)?></div>
				<? }?>
			</div>
		</div>
		<div class="col-lg-4 list_videos_right">
			<? include 'inc_home_right.php'; ?>
		</div>
	</div>
</div>
