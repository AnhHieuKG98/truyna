<div class="section-facilities-page">
  <div class="title-meeting-page">
    <div class="container">
      <div class="title-room">
        <h2 class="sec-title01"><span class="txt"><?php echo $cat_data["lang"]["title"];?></span></h2>
      </div>
    </div>
  </div>
</div>
<section class="content-discover-saigon">
  <div class="container">
    <div class="row">
      <div class="col-md-8 desc-content-discover">
        <div class="list-content-discover">
          <?php foreach($models as $p){
            echo render("modules/".$module."/loop",array("module"=>$module,"p"=>$p));
          } ?>
        </div>
        
        <?php echo $pagination;?>
      </div>
      <?php echo render("modules/".$module."/sidebar")?>
    </div>
  </div>
</section>