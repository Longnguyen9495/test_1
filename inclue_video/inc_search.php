

<? require_once("../functions/function_website.php");?>
<?require_once("../functions/functions.php");?>
<? require_once("../classes/generate_quicksearch.php");?>
<?
$keyword  = getValue("search_text","str","GET", "");

$sqlWheree		= "";
$keyword_old	= $keyword;
$sqlWheree			.= ' AND video_active = 1 AND video_title LIKE "%' . $keyword . '%"';

$page_size		= 2;
$normal_class		= "page_break";
	$selected_class	= "page_index_current";
	$page_prefix	= "Page(s): ";
	$previous		= "<";
	$next				= ">";
	$first				= "<<";
	$last					= ">>";
	$break_type			= 3;
	$url					= getURL(0,0,1,1,"page");



$db_count		= new db_query("SELECT COUNT(*) AS count
										 FROM video_product
										 WHERE 1 " . $sqlWheree);

$row_count		= mysql_fetch_array($db_count->result);

$total_record	= $row_count["count"];
$current_page		= getValue("page", "int", "GET", 1);

if($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
else $num_of_page = (int)($total_record / $page_size) + 1;
if($current_page > $num_of_page)$current_page = $num_of_page;
if($current_page < 1) $current_page = 1;
$db_count->close();
unset($db_count);
//End get page break params
//Get data listing
$db_data_listing = new db_query("SELECT *
											FROM video_product
											WHERE 1 " . $sqlWheree . "
											LIMIT " . ($current_page-1) * $page_size . "," . $page_size);
?>

<div class="container_body">
	<div class="row container">
		<div class="col-lg-8 list_videos_left">
			<div id="list_video_show">
	<div class="search_title">
			<h1 class="title bold">Tìm kiếm</h1>
			<h2 class="text" style="padding-bottom: 10px;font-size: 18px;color: blue;">
				Tìm thấy <?=$total_record?> sản phẩm có từ khóa&nbsp;
				"<span class="bold"><?=$keyword_old?></span>"
			</h2>
		</div>


				<?
					while($listing = mysql_fetch_array($db_data_listing->result)){
						$url_image    = getimagesvideo($listing['video_image']);
					$linkvideo  = createlink("video", array("iData" => $listing['video_id'], "nTitle" => $listing['video_title']));
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
								<p class="">Ngày đăng: <em><?= date("d/m/Y", $listing["video_date"]);?> </em> </p>
							</div>	
						</div>
						<?}?>
				
			</div>
			<div class="box_btn_viewmore row">
				<?	if($total_record > $page_size){?>
				<div align="right"><?=generatePageBar($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous, $next, $first, $last, $break_type)?></div>
				<? }?>
			</div>
				
		</div>
		<div class="col-lg-4 list_videos_right">
			
			<?include 'inc_home_right.php';?>
		</div>
	</div>
</div>
