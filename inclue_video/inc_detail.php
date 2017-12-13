
<div class="container_body">
	<div class="row container">
		<div class="col-lg-8 col-md-6">
			<!-- iframe video -->
         
			<div class="embed_video">
            <?
               $id_vide = '';
               $link_video = '';
               $pos_v = strpos($arrayInfoProduct['video_youtobe'], "?v=");

               if(intval($pos_v)) $id_vide = substr($arrayInfoProduct['video_youtobe'], $pos_v + 3);
               if($id_vide) $link_video = 'https://www.youtube.com/embed/' . $id_vide;
               $script_embeded = '<iframe src="'. $link_video .'?api=1&amp;title=0&amp;byline=0&amp;portrait=0" videotype="vimeo" width="100%" height="400" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>';
               if($link_video) echo $script_embeded;

            ?>
            




         </div>
         <!-- Tiêu đề + nút thích -->
         <div class="row video_box_title">
         	<div class="col-lg-8 col-md-10">
         		<h3 class=""><?=$arrayInfoProduct['video_title']?></h3>
         	</div>
         	
         </div>
         <!-- Người up + views + nut share FB -->
         <div class="row video_box_other">
         	<div class="col-lg-6 col-md-10">
         		<table>
               <?
               $url_image = getimagesvideo($arrayInfoProduct['video_image']);

               ?>
         			<tr>
         				<td width="60" style="padding: 0px 5px" >
         					<a href="#">
									<img class="avatar img-rounded" src="<?=$url_image?>" style="margin-top: 4px;width: 100px">
								</a>
         				</td>
         				<td valign="top">
         					<p>by <strong><?=$arrayInfoProduct['video_user']?></strong></p>
			         		 
         				</td>
         			</tr>
         		</table>
         	</div>
         	
         </div>
         <!-- Thông tin về video -->
         <div class="video_box_about">
         	<div class="video_box_tabs">
         		
         	</div>
         	<div class="video_detail" id="">
         		
         	</div>
         </div>

         <!-- Video liên quan -->
         <div class="row video_list_other">
         	<h3 class="col-lg-12">Video cùng chuyên mục</h3>
         	<?
            $arrayProductCategory   = getlistvideopro($arrayInfoProduct['video_cate'], "", 0, 10, " AND video_id NOT IN(" . $arrayInfoProduct['video_id'] . ")");
            $arrayProductCategory = array_merge($arrayProductCategory);
          
             foreach ($arrayProductCategory as $key => $value) {
                 $linkvideo  = createlink("video", array("iData" => $value['video_id'], "nTitle" => $value['video_title']));
             $url_image    = getimagesvideo($value['video_image']);
             ?>
         	<div class="col-lg-3 col-sm-6 col-xs-10 video_others">
         		<a href="<?=$linkvideo?>">
	         		<div class="video_thumbs">
	         			<img class="img-responsive" src="<?=$url_image?>" >
	         		</div>
	         		<div class="video_title">
	         			<strong class=""><?=$value['video_title']?></strong><br>
	         			<em  style="color: #ccc;"><?=$value['video_user']?></em>
	         		</div>
         		</a>
         	</div>
         	<?
         	}
         	?>

         </div>
		</div>
		<div class="col-lg-4 col-md-6 detail_right">
			<?include 'inc_home_right.php';?>
		</div>
	</div>
</div>