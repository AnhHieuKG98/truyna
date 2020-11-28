<?php $module = \Config::get('module.name');?>
<div class="col-xl-3 col-lg-3">
  <div class="sidebar">
    <div id="accordion" class="my-accordion">
      <?php 
      $l = 0;
      foreach($news_categories as $cat){?>
      <div class="my-card">
        <div class="my-card-header" id="heading-<?php echo $cat["id"];?>">
          <h5 class="mb-0">
            <button class="btn btn-link <?php if($l==0){?>collapsed__BK<?php } ?>" data-toggle="collapse" data-target="#collapse-<?php echo $cat["id"];?>" aria-expanded="<?php if($l==0){?>true<?php }else{ ?>false<?php } ?>" aria-controls="collapse-<?php echo $cat["id"];?>">
              <?php echo $cat["title"]?> 
              <span class="icn plus"><i class="fas fa-plus-circle"></i></span>
              <span class="icn minus"><i class="fas fa-minus-circle"></i></span>
            </button>
          </h5>
        </div>

        <div id="collapse-<?php echo $cat["id"];?>" class="collapse <?php if($l==0){?>show<?php } ?>" aria-labelledby="heading-<?php echo $cat["id"];?>" data-parent="#accordion">
          <div class="my-card-body">
            <ul>
              <?php foreach($cat["posts"] as $post){?>
              <li><a href="<?php echo Uri::create($module."/".$post["slug"])?>"><?php echo $post["lang"]["title"]?></a></li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
      <?php $l++;
      } ?>
    </div>
  </div><!--//.sidebar-->
</div>