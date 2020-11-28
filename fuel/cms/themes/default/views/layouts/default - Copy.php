<!DOCTYPE html>
<html class="no-js" lang="vi">
  <head>
    <title><?php echo $title; ?></title>
    <?php echo $meta_head;?>
    <!-- Share meta for facebook -->
   
      <?php 
        $image_share = Asset::find_file("share-default.jpg", 'img');
      ?>
      <meta property="og:image" itemprop="thumbnailUrl" content="<?php echo isset($og_image) ? $og_image : Uri::create($image_share);?>"/>
      <meta content="<?php echo isset($og_data["title"]) ? $og_data["title"] : $title;?>" itemprop="headline" property="og:title"/>
      <meta content="<?php echo isset($og_data["description"]) ? $og_data["description"] : Str::truncate($meta_description,300);?>" itemprop="description" property="og:description"/>
  
    <!-- //END : Share -->
    <?php if(!empty(\Registry::get_setting("site.site_gtm"))){?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-<?php echo \Registry::get_setting("site.site_gtm");?>');</script>
    <!-- End Google Tag Manager -->
    <?php } ?>
  </head>
  <?php $body_class = isset($body_class) ? $body_class : "page-default";?>
  <body class="<?php echo $body_class;?>">
  
    <header class="header">
      <div class="wrap-header">
        <div class="wrap-control-sp d-md-none">
          <div class="hamguger-menu"><span></span><span></span><span></span></div>
          <div class="logo-block"><a class="logo-wrap" href="<?php echo Uri::base();?>"><img src="<?php echo \Uri::create(\Registry::get_setting("site.site_logo"));?>" alt="logo"></a></div>
          <div class="learn-system"><?php echo l("blog_name_1")?></div>
          <div class="hot-line"><a class="phone-contact" href="tel:<?php echo \Registry::get_setting("company.company_phone")?>"><?php echo Asset::img("common/icon_phone.png")?><span><?php echo \Registry::get_setting("company.company_phone")?></span></a></div>
        </div>
        <div class="content-desc-head">
          <div class="desc-head-inner">
            <div class="top-head">
              <div class="container content-header">
                <div class="row desc-top-head">
                  <div class="col-md-3 col-lg-4 learn-system d-none d-md-block"><?php echo l("blog_name_1")?></div>
                  <div class="col-md-9 col-lg-8 learn-contact">
                    <button class="btn-collaborator"><?php echo Asset::img("common/dk.png")?><span class="d-none d-md-inline"><?php echo l("register_ctv")?></span></button><a class="phone-contact" href="tel:<?php echo \Registry::get_setting("company.company_phone")?>"><?php echo Asset::img("common/icon_phone.png")?><span class="d-none d-md-inline"><?php echo \Registry::get_setting("company.company_phone")?></span></a>
                    <div class="lang-wrap">
                      <?php $langs = fn_get_langs();?>
                      <?php foreach($langs as $lang){?>
                      <a class="<?php if($lang==\Lang::get_lang()){?>current<?php } ?>" href="?lang_code=<?php echo $lang;?>"><?php echo Asset::img("common/".$lang.".png")?></a>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="main-head container">
              <div class="row align-items-center">
                <div class="col-md-1 col-lg-3 logo-block d-none d-md-block"><a class="logo-wrap" href="<?php echo Uri::base();?>"><img src="<?php echo \Uri::create(\Registry::get_setting("site.site_logo"));?>" alt="logo"><span class="slogan d-none d-lg-inline-block"><?php echo \Registry::get_setting("site.site_slogan");?></span></a></div>
                <div class="col-md-11 col-lg-9 menu-header">
                  <nav class="navigation">
                    <?php #echo $menu_top_active;?>
                    <div class="item"><a href="<?php echo Uri::base();?>"><?php echo Asset::img("common/icon-home.png")?></a></div>
                    <?php foreach($course_categories as $ccat){
                      
                        $nav_key = "course_cat_".$ccat["id"];
                      if(!empty($ccat["childs"])){ 
                      foreach($ccat["childs"] as $cchild){ 
                        $nav_key = "course_cat_".$cchild["id"];
                        if(!empty($cchild["parent_id"])){
                          #$nav_key_parent = "course_cat_".$cchild["parent_id"];# OR $menu_top_active == $nav_key_parent
                        }
                      ?>
                      <div class="item<?php if($menu_top_active == $nav_key){?> current<?php } ?>"><a class="txt-menu-item" href="<?php echo Uri::create("course/cat/".$cchild["slug"]);?>"><?php echo $cchild["title"]?></a></div>
                      <?php } ?>
                        
                      <?php }else{?>
                        <div class="item<?php if($menu_top_active == $nav_key){?> current<?php } ?>"><a class="txt-menu-item" href="<?php echo Uri::create("course/cat/".$ccat["slug"]);?>"><?php echo $ccat["title"]?></a></div>
                      <?php } ?>
                    <?php } ?>
                    <div class="item no-current"><a class="txt-menu-item" href="#">đăng ký ngay</a></div>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
   
    <div class="wrapper">
      <?php if(isset($banners)){?>
        <?php foreach($banners as $banner):
       # print_r($banner["banner_image"]);
        ?>
        <?php 
        if(isset($banner["banner_image"])){
          $banner_image_url = cms_src_image($banner["banner_image"],array("full"=>true));
        }else{
          $banner_image_url = \Uri::create("files/banner-default.jpg");
        }
       # echo $banner_image_url;
        ?>
        <!--<i class="fa fa-angle-right" aria-hidden="true"></i>-->
      <div class="breadcrumb-banner-area" <?php if(!empty($banner_image_url)){?> style="background:rgba(0, 0, 0, 0) url(<?php echo $banner_image_url;?>) no-repeat scroll 0 0;background-size:cover" <?php } ?>>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb-text">
                            <?php if(!empty($breadcrumb_title)){?><h1 class="text-center"><?php echo $breadcrumb_title;?></h1><?php }?>
                            <div class="breadcrumb-bar">
                                <ul class="breadcrumb text-center"> 
                                    <?php foreach($breadcrumbs as $br){?>
                                    <li <?php if(!empty($br["link"])){?> class="b-link"<?php } ?>>
                                      <?php if(!empty($br["link"])){?>
                                      <a href="<?php echo $br["link"];?>"><?php echo $br["title"];?></a><?php } else { ?>
                                      <span><?php echo $br["title"];?></span>
                                      <?php } ?>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
        <?php } ?>
    
      <?php if (Session::get_flash('success_frontend')): ?>
      <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p>
        <?php echo implode('</p><p>', (array) Session::get_flash('success_frontend')); ?>
        </p>
      </div>
      <?php endif; ?>
      <?php echo $content;?>
      
      <div class="social-block">
        <?php $soc_facebook = \Registry::get_setting("social.facebook");?>
        <?php $soc_youtube = \Registry::get_setting("social.youtube");?>
        <div class="list-item"><a class="item phone-number" href="tel:<?php echo \Registry::get_setting("company.company_phone")?>"><span class="icon"><i class="fas fa-phone"></i></span><span class="txt"><?php echo \Registry::get_setting("company.company_phone")?></span></a>
          <div class="item search-filed"><span class="icon"><i class="fa fa-search"></i></span>
            <input class="serach-input" type="text" placeholder="Search">
          </div>
          <div class="item youtube"><span class="icon"><?php echo Asset::img("common/icon_youtube.png")?></span>
            <div class="txt">Youtube</div>
          </div>
          <div class="item facebook-block"><span class="icon"><i class="fab fa-facebook-f"></i></span>
            <div class="txt">Facebook</div>
          </div>
        </div>
        <div class="chat trans"><a href="#"><?php echo Asset::img("common/message.png")?></a></div>
      </div>


    </div><!--//.wrapper-->
    <?php echo $FOOTER;#\cms\themes\default\views\partials\footer.php ?>
    <?php echo $footer_include;?>
  </body>
</html>