<section class="section-top-gallery">
  <h2 class="sec-title01"><span class="txt">
    <a class="a-black" href="<?php echo Uri::create("gallery")?>">
    <?php echo l("gallery.title1")?>
    </a>
  </span></h2>
  <div class="list-img-gallery">
    <?php foreach($gallery_categories as $g_image){?>
    <div class="item-gallery">
      <div class="desc-gallery"><img src="<?php echo \Simage::get_image_size("gallery",$g_image["id"],"c","A",480,310)?>" alt="" />
        <div class="see-more-gallery">
          <div class="name text-center"><?php echo $g_image["title"];?></div><a class="btn-more text-center" href="<?php echo \Uri::create("gallery/cat/".$g_image["slug"]."?tab=all");?>"><?php echo l("gallery.DETAILS") ?></a>
        </div>
      </div>
    </div><?php } ?>
  </div>
</section>