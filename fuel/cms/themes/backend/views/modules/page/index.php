<!--<h2>Listing page Admin</h2>-->
<?php #print_r($model);?>

<div class="page-title">
  <div class="title_left">
    <h3>Quản lý Page</h3>
  </div>
  <div class="title_right">
    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
      <form action="<?php echo Uri::create("admin/page");?>">
      <div class="input-group">
        
        <input type="text" name="s" value="<?php echo Input::get("s");?>" class="form-control" placeholder="Keyword">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">Go!</button>
        </span>
        
      </div>
      </form>
    </div>
  </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="table-filter"> 
    <form class="form-horizontal form-label-left" action="<?php echo Uri::create("admin/page");?>">
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Tên</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" name="s" value="<?php echo Input::get("s");?>" class="form-control" placeholder="title,summary">
          </div>
        </div>
        
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Danh mục</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <?php 
            $categories_select = Helper::k2_array_for_select($categories_tree,'id','title','frefix');
            echo Form::select("cid",Input::get("cid"),array(""=>"--All--")+$categories_select,array('class'=>'form-control'));?>
          </div>
        </div>
      </div>
      
      <div class="col-md-3">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
          <div class="col-md-8 col-sm-8 col-xs-12">
            <?php echo Helper::dropdown_status(Input::get("status"));?>
          </div>
        </div>
      </div>
      
      
      <div class="col-md-1">
        <button type="submit" class="btn btn-primary">Filter</button>
      </div>
      
      
    </div>
    </form>
    <div class="clearfix"></div>
  </div>
  
  <form method="POST" action="">
  <div class="x_panel">
  <div class="x_title">
    <h2>Page Posts</h2>
    <?php echo render("common/table_toolboxs",array('add_link'=>'admin/page/create','model'=>$model));?>
  </div>
  
  
  
  <div class="table-responsive">
    
    <table class="table table-striped jambo_table bulk_action">
      <thead>
        <tr class="headings">
          <th>
            <input type="checkbox" id="check-all" class="flat">
          </th>
          <th class="column-title">Title </th>
          <th class="column-title">Create Date </th>
          <th class="column-title">Status</th>
          <th class="column-title" width="50">Position </th>

          <th class="column-title no-link last"><span class="nobr">Action</span>
          </th>
          <th class="bulk-actions" colspan="6">
            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
          </th>
        </tr>
      </thead>

      <tbody>
        <?php foreach($model as $m){
          #print_r($m);
          $obj_id =  "form_page_post_update".(isset($m) ? $m['id'] : '0');
          ?>
        <tr id="status_update_<?php echo $m->id;?>" class="even pointer tm-status-<?php echo strtolower($m['status']);?>">
          <td class="a-center ">
            <?php if($m["core"]!="Y"){?><input type="checkbox" class="flat" name="table_records[]" value="<?php echo $m['id']?>"><?php } ?>
          </td>
          <td class=" "><?php echo Html::anchor("admin/page/edit/".$m['id'],$m["lang"]["title"]);?></td>
          <td class=" "><?php echo date("d/m/Y H:i",$m['created_at']);?></td>
          <td class=" ">
            <?php echo Shtml::dropdown_status_ajax($obj_id,$m['status'],"page_posts",$m['id']);?>
          </td>
          <td><input type="text" class="form-control" name="position[<?php echo $m['id'];?>]" value="<?php echo $m['position'];?>" /></td>

          <td class=" last">
            <?php echo Html::anchor("admin/page/edit/".$m['id'],"<i class=\"fa fa-pencil\"></i> Edit",array("class"=>'actions-icon btn btn-info btn-xs'))?>
            <?php if($m["core"]!="Y"){?>
            <a href="" class="actions-icon btn btn-danger btn-xs" data-toggle="modal" data-target=".delete-modal-sm" data-href="<?php echo Uri::create("admin/page/delete/".$m['id'])?>"><i class="fa fa-trash-o"></i> Delete</a><?php } ?>
            <?php #echo Html::anchor("admin/page/clone/".$m['id'],"<i class=\"fa fa-copy\"></i> Clone",array("class"=>'actions-icon btn btn-warning btn-xs'))?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="row">
      <div class="col-sm-5"></div>
      <div class="col-sm-7"><div class="dataTables_paginate"><?php echo $pagination;?></div></div>
    </div>
  </div>


  </div>
  </form>
</div>  
<?php #echo $pagination->render();
#https://fuelphp.com/docs/classes/pagination.html

?>

