<?php $module = \Config::get('module.name');?>
<h2><?php echo l("Editing Post")?></h2>
<?php echo render('modules/'.$module.'/_form',array('model'=>$model)); ?>
