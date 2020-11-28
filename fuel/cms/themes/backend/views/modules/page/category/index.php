<div class="page-title">
  <div class="title_left">
    <h3>Quản lý Chuyên mục</h3>
  </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
  <form method="POST" action="">
  <div class="x_panel">
  <div class="x_title">
    <h2>Categories</h2>
    <?php echo render("common/table_toolboxs",array('add_link'=>'admin/page/category/create','model'=>$model));?>
  </div>
  <div class="table-responsive">
    <table class="table table-striped jambo_table bulk_action">
      <thead>
        <tr class="headings">
          <th>
            <input type="checkbox" id="check-all" class="flat">
          </th>
          <th class="column-title">Title </th>
          <th class="column-title">Status </th>
          <th class="column-title" width="50">Position </th>
          <th class="column-title">Thumb </th>
          <th class="column-title no-link last"><span class="nobr">Action</span>
          </th>
          <th class="bulk-actions" colspan="5">
            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
          </th>
        </tr>
      </thead>

      <tbody>
        <?php foreach($model as $m){
          $obj_id =  "form_category_update".(isset($m) ? $m['id'] : '0');
        ?>
        <tr id="status_update_<?php echo $m['id']?>" class="even pointer tm-status-<?php echo strtolower($m['status']);?>">
          <td class="a-center ">
            <input type="checkbox" class="flat" name="table_records[]" value="<?php echo $m['id']?>">
          </td>
          <td class=" "><?php echo $m['frefix'].$m['title']?></td>
          <td class=" ">
            <?php echo Shtml::dropdown_status_ajax($obj_id,$m['status'],"page_categories",$m['id']);?>
          </td>
          <td><input type="text" class="form-control" name="position[<?php echo $m['id'];?>]" value="<?php echo $m['position'];?>" /></td>
          <td><img src="<?php echo $m["image"]?>" class="img-responsive" width="90" /></td>
          <td class=" last">
            <?php echo Html::anchor("admin/page/category/edit/".$m['id'],"<i class=\"fa fa-pencil\"></i> Edit",array("class"=>'actions-icon btn btn-info btn-xs'));?>
            <a href="" class="actions-icon btn btn-danger btn-xs" data-toggle="modal" data-target=".delete-modal-sm" data-href="<?php echo Uri::create("admin/page/category/delete/".$m['id'])?>"><i class="fa fa-trash-o"></i> Delete</a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  </div>
  </form>
</div>  


