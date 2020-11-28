<?php $url_share = Uri::create($module."/".$p["slug"]);?>
<div class="article">
  
	<div class="ArticleRightContent">	
		<div class="articleImage"><img src="<?php echo get_path_image_size($p["id"],array("module"=>$module,"object_type"=>"p","type"=>"A","width"=>750,"height"=>319))?>" alt=""></div>
	</div>
	
  
	<div class="ArticleLeftContent">
  
		<div class="articleHeadline">
		    <h1><a style="text-decoration:none" href="<?php echo $url_share;?>"><span><?php echo Str::truncate($p["lang"]["title"],111);?></span></a></h1>
		    <div class="articleAuthor Normal" style="margin-right: 5px; text-align: right; font: italic 8pt Tahoma; color: #C4C4C4;"> <?php echo date("H:i d/m/Y",$p["created_at"])?> </div>
		</div>
		<div class="articleEntry Normal">
			<div class="header">
<div class="box-widget desnews" style="margin-bottom: 10px;"><?php echo Str::truncate(strip_tags($p["lang"]["body"]),300);?></div>
</div>
		</div>
	
	</div>
	
</div>