<div class="right_list_follow">
	<h3 class="">Video mới</h3>
	<?php
	$db_query = new db_query("SELECT * FROM video_product  ORDER BY video_id DESC LIMIT 5");
	while ($row = mysql_fetch_assoc($db_query->result)) {
		$linkvideo = createlink("video", array("iData" => $row['video_id'], "nTitle" => $row['video_title']));
		$url_image = getimagesvideo($row['video_image']);
		?>
		<div class="list_follow_detail row">
			<div class="col-lg-6">
				<a href="<?= $linkvideo ?>">
					<img class="img-responsive" src="<?= $url_image ?>" style="margin-top: 4px;">
				</a>
			</div>
			<div class="col-lg-6">
				<a href="<?= $linkvideo ?>"><strong><?= $row['video_title'] ?></strong></a><br>
				<span>by: <bold><?= $row['video_user'] ?>
						<bold></span>
			</div>
		</div>
	<?php } ?>
</div>
<div class="right_list_follow">
	<h3 class="">Video nổi bật</h3>
	<?php
	$db_query = new db_query("SELECT * FROM video_product WHERE video_active = 1 ORDER BY video_id DESC LIMIT 5");
	while ($row = mysql_fetch_assoc($db_query->result)) {
		$linkvideo = createlink("video", array("iData" => $row['video_id'], "nTitle" => $row['video_title']));
		$url_image = getimagesvideo($row['video_image']);
		?>
		<div class="list_follow_detail row">
			<div class="col-lg-6">
				<a href="/home/detail.php">
					<img class="img-responsive" src="<?= $url_image ?>" style="margin-top: 4px;">
				</a>
			</div>
			<div class="col-lg-6">
				<a href="<?= $linkvideo ?>"><strong><?= $row['video_title'] ?></strong></a><br>
				<span>by :<bold><?= $row['video_user'] ?>
						<bold></span>
			</div>
		</div>
	<?
	}
	?>
</div>