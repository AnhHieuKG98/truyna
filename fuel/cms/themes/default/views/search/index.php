<div class="section-facilities-page">
  <div class="title-meeting-page">
    <div class="container">
      <div class="title-room">
        <h2 class="sec-title01"><span class="txt"><?php echo l("search")?></span></h2>
        <div class="search-kw col-md-12"><?php echo l("Key word");?> : <b><?php echo $search_query;?></b></div>
        <div class="block-search-in clearfix">
          <form action="<?php echo Uri::create("search")?>">
            <?php 
            $module_select  = array(
              "discover"  => l("discover.title"),
              "meeting"  => l("meeting.title"),
            )
            ?>
            <div class="col-md-2 col-xs-6">
              <input class="search-control" type="text" name="s" value="<?php echo \Input::get("s");?>" />
            </div>
            
            <div class="col-md-3 col-xs-6">
              <?php echo Form::select("m",Input::get("m"),$module_select,array("class"=>"form-control"));?>
            </div>
            <div class="col-md-2 col-xs-12 sp-center">
              <button class="btn-search-in"><!--<i class="fa fa-search"></i>--><?php echo l("search");?></button>
            </div>
          </form>
        <div>
      </div>
    </div>
  </div>
</div>
<section class="content-discover-saigon">
  <div class="container">
    <div class="row">
      <div class="col-md-8 desc-content-discover">
        <div class="list-content-discover clearfix">
          <?php foreach($posts as $p){
            
            ?>
          <div class="item col-md-6 col-xs-6 search-item-<?php echo $module;?>">
            <div class="thumb"> 
              <?php if($module == "meeting"){ ?>
                <a class="fancybox" href="<?php echo get_path_image_size($p["id"],array("module"=>$module,"object_type"=>"p","type"=>"A","full"=>true))?>">
              <?php } ?>
              <img src="<?php echo get_path_image_size($p["id"],array("module"=>$module,"object_type"=>"p","type"=>"A","width"=>350,"height"=>147))?>" alt=""/>
              <?php if($module == "meeting"){ ?>
                </a>
              <?php } ?>
              
            </div>
            <div class="desc-detail">
              <div class="title"> 
                <div class="txt-desc"><?php echo Str::truncate($p["lang"]["title"],40);?></div>
                <?php $url_share = Uri::create("discover/".$p["slug"]);?>
              </div>
              <?php 
                $sum = $p["lang"]["summary"];
                if(!empty($sum)){
              ?>
              <div class="desc sum"> 
                <?php 
                
                $sum = Str::truncate($sum,90);
                ?>
                <p><?php echo nl2br($sum);?></p>
                <?php if($module=="discover"){?>
                <a class="link-read-more" href="<?php echo Uri::create("discover/".$p["slug"])?>"><?php echo l("Read more")?></a><?php } ?>
                <!--<div class="author">Post by Ariana Carey - Introducing</div>-->
              </div>
                <?php }?>
            </div>
          </div>
          <?php } ?>
        </div>
        <div class="clearfix">
        <?php echo $pagination;?>
        </div>
      </div>
      <?php echo render("modules/discover/sidebar_search")?>
    </div>
  </div>
</section>
<?php 
  if(!empty($gallery_categories)){
    echo render("partials/blocks/gallery_categories",array("gallery_categories"=>$gallery_categories));
  }
?>