<?php $module = \Config::get('module.name');?>
<h2><?php echo l("New Post")?></h2>
<br><?php echo render('modules/'.$module.'/_form'); ?>
