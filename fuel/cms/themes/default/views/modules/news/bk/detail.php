<?php $module = \Config::get('module.name');
$post = $model;
?>
<div class="section-facilities-page">
  <div class="title-meeting-page">
    <div class="container">
      <div class="title-room">
        <h2 class="sec-title01"><span class="txt"><?php echo l($module.".title");?></span></h2>
      </div>
    </div>
  </div>
</div>
<section class="content-discover-saigon">
  <div class="container">
    <div class="row">
      <div class="col-md-8 desc-content-discover">
        <?php if(!empty($post)){?>
        <div class="list-content-discover">
          <div class="item">
            <div class="thumb"> <img src="<?php echo get_path_image_size($post["id"],array("module"=>$module,"object_type"=>"p","type"=>"A","width"=>750,"height"=>319))?>" alt=""/>
            </div>
            <div class="desc-detail">
              <div class="title"> 
                <div class="month"> <span class="txt-day"><?php echo date("d",$post["created_at"])?></span><span class="txt-month"><?php echo date("M",$post["created_at"])?></span></div>
                <div class="txt-desc"><?php echo $post["lang"]["title"];?></div>
                   <?php $url_share = Uri::create($module."/".$post["slug"]);?>
                <?php echo render("partials/blocks/share",array("url_share"=>$url_share));?>
              </div>
              <div class="desc"> 
                <?php echo remove_width_attribute($post["lang"]["body"]);?>
                <!--<div class="author float-right">My Nguyen</div>-->
              </div>
            </div>
          </div>
        </div><?php } ?>
      </div>
      <?php echo render("modules/".$module."/sidebar")?>
    </div>
  </div>
</section>