 <?php $page_title = $model["lang"]["title"];
  $page_title_1 = substr($page_title,0,1);
  $page_title_2 = substr($page_title,1);
  
  #echo $page_title;
  #print_r($model);
?>
<div class="sec-title f20"><span><?php echo $page_title_1;?></span><?php echo $page_title_2;?></div>
<?php if(empty($page_form) AND $model["id"]!=1):?>
<div class="about-area mt-95">
  <div class="container">
    <?php echo remove_width_attribute($model->lang->body);?>
  </div>
</div>
<?php endif;?>
<?php if(!empty($page_form)):?>
<section class="page-content">
  <div class="container">
    <?php echo remove_width_attribute($model->lang->body);?>
  </div>
</section>  
<?php endif;?>
<?php if($model["id"]==1){?>

<section class="about-heading">
  <div class="container">
    <div class="about-content-top">
      <?php $about_title = $model["lang"]["title"];
      $about_title_1 = substr($about_title,0,1);
      $about_title_2 = substr($about_title,1);
      
      ?>
      <h3><span><?php echo $about_title_1;?></span><?php echo $about_title_2;?></h3>
      <p class="subtext">
        <?php echo $model["lang"]["summary"];?>
      </p>
      <div class="img-center position">
        <?php echo Asset::img("about/about-banner.png",array("class"=>"wow fadeInUp"));?>
      </div>
    </div>
  </div>
  <div class="bg-bottom"></div>
</section>
<section class="about-body">
  <div class="container">
    <div class="the-content wow fadeInUp">
      <?php echo remove_width_attribute($model->lang->body);?>
    </div>
  </div>
</section>
<section class="sec-about sec-about-video">
  <div class="container">
    <div class="desc-about row align-items-center">
      <div class="title-about wow fadeInUp">
        <h2><span>“</span> <?php echo l("QUALITY - ATTENTION - PROFESSIONAL")?><span>”</span></h2>
        <div class="position">JONT HENRRY<span>&nbsp;- CEO</span></div>
      </div>
    </div>
  </div>
  <a class="sec-video" data-fancybox href="https://www.youtube.com/watch?v=<?php echo $model["lang"]["data_1"]?>">
    <?php echo Asset::img("play-bg.png",array("class"=>"video-bg"))?>
    <?php echo Asset::img("play-icon.png",array("class"=>"video-icon"))?>
  </a>
</section>
<section class="section-about-content">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="about-left">
          <h3><?php echo l("page.data_2")?></h3>
          <?php   
            $data_2 = $model["lang"]["data_2"];
            $data_2_array = explode(PHP_EOL,$data_2);
          ?>
          <ul class="item-king">
            <?php if(!empty($data_2_array)){
              $f = 0.2;
              foreach($data_2_array as $txt){
                if(!empty($txt)){ ?>
            <li class="wow fadeInUp" data-wow-delay="<?php echo str_replace(",",'.',$f);?>s"><?php #echo Asset::img("icons/icon-3.png")?> <?php echo $txt;?></li>      
                <?php }
                $f+=0.2;
              }
            }?>
            
          </ul>
          
        </div>
      </div>
      <div class="col-md-6">
        <div class="about-right img-full">
          <?php $imageR = cms_get_image_one($model["id"],"page_p_R"); ?>
          <img src="<?php echo cms_src_image($imageR,array("full"=>true));?>" class="img-responsive wow fadeInUp" />
        </div>
      </div>
    </div>
    
    <div class="row pd-50">
      <div class="col-md-6">
        <div class="about-right img-full">
          <?php $imageL = cms_get_image_one($model["id"],"page_p_L"); ?>
          <img src="<?php echo cms_src_image($imageL,array("full"=>true));?>" class="img-responsive" />
        </div>
      </div>
      <div class="col-md-6">
        <div class="about-left">
          <?php echo $model["lang"]["data_3"];?>
        </div>
      </div>
      
    </div>
    
  </div>
</section>
<section class="section-business  bg-grey">
  <div class="container">
      <div class="row">
          <div class="col-lg-10 mx-auto text-center">
              <h2 class="section-heading"><?php echo l("page.data_4")?></h2>
              <hr class="my-4">
              <p class="mb-4 subtext"><?php echo l("page.data_4_sub")?></p>
          </div>
      </div>
  </div>
  <div class="container">
    <div class="row">

      <?php 
      $i=1;
      $f = 0.2;
      foreach($model["lang"]["data_4_array"] as $item){?>

      <div class="col-lg-3 col-md-4 text-center mt_30">
        <div class="repeater-4-items">
          <div class="color-text">
          <h4><?php echo $item["title"];?></h4>
          <?php $item_image = cms_get_image_one($model["id"],"page_d_".$i); ?>
          <img src="<?php echo cms_src_image($item_image,array("full"=>true));?>" class="img-responsive wow fadeInUp" data-wow-delay="<?php echo str_replace(",",'.',$f);?>s" />
          <p><?php echo Str::truncate($item["text"],100);?></p>
          <a class="btn btn-default" href="<?php echo $item["url"];?>"><?php echo l("Read more")?></a>
          </div>
        </div>
      </div><?php $i++;$f+=0.2;} ?>

    </div>
  </div>
</section>
<?php } ?>