<?php $module = \Config::get('module.name');?>
<?php $obj_id =  "form_banner_update".(isset($model) ? $model->id : '0');?>
<?php echo Form::open(array("class"=>"form-horizontal","enctype"=>"multipart/form-data")); ?>
<div class="col-md-12">
<fieldset>
  <div class="form-group">
    <?php echo Form::label(l('Title'), 'title', array('class'=>'control-label')); ?>

      <?php echo Form::input('title', Input::post('title', isset($model) ? $model->lang->title : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Title')); ?>
      <?php
      if(isset($val)){
        if ($val->error('title')):
          echo \Helper::tm_alert($val,NULL,NULL);
        endif;
      }?>
  </div>
  <div class="form-group">
    <?php echo Form::label(l($module.'.title2'), 'title2', array('class'=>'control-label')); ?>
    <?php echo Form::input('title2', Input::post('title2', isset($model) ? $model->lang->title2 : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>l($module.'.title2'))); ?>

  </div>


  <div class="form-group">
    <?php echo Form::label(l('Summary'), 'summary', array('class'=>'control-label')); ?>

      <?php echo Form::textarea('summary', Input::post('summary', isset($model) ? $model->lang->summary : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Summary')); ?>

  </div>
  <div class="form-group">
    <?php echo Form::label(l('Url'), 'url', array('class'=>'control-label')); ?>

      <?php echo Form::input('url', Input::post('url', isset($model) ? $model->url : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Url')); ?>
  </div>




  <div class="form-group ">
    <?php echo Form::label(l('Status'), 'status', array('class'=>'control-label')); ?>
    <div class="clearfix"></div>
    <?php echo Shtml::dropdown_status($obj_id,isset($model) ? $model : NULL);?>

  </div>
  <div class="form-group">

    <?php echo Form::label(l('Position'), 'position', array('class'=>'control-label')); ?>

      <?php echo Form::input('position', Input::post('position', isset($model) ? $model->position : ''), array('class' => 'form-control', 'placeholder'=>'Position')); ?>
  </div>
  <div class="form-group">
    <?php echo render("common/form_image_upload",array("object_id"=>isset($model) ? $model["id"] : 0,"file"=>array("label"=>l("Image"),"name"=>$module."_p_A")))?>
  </div>

  <div class="form-group">
    <?php echo Form::label(l('Module'), 'module', array('class'=>'control-label')); ?>
      <?php 
      $module_select = array(
        ""  => "---",
        "home"  => "Home",
        "teacher"  => "Teacher",
        "event"  => "Event",
        "news"  => "News",
       
      );
      ?>
      <?php echo Form::select('module', Input::post('module', isset($model) ? $model->module: ''),$module_select, array('class' => 'form-control')); ?>

  </div>
  </fieldset>
</div>




  <div class="clearfix"></div>
  <?php echo $form_buttons; ?>
<?php echo Form::close(); ?>
