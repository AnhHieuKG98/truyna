<?php $module = \Config::get('module.name');?>
<h2><?php echo l("Editing Category")?> [<?php echo $model->lang->title;?>]</h2>
<?php echo render('modules/'.$module.'/category/_form',array('model'=>$model,'categories'=>$categories)); ?>
