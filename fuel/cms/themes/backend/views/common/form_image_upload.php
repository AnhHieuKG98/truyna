<div class="form-group">
  <?php echo Form::label($file["label"], $file["name"], array('class'=>'control-label')); ?>
  <!--<input type="file" name="<?php echo $file["name"];?><?php if(isset($file["multiple"])){ ?>[]<?php } ?>" <?php if(isset($file["multiple"])){ ?>multiple <?php } ?> />-->
  
  <?php 
  $input_name = $file["name"];
  $input_id = $file["name"];
  if(isset($file["multiple"])){
    $input_name .= "[]";
  }
  $_params = array(
    "obj_id"  => $input_name,
  );
  if(isset($file["multiple"])){
    $_params["multiple"]  = true ;
  }
  
  echo  render("common/form_upload",$_params);?>
  
  <?php if(!empty($object_id)):?>
  <div class="col-md-12">
    <div class="row">
    <?php 
      $images = cms_get_images(isset($object_id) ? $object_id : 0,$file["name"]);
      foreach($images as $image){ ?>
        <div class="col-md-2">
          <img src="<?php echo cms_src_image($image,array("width"=>100,"height"=>80));?>" />
          <div class="clearfix">
             <label>
              <input type="checkbox" class="flat" name="remove_image[<?php echo $image["id"]?>]"> <?php echo l("Remove");?>
             </label>
           </div>
        </div>
      <?php }
    ?>
    </div>
  </div>
  <?php endif;?>
</div>
  