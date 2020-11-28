<!DOCTYPE html>
<html class="no-js" lang="<?php echo \Lang::get_lang();?>">
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
      <div id="DNN6" class="TwoColRight">
        
          <?php echo $HEADER;?>
          <div class="divbody">
            <div id="Content">
              <div id="Panes">
                <?php echo $content;?>
              </div>
            </div>
          </div>
        
      <?php echo $FOOTER;#\cms\themes\default\views\partials\footer.php ?>
      </div>
    <?php echo $footer_include;?>
  </body>
</html>