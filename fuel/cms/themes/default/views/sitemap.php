<?php 
$rooms_nav_data = array();
foreach($rooms_nav as $_item){
  $rooms_nav_data[] = array("title"=>$_item["lang"]["title"],"url"=>Uri::create("room/".$_item["slug"]));
}

$discover_nav_data = array();
#print_r($discover_categories);
foreach($discover_categories as $_item){
  $discover_nav_data[] = array("title"=>$_item["title"],"url"=>Uri::create("saigon-discovery/cat/".$_item["slug"]));
}


$main_menu = array(
  "home" => array("module"=>"home","title"=>l("nav.home"),"url"=>Uri::base(),"class_current"=>""),
  "location" => array("module"=>"home","title"=>l("nav.location"),"url"=>Uri::create("page/location"),"class_current"=>""),
  "room" => array("module"=>"room","title"=>l("nav.room"),"url"=>Uri::create("room"),"class_current"=>"","subs"=>$rooms_nav_data),
  "meeting" => array("module"=>"meeting","title"=>l("nav.meeting"),"url"=>Uri::create("meeting"),"class_current"=>""),
  "dining" => array("module"=>"dining","title"=>l("nav.dining"),"url"=>Uri::create("dining"),"class_current"=>""),
  "offer" => array("module"=>"offer","title"=>l("nav.offer"),"url"=>Uri::create("offer"),"class_current"=>""),
  "facility" => array("module"=>"facility","title"=>l("nav.facility"),"url"=>Uri::create("facility"),"class_current"=>""),
  "saigon-discovery" => array("module"=>"discover","title"=>l("nav.discover"),"url"=>Uri::create("saigon-discovery"),"class_current"=>"","subs"=>$discover_nav_data),
  #"about-us" => array("module"=>"home","title"=>l("nav.about"),"url"=>Uri::create("page/about-us"),"class_current"=>""),
  "gallery" => array("module"=>"discover","title"=>l("nav.gallery"),"url"=>Uri::create("gallery"),"class_current"=>""),
  "contact-us" => array("module"=>"home","title"=>l("nav.contact"),"url"=>Uri::create("page/contact-us"),"class_current"=>""),
);
?>
<div class="section-facilities-page">
  <div class="title-meeting-page">
    <div class="container">
      <div class="title-room">
        <h2 class="sec-title01"><span class="txt"><?php echo l("sitemap");?></span></h2>
      </div>
    </div>
  </div>
</div>
<section class="content-sitemap-page">
  <div class="container">
    <ul class="si-root">
      <?php foreach($main_menu as $link=>$item){?>
        <li>
          <a href="<?php echo Uri::create($link)?>" class=""><?php echo $item["title"];?></a>
          <?php if(!empty($item["subs"])){ ?>
          <ul class="st-sub">
          <?php foreach($item["subs"] as $_it){ ?>
            <li><a class="btn-sub" href="<?php echo $_it["url"];?>"><?php echo $_it["title"];?></a></li>
          <?php } ?>
          </ul>
          <?php } ?>
        </li>
      <?php } ?>
      <!-- Footer -->
      
      
      <li>
        <span><?php echo l("footer.About us")?></span>
        <ul class="st-sub">
          <li><a href="<?php echo Uri::create("#section-about-us")?>"><?php echo l("footer.Introduction")?></a></li>
          <li><a target="_blank" href="<?php echo Uri::create("files/pdf/E-hotel factsheet.pdf")?>"><?php echo l("footer.Factsheet")?></a></li>
          <li><a href="<?php echo Uri::create("page/contact-us")?>"><?php echo l("footer.Contact us")?></a></li>
        </ul>
      </li>
      <li>
        <span><?php echo l("footer.Media")?></span>
        <ul class="st-sub">
          <li><a href="<?php echo Uri::create("news")?>"><?php echo l("footer.News")?></a></li>
          <li><a href="<?php echo Uri::create("saigon-discovery")?>"><?php echo l("footer.Saigon Discovery")?></a></li>
          <li><a href="<?php echo Uri::create("gallery")?>"><?php echo l("footer.Galleries")?></a></li>
        </ul>
      </li>
      
      
      <li>
        <span><?php echo l("footer.Quicklink")?></span>
        <ul class="st-sub">
          <li><a href="<?php echo Uri::create("page/careers")?>"><?php echo l("footer.Careers")?></a></li>
          <li><a href="<?php echo Uri::create("page/private-policy")?>"><?php echo l("footer.Private Policy")?></a></li>
        </ul>
      </li>

    </ul>
  </div>
</section>