<?php $module = \Config::get('module.name');?>
<h2><?php echo l('New category')?></h2>
<?php echo render('modules/'.$module.'/category/_form',array('categories'=>$categories)); ?>