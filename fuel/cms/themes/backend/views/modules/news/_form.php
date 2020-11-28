<?php $module = \Config::get('module.name');?>
<?php $obj_id =  "form_category_update".(isset($model) ? $model["id"] : '0');?>
<?php echo Form::open(array("class"=>"form-horizontal","enctype"=>"multipart/form-data")); ?>
  <div class="" role="tabpanel" data-example-id="togglable-tabs">
  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
    <li role="presentation" class="active"><a href="#tab_content1" id="general-tab" role="tab" data-toggle="tab" aria-expanded="true"><?php echo l("General")?></a>
    </li>
    <li role="presentation" class=""><a href="#tab_content2" role="tab" id="seo-tab" data-toggle="tab" aria-expanded="false"><?php echo l("SEO")?></a>
    </li>
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
            <?php echo Form::label(l('Summary 2'), 'summary2', array('class'=>'control-label')); ?>

              <?php echo Form::textarea('summary2', Input::post('summary2', isset($model) ? $model->lang->summary2 : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Summary 2')); ?>

          </div>
          <div class="form-group">
            <?php echo Form::label(l('Body'), 'body', array('class'=>'control-label')); ?>

              <?php echo Form::textarea('body', Input::post('body', isset($model) ? $model->lang->body : ''), array('class' => 'col-md-8 form-control ckeditor', 'rows' => 8, 'placeholder'=>'Body')); ?>

          </div>


          </fieldset>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="seo-tab">
      <?php echo render("common/form_tab_meta",array('model'=>isset($model) ? $model : NULL));?>
    </div>
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
        <?php echo render("common/form_image_upload",array("object_id"=>isset($model) ? $model["id"] : 0,"file"=>array("label"=>l("Image"),"name"=>$module."_p_A")))?>
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
