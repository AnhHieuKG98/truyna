<?php echo $module="page";?>
<?php $obj_id =  "form_category_update".(isset($model) ? $model["id"] : '0');?>
<?php echo Form::open(array("class"=>"form-horizontal","enctype"=>"multipart/form-data")); ?>
  <div class="" role="tabpanel" data-example-id="togglable-tabs">
  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
    <li role="presentation" class="active"><a href="#tab_content1" id="general-tab" role="tab" data-toggle="tab" aria-expanded="true">General</a>
    </li>
    <?php if(!empty($list_email)){ ?>
    <li role="presentation" class=""><a href="#tab_content_email" role="tab" id="seo-tab" data-toggle="tab" aria-expanded="false"><?php echo l("form_tab.email list")?></a>
    </li>
    <?php } ?>
    <li role="presentation" class=""><a href="#tab_content2" role="tab" id="seo-tab" data-toggle="tab" aria-expanded="false">SEO</a>
    </li>
    
    <?php if($model["id"]==1){?>
    <li role="presentation" class=""><a href="#tab_content_data" role="tab" id="data-tab" data-toggle="tab" aria-expanded="false"><?php echo l("page.data_value")?></a>
    <?php } ?>
    
  </ul>
  <div id="myTabContent" class="tab-content">
    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="general-tab">
      <div class="col-md-8">
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
            <?php echo Form::label(l('Slug'), 'slug', array('class'=>'control-label')); ?>

              <?php echo Form::input('slug', Input::post('slug', isset($model) ? $model->slug : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Slug')); ?>

          </div>
          <div class="form-group">
            <?php echo Form::label(l('Summary'), 'summary', array('class'=>'control-label')); ?>

              <?php echo Form::textarea('summary', Input::post('summary', isset($model) ? $model->lang->summary : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Summary')); ?>

          </div>
          <div class="form-group">
            <?php echo Form::label(l('Body'), 'body', array('class'=>'control-label')); ?>

              <?php echo Form::textarea('body', Input::post('body', isset($model) ? $model->lang->body : ''), array('class' => 'col-md-8 form-control ckeditor', 'rows' => 8, 'placeholder'=>'Body')); ?>
          </div>
          
          <div class="form-group">
            <?php echo Form::label(l('Block'), 'block', array('class'=>'control-label')); ?>

              <?php echo Form::textarea('block', Input::post('block', isset($model) ? $model->lang->block : ''), array('class' => 'col-md-8 form-control ckeditor', 'rows' => 8, 'placeholder'=>'Block')); ?>
          </div>


          </fieldset>
        </div>
    </div>
    <?php if(!empty($list_email)){ ?>
    <div role="tabpanel" class="tab-pane fade" id="tab_content_email" aria-labelledby="email-tab">
      <div class="col-md-8">
        <?php $langs = fn_get_langs();
        foreach($langs as $lang_code){
          if($lang_code == \Lang::get_lang()){ 
            if(isset($list_email[$lang_code])){
            $emails = $list_email[$lang_code];
            $emails_rep = implode($emails,", ");
            $emails_line = implode($emails,"<br />");
            
          ?>
          <label class="control-label"><?php echo l("form_tab.email list")?></label>
          <textarea readonly rows="10" class="form-control"><?php echo $emails_rep;?></textarea>
          
          <label class="control-label"><?php echo l("form_tab.email list")?></label>
          <br />
          <?php echo $emails_line;?>
          <?php } 
          }
        }
        ?>
        
      </div>
    </div>
    <?php } ?>
    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="seo-tab">
      <?php echo render("common/form_tab_meta",array('model'=>isset($model) ? $model : NULL));?>
    </div>
    
    <?php if($model["id"]==1){?>
    <div role="tabpanel" class="tab-pane fade" id="tab_content_data" aria-labelledby="data-tab">
      <div class="col-md-8">
      
        
        
        
        <div class="form-group">

          <?php echo Form::label(l('page.data_1'), 'data_1', array('class'=>'control-label')); ?>
            <?php echo render("common/form_image_upload",array("object_id"=>isset($model) ? $model["id"] : 0,"file"=>array("label"=>"","name"=>$module."_p_V")))?>
            <?php echo Form::input('data_1', Input::post('data_1', isset($model) ? $model->lang->data_1 : ''), array('class' => 'form-control', 'placeholder'=>l('page.data_1'))); ?>
        </div>
        
        <div class="form-group">

          <?php echo Form::label(l('page.data_2'), 'data_2', array('class'=>'control-label')); ?>
          <?php echo render("common/form_image_upload",array("object_id"=>isset($model) ? $model["id"] : 0,"file"=>array("label"=>"","name"=>$module."_p_R")))?>
          <?php echo Form::textarea('data_2', Input::post('data_2', isset($model) ? $model->lang->data_2 : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>l("page.data_2"))); ?>
        </div>
        
        <div class="form-group">

          <?php echo Form::label(l('page.data_3'), 'data_3', array('class'=>'control-label')); ?>
          <?php echo render("common/form_image_upload",array("object_id"=>isset($model) ? $model["id"] : 0,"file"=>array("label"=>"","name"=>$module."_p_L")))?>
          <?php echo Form::textarea('data_3', Input::post('data_3', isset($model) ? $model->lang->data_3 : ''), array('class' => 'ckeditor col-md-8 form-control', 'rows' => 8, 'placeholder'=>l("page.data_3"))); ?>
        </div>
        
        
        <div class="form-group">
          <?php echo Form::label(l('page.data_4'), 'data_4', array('class'=>'control-label')); ?>
          <div class="x_content">
          
            <div class="col-xs-4">
              <!-- required for floating -->
              <!-- Nav tabs -->
              <ul class="nav nav-tabs tabs-left">
                <?php for($i=1;$i<=4;$i++){?>
                <li class="<?php if($i==1){?>active<?php } ?>"><a href="#data_index_<?php echo $i;?>" data-toggle="tab"><?php echo l("page.data_4_".$i)?></a>
                </li><?php } ?>
              </ul>
            </div>
            <div class="col-xs-8">
              <!-- Tab panes -->
              <div class="tab-content">
                <?php for($l=1;$l<=4;$l++){?>
                <div class="tab-pane <?php if($l==1){?>active<?php } ?>" id="data_index_<?php echo $l;?>">
                  <?php echo Form::input('data4['.$l.'][title]', Input::post('data4['.$l.'][title]', isset($model->lang->data_4_array[$l]) ? $model->lang->data_4_array[$l]["title"] : ''), array('class' => 'form-control', 'placeholder'=>'')); ?>
                  <?php echo Form::textarea('data4['.$l.'][text]', Input::post('data4['.$l.'][text]', isset($model->lang->data_4_array[$l]) ? $model->lang->data_4_array[$l]["text"] : ''), array('class' => 'no-col-md-8 form-control no-ckeditor', 'rows' => 8, 'placeholder'=>'')); ?>
                  <?php echo Form::input('data4['.$l.'][url]', Input::post('data4['.$l.'][url]', isset($model->lang->data_4_array[$l]) ? $model->lang->data_4_array[$l]["url"] : ''), array('class' => 'form-control', 'placeholder'=>l('url'))); ?>
                  <?php echo render("common/form_image_upload",array("object_id"=>isset($model) ? $model["id"] : 0,"file"=>array("label"=>"","name"=>$module."_d_".$l)))?>
                  
                </div>
                <?php } ?>
              </div>
            </div>
            
            
            
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    
  </div>
</div>

  <div class="col-md-4">
    <div class="col-md-12">
      <div class="row">
        <div class="form-group ">
          <?php echo Form::label('Status', 'status', array('class'=>'control-label')); ?>
          <div class="clearfix"></div>
          <?php echo Shtml::dropdown_status($obj_id,isset($model) ? $model : NULL);?>

        </div>
        <div class="form-group">

          <?php echo Form::label('Position', 'position', array('class'=>'control-label')); ?>

            <?php echo Form::input('position', Input::post('position', isset($model) ? $model->position : ''), array('class' => 'form-control', 'placeholder'=>'Position')); ?>
        </div>



      </div>
      <div class="row">
        <div class="form-group">
        <?php $module = "page";?>
        <?php echo render("common/form_image_upload",array("object_id"=>isset($model) ? $model["id"] : 0,"file"=>array("label"=>l("Image Banner"),"name"=>$module."_p_B")));#size lớn hơn?>
        </div>
        <div class="form-group">
            <?php echo Form::label(l('Caption'), 'caption', array('class'=>'control-label')); ?>
            <?php echo Form::input('caption', Input::post('caption', isset($model) ? $model->lang->caption : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Caption')); ?>
          </div>
      </div>

      <div class="row">
        <?php echo Form::label('Categories', 'categories', array('class'=>'control-label')); ?>
        <?php foreach($categories_tree as $cat){#id title frefix
        $_id = $cat['id'];
        $_checked = false;
        if(isset($category_data_selected)){
          if(in_array($_id,$category_data_selected))
           $_checked = true;
        }
        ?>
        <div class="checkbox">
          <label>
        <?php

          echo $cat['frefix'];
          echo Form::checkbox("category_data[$_id]",$_id, $_checked,array('class'=>'flat'));
          echo " " . $cat['title'];
          #echo Form::label($_name, "category[$_id]");
          #echo Form::checkbox('gender', 'Male', true);
        ?>
        </label>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <?php echo $form_buttons; ?>
<?php echo Form::close(); ?>
