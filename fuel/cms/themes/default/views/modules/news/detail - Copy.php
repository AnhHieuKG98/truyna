<?php $module = \Config::get('module.name');
$post = $model;
$event_date_int = strtotime($post["lang"]["event_date"]);
?>
<?php $url_share = Uri::create($module."/".$post["slug"]);?>
<div class="event-details-area section-padding">
  <div class="container">
      <div class="row">
         <div class="col-lg-9 col--12">
              <div class="events-details-right-sidebar">
                  <div class="events-details-img1 img-full">
                        <h3><?php echo $post["lang"]["title"];?></h3>
                      <?php $model_image = cms_get_image_one($post["id"],$module."_p_A");   ?>
                      <img alt="" src="<?php echo cms_src_image($model_image,array("full"=>true));?>">
                  </div>
                  <div class="event-content">
                      <?php echo $post["lang"]["body"];?>
                  </div>
                  <?php echo render("partials/blocks/share",array("url_share"=>$url_share));?>
              </div>
          </div>
          <?php echo render("modules/".$module."/sidebar")?>
          
        
      </div>
  </div>
</div>
     