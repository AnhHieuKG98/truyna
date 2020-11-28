<input id="copyTarget" type="text" class="" style="position:absolute;left:-10000px;" />
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><?php echo $title;?> <small><?php echo $text;?></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <?php echo Form::open(array("class"=>"form-horizontal form-label-left")); ?>
          <?php foreach($model as $m){
            $_id = $m["id"];
            $tag = $m["tag"];
            ?>
          <div class="form-group">
            <!-- <?php echo "\Registry::get_setting(\"".$m["type"].".".$m["name"]."\")" ?> -->
            <!--<?php echo htmlspecialchars("<?php echo \Registry::get_setting(\"".$m["type"].".".$m["name"]."\"); ?>"); ?>-->
            
          
            <?php if($tag=="text"){ ?>
            <div class="control-label col-md-3 col-sm-3 col-xs-12">
            <label class=""><?php echo $m['label']?></label>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <?php echo Form::input("setting_data[$_id]",$m["value"],array("class"=>"form-control col-md-7 col-xs-12","placeholder"=>$m["note"]))?><small><?php echo $m['note'];?></small>
            </div>
            <?php }elseif($tag=="label"){ ?>
          <div class="x_title"><h4><?php echo $m["value"]?></h4><div class="clearfix"></div></div>
          <?php }elseif($tag=="checkbox"){
          $_checked = $m["value"]==1 ? true : false;
          ?>
             <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $m['label']?>
            </label>
            <div class="">
                <?php echo Form::checkbox("setting_data[$_id]",1,$_checked,array("class"=>"js-switch"));?>
            </div>
            <?php }elseif($tag=="select"){ ?>
            <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $m['label']?>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
            <?php
              echo Form::select("setting_data[$_id]",$m['value'],$m["serialize"],array("class"=>"form-control"));
            ?>
            </div>
            <?php }elseif($tag=="textarea"){ ?>
            <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $m['label']?>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <?php echo Form::textarea("setting_data[$_id]", $m['value'], array('class' => 'form-control', 'rows' => 5, 'placeholder'=>$m["note"])); ?>
            </div>
            <?php }elseif($tag=="image" OR $tag=="file"){ ?>
            <div class="image-upload-item">
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">
            </label>

            <div class="form-group col-md-3 col-sm-3 col-xs-12">
              <?php if($tag=="image"){?>
              <img class="elfinder-image-input img-responsive" <?php if(!empty($m["value"])){?>src="<?php echo Uri::base();echo $m["value"];?>" <?php } ?> data-src="<?php echo Uri::base();?>"  />
              <?php } ?>
           </div>
           </div>

           <div class="control-label col-md-3 col-sm-3 col-xs-12">
            <label ><?php echo $m['label']?>
            </label>
            <small class="clearfix"><?php echo $m["note"];?></small>
           </div>
            <div class="form-group col-md-4 col-sm-4 col-xs-12 ">
              <div class="input-group">
                <?php echo Form::input("setting_data[$_id]", $m["value"], array('class' => 'col-md-4 form-control elfinder-input', 'placeholder'=>'...','readonly'=>true)); ?>
                <span class="input-group-btn">
                  <span class="elfinder_button btn btn-primary">Upload</span>

                  <span class="btn btn-danger btn-xs remove-image <?php if(empty($m["value"])){?> hidden <?php } ?>">Remove</span>
                </span>
                <script>
                  $('.remove-image').click(function(){
                    $(this).parents('.form-group').find('[name="setting_data[<?php echo $_id;?>]"]').val("");
                    $(this).parents('.form-group').find("img.elfinder-image-input").attr("src","");
                    $(this).addClass("hidden");
                  });
                </script>

              </div>
            </div>

           </div>
          <?php }elseif($tag=="select_function"){ ?>
            <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $m['label']?>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
            <?php
              echo Form::select("setting_data[$_id]",$m['value'],$m["serialize"],array("class"=>"form-control"));
            ?>
            </div>
          <?php }else{ ?>
            /* chưa có field */
          <?php } ?>
           
           <?php if($tag!="label"){ ?>
             <?php $code_php = htmlspecialchars("<?php echo \Registry::get_setting(\"".$m["type"].".".$m["name"]."\"); ?>");
             if($tag=="image" OR $tag=="file"){ 
              $code_php = htmlspecialchars("<?php echo Uri::create(\Registry::get_setting(\"".$m["type"].".".$m["name"]."\")); ?>");
             }
             ?>
             <code><a title="Click để lấy PHP code" href="javascript:void(0)" class="copy-setting" data-code="<?php echo $code_php; ?>"><i class="fa fa-code" aria-hidden="true"></i> Code</a></code>
             <?php } ?>
          </div>
          <?php } ?>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" class="btn btn-success">Save</button>
            </div>
          </div>

        <?php echo Form::close(); ?>
      </div>
    </div>
  </div>
</div>
