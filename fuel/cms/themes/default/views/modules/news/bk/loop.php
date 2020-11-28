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