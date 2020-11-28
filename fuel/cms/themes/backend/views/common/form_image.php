<?php $model = isset($model) ? $model : NULL ;?>
<?php echo Form::label('Image', 'image', array('class'=>'control-label'));?>
<div class="input-group">
  <?php echo Form::input('image', Input::post('image', isset($model) ? $model["image"] : ''), array('class' => 'col-md-4 form-control elfinder-input', 'placeholder'=>'...','readonly'=>true)); ?>
  <span class="input-group-btn">
    <span class="elfinder_button btn btn-primary">Upload</span>

    <span class="btn btn-danger btn-xs remove-image <?php if(empty($model["image"])){?> hidden <?php } ?>">Remove</span>
  </span>
  <script>
    $('.remove-image').click(function(){
      $(this).parents('.image-upload-item').find('.elfinder-input').val("");
      $(this).parents('.image-upload-item').find("img.elfinder-image-input").attr("src","");
      $(this).addClass("hidden");
    });
  </script>

</div>
