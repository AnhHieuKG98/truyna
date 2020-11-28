<?php $url_share = Uri::create($module."/".$p["slug"]);?>
<div class="item">
  <div class="thumb"> <img src="<?php echo get_path_image_size($p["id"],array("module"=>$module,"object_type"=>"p","type"=>"A","width"=>750,"height"=>319))?>" alt=""/>
  </div>
  <div class="desc-detail">
    <div class="title"> 
      <div class="month"> <span class="txt-day"><?php echo date("d",$p["created_at"])?></span><span class="txt-month"><?php echo date("M",$p["created_at"])?></span></div>
      <a class="txt-desc" href="<?php echo $url_share;?>"><?php echo $p["lang"]["title"];?></a>
      <?php echo render("partials/blocks/share",array("url_share"=>$url_share));?>
    </div>
    <div class="desc sum"> 
      <p><?php echo Str::truncate(nl2br($p["lang"]["summary"]),300);?></p><a class="link-read-more" href="<?php echo Uri::create($module."/".$p["slug"])?>"><?php echo l("Read more")?></a>
    </div>
  </div>
</div>


<div class="article">
  
	<div class="ArticleRightContent">	
		<div class="articleImage"><img src="<?php echo get_path_image_size($p["id"],array("module"=>$module,"object_type"=>"p","type"=>"A","width"=>750,"height"=>319))?>" alt=""></div>
	</div>
	
  
	<div class="ArticleLeftContent">
  
		<div class="articleHeadline">
		    <h1><a style="text-decoration:none" href="<?php echo $url_share;?>"><span><?php echo $p["lang"]["title"];?></span></a></h1>
		    <div class="articleAuthor Normal" style="margin-right: 5px; text-align: right; font: italic 8pt Tahoma; color: #C4C4C4;"> <?php echo date("H:i d/m/Y",$p["created_at"])?> </div>
		</div>
		<div class="articleEntry Normal">
			<div class="header">
<div class="box-widget desnews" style="margin-bottom: 10px;"><?php echo Str::truncate(strip_tags($p["lang"]["body"]),300);?></div>
</div>
		</div>
	
	</div>
	
</div>