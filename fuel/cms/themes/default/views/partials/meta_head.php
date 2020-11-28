<!-- CORE HEAD -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="<?php echo $meta_description;?>" />
<meta name="keywords" content="<?php echo $meta_keywords;?>" />
<meta name="robots" content="index, follow">
<meta name="author" content="">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<?php #echo Asset::css("bootstrap.min.css");?>
<?php #echo Asset::css("style.css");?>

<?php echo Asset::css("default.css");?>
<?php echo Asset::css("module.css");?>
<?php echo Asset::css("skin.css");?>
<?php echo Asset::css("TC6/container.css");?>
<?php echo Asset::css("BlueColor/container.css");?>
<?php echo Asset::css("portal.css");?>
<?php echo Asset::css("StandardMenu.css");?>
<?php echo Asset::css("home.css");?>
<?php echo Asset::css("Template.css");?>


<?php echo Asset::css("jquery.jscrollpane.css");#js?>
<?php echo Asset::css("style.css");?>
<?php #echo Asset::css("AAAAAAAAAAA.css");?>
<?php #echo Asset::css("AAAAAAAAAAA.css");?>
<?php 
  $favicon = \Registry::get_setting("site.site_favicon");
  if(empty($favicon)){
    $favicon = \Uri::create(Asset::find_file("favicon.png", 'img'));
  }
?>
<link rel="shortcut icon" href="<?php echo $favicon;?>">    
  <!-- //CORE HEAD -->
<?php if(isset($meta_head_hook)){
  echo $meta_head_hook;
}
?>