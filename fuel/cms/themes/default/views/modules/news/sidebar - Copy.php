<?php $module = \Config::get('module.name');?>
<div class="col-lg-3">
  <div class="sidebar-widget">
      
      <?php if(!empty($event_recent)){?>
      <div class="single-sidebar-widget">
          <h4 class="title"><?php echo l("event.Recent Events")?></h4>
          <div class="recent-content">
            <?php foreach($event_recent as $_p){?> 
              <?php $model_image = cms_get_image_one($_p["id"],$module."_p_A");   ?>
              <div class="recent-content-item">
                  <a href="#"><img src="<?php echo cms_src_image($model_image,array("height"=>70));?>" alt=""></a>
                  <div class="recent-text">
                      <h4><a href="<?php echo Uri::create($module."/".$_p["slug"])?>"><?php echo $_p["lang"]["title"]?></a></h4>
                      <p><?php echo $_p["lang"]["summary"]?></p>
                  </div>
              </div>
            <?php } ?>
          </div>
      </div>
      <?php } ?>
      
  </div>
</div>
        
        
        
        
<div class="col-md-4 sidebar-left">
  <div class="reservation-block reservation-block-first">
    <div class="desc-content">
      <h2 class="title"><?php echo l("discover.YOUR RESERVATION")?></h2>
      <form target="_blank" action="https://www.thebookingbutton.com.au/properties/duxtonsaigondirect">
        <div class="form-reservation">
          <div class="form-group">
            <div class="item">
              <div class="desc date-time">
                <div class="flatpickr">
                    <input type="text" name="check_in_date" placeholder="<?php echo l("Check In Date")?>" data-input>
                    <span class="fa fa-calendar" data-toggle></span>
                </div>
                <!--<input name="check_in_date" autocomplete="off" type="text" value="<?php echo l("Check In Date")?>" id="checkin"><span class="fa fa-calendar"></span>-->
              </div>
            </div>
            <div class="item">
              <div class="desc date-time">
                <div class="flatpickr">
                    <input type="text" name="check_out_date" placeholder="<?php echo l("Check Out Date")?>" data-input>
                    <span class="fa fa-calendar" data-toggle></span>
                </div>
                <!--<input name="check_out_date" autocomplete="off" type="text" value="<?php echo l("Check Out Date")?>" id="checkout"><span class="fa fa-calendar"></span>-->
              </div>
            </div>
            <div class="item">
              <div class="desc select-desc">
                <select name="number_adults">
                  <option value="0"><?php echo l("Adults")?></option>
                  <?php for($i=1;$i<=10;$i++){?>
                  <option value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?>
                </select><span class="fa fa-angle-down"></span>
              </div>
            </div>
            <div class="item">
              <div class="desc select-desc">
                <select name="number_children">
                  <option value="0"><?php echo l("Childrens")?></option>
                  <?php for($i=1;$i<=10;$i++){?>
                  <option value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?>
                </select><span class="fa fa-angle-down"></span>
              </div>
            </div>
            <div class="item btn-check"><button class="btn-more" ><?php echo l("check availability")?></button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php if(!empty($event_recent)){?>
  <div class="recent-post-block">
    <h2 class="title"><?php echo l($module.".Recent post")?></h2>
    <div class="list-recent-post">
      <?php foreach($event_recent as $_p){?> 
      <div class="item"> <a class="thumb trans" href="<?php echo Uri::create($module."/".$_p["slug"])?>"><img src="<?php echo get_path_image_size($_p["id"],array("module"=>$module,"object_type"=>"p","type"=>"A","width"=>360,"height"=>153))?>" alt=""/></a><a class="title trans" href="<?php echo Uri::create($module."/".$_p["slug"])?>"><?php echo $_p["lang"]["title"]?></a>
        <div class="date-time hidden">at <?php echo date("H:i A, d F Y",$_p["created_at"])?></div>
      </div><?php } ?>
    </div>
  </div>
  <?php } ?>
</div>