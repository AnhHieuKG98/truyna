<?php 
#các posts , show ảnh đại diện các post 
if(isset($module_gallery_images)){ 
  $link_detail = "";
  if(isset($module_gallery_category))
    $link_detail = Uri::create("gallery/cat/".$module_gallery_category["slug"])."?tab=gall-";
?>
  <section class="section-top-gallery">
    <h2 class="sec-title01"><span class="txt">
      <a class="a-black" href="<?php echo Uri::create("gallery")?>">
      <?php echo l("gallery.title1")?>
      </a>
    </span></h2>
    <div class="list-img-gallery">
      <?php foreach($module_gallery_images as $g_image){?>
      <div class="item-gallery">
        <div class="desc-gallery"><img src="<?php echo \Simage::get_image_size("gallery",$g_image["id"],"b","A",480,310)?><?php #echo \Gallery\Simage::get_image_size($g_image["image_path"],480,310);?>" alt="" />
          <div class="see-more-gallery">
            <div class="name text-center"><?php echo $g_image["lang"]["title"];?></div><a class="btn-more text-center" href="<?php echo $link_detail.$g_image["id"];#echo \Uri::create("gallery/detail/".$g_image["object_id"]);?>"><?php echo l("gallery.DETAILS") ?></a>
          </div>
        </div>
      </div><?php } ?>
    </div>
  </section>
<?php }else{ ?>
  <section class="section-top-gallery">
    <h2 class="sec-title01"><span class="txt">
      <a class="a-black" href="<?php echo Uri::create("gallery")?>">
      <?php echo l("gallery.title1")?>
      </a>
    </span></h2>
    <div class="list-img-gallery">
      <?php foreach($gallery_images as $g_image){?>
      <div class="item-gallery">
        <div class="desc-gallery"><img src="<?php echo \Simage::get_image_size("gallery",$g_image["id"],"b","A",480,310)?>" alt="" />
          <div class="see-more-gallery">
            <div class="name text-center"><?php echo $g_image["lang"]["title"];?></div><a class="btn-more text-center" href="<?php echo \Uri::create("gallery");?>"><?php echo l("gallery.DETAILS") ?></a>
          </div>
        </div>
      </div><?php } ?>
    </div>
  </section>
<?php } ?>