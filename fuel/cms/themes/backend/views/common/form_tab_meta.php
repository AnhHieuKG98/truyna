<div class="col-md-8">
  <fieldset>
    <div class="form-group">
      <?php echo Form::label(l('Meta keywords'), 'meta_keywords', array('class'=>'control-label')); ?>
        <?php echo Form::textarea('meta_keywords', Input::post('meta_keywords', isset($model) ? $model->lang->meta_keywords : ''), array('class' => 'col-md-8 form-control', 'rows' => 2, 'placeholder'=>'Meta keywords')); ?>

    </div>
    <div class="form-group">
      <?php echo Form::label(l('Meta description'), 'meta_description', array('class'=>'control-label')); ?>
        <?php echo Form::textarea('meta_description', Input::post('meta_description', isset($model) ? $model->lang->meta_description : ''), array('class' => 'col-md-8 form-control', 'rows' => 3, 'placeholder'=>'Meta description')); ?>

    </div>
    <div class="image-upload-item">
      <div class="form-group">
        <?php echo Form::label('og:Image', 'og_image', array('class'=>'control-label'));?>
        <div class="input-group">
          <?php echo Form::input('og_image', Input::post('og_image', isset($model) ? $model["og_image"] : ''), array('class' => 'col-md-4 form-control elfinder-input', 'placeholder'=>'...','readonly'=>true)); ?>
          <span class="input-group-btn">
            <span class="elfinder_button btn btn-primary">Upload</span>
            
            <span class="btn btn-danger btn-xs remove-image <?php if(empty($model["og_image"])){?> hidden <?php } ?>">Remove</span>
          </span>
          <script>
            $('.remove-image').click(function(){
              $(this).parents('.row').find('[name="og_image"]').val("");
              $(this).parents('.row').find("img.elfinder-image-input").attr("src","");
              $(this).addClass("hidden");
            });
          </script>
          
        </div>
      </div>
      <div class="form-group col-md-6">
        <img class="elfinder-image-input img-responsive" <?php if(!empty($model["og_image"])){?>src="<?php echo Uri::base();echo $model["og_image"];?>" <?php } ?> data-src="<?php echo Uri::base();?>"  />
     </div>
     <div class="clearfix"></div>
    </div>
  </fieldset>
</div>