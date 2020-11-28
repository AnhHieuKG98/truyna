<?php $obj_id =  "form_category_update".(isset($model) ? $model->id : '0');?>
<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label(l('Title'), 'title', array('class'=>'control-label')); ?>
			<?php echo Form::input('title', Input::post('title', isset($model) ? $model->lang->title : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Title')); ?>
      <?php 
     # if(isset($val)){ 
        #if ($val->error('title')):
        #  echo \Helper::tm_alert($val,NULL,NULL);
        #endif; 
      #}?>
		</div>
    <div class="form-group">
			<?php echo Form::label(l('Parent'), 'parent_id', array('class'=>'control-label')); ?>
      <?php echo Shtml::select('parent_id', isset($model) ? $model->parent_id : '', array("0"=>"")+$categories,array('class'=>'form-control'),isset($model) ? $model->id : '');?>
		</div>
    <div class="row">
      <div class="image-upload-item">
        <div class="form-group col-md-6 col-sm-6 col-xs-12">
          <?php echo Form::label(l('Slug'), 'slug', array('class'=>'control-label')); ?>
          <?php echo Form::input('slug', Input::post('slug', isset($model) ? $model->slug : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Slug')); ?>
        </div>
        <div class="form-group col-md-4 col-sm-6 col-xs-12">
          <?php echo render("common/form_image",array('model'=>isset($model) ? $model : NULL));?>
        </div>
         <div class="form-group col-md-2 col-sm-6 col-xs-12">
          <img class="elfinder-image-input img-responsive" <?php if(!empty($model->image)){?>src="<?php echo Uri::base();echo $model->image;?>" <?php } ?> data-src="<?php echo Uri::base();?>"  />
         </div>
        </div>
    </div>
		<div class="form-group">
			<?php echo Form::label(l('Summary'), 'summary', array('class'=>'control-label')); ?>
			<?php echo Form::textarea('summary', Input::post('summary', isset($model) ? $model->lang->summary : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Summary')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label(l('Body'), 'body', array('class'=>'control-label')); ?>
			<?php echo Form::textarea('body', Input::post('body', isset($model) ? $model->lang->body : ''), array('class' => 'col-md-8 form-control ckeditor', 'rows' => 8, 'placeholder'=>'Body')); ?>
		</div>
    <div class="col-md-12">
      <div class="row">
        <div class="form-group col-md-3">
          <?php echo Form::label(l('Status'), 'status', array('class'=>'control-label')); ?>        
            <?php echo Shtml::dropdown_status($obj_id,isset($model) ? $model : NULL);?>
        </div>
        <div class="form-group col-md-4 ">
          <div class="form-group col-md-3">
          <?php echo Form::label(l('Position'), 'position', array('class'=>'control-label')); ?></div>
          <div class="form-group col-md-6 pull-left">
            <?php echo Form::input('position', Input::post('position', isset($model) ? $model->position : ''), array('class' => 'form-control', 'placeholder'=>'Position')); ?>
          </div>
        </div>
      </div>
    </div>
    <?php echo render("common/form_tab_meta",array('model'=>isset($model) ? $model : NULL));?>
    <div class="clearfix"></div>
    <?php echo $form_buttons; ?>
	</fieldset>
<?php echo Form::close(); ?>