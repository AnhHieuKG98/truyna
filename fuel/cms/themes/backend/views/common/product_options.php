	<?php if ($options):   ?>

    <table border="0" class="table table-bordered table-striped no-m table-list" cellspacing="0">
      <thead>
      <tr>
        <th width="20"><?php #echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all')) ?></th>
        <th><?php echo l("Option name")?></th>
        <th><?php echo l("Status")?></th>
        <th width="120"></th>
      </tr>
      </thead>
      <tbody>
        <?php foreach ($options as $option):
          $obj_id =  "form_shop_product_options_update".(isset($option) ? $option['id'] : '0');
          ?>
        <tr id="status_update_<?php echo $option['id']?>" class="even pointer tm-status-<?php echo strtolower($option['status']);?>">
          <td><?php #echo form_checkbox('action_to[]', $option['option_id']) ?></td>
          <td>
              <?php echo $option["option_name"];?>
            <?php #echo anchor('admin/products/edit_option/'.$product_id.'/'.$option['option_id'], $option['option_name'], '  class="open-popup1" data-post="'.site_url('admin/k2/products/edit_option/'.$product_id.'/'.$option['option_id']).'"') ?>
          </td>
          <td class="td-status">
            <?php echo Shtml::dropdown_status_ajax($obj_id,$option['status'],"shop_products_options",$option['id']);?>
            <?php #echo $this->load->view('backend/common/status',array('active'=>$option['status'],'id'=>$option['option_id'],'url'=>'admin/product_options/update_status/'.$option['option_id']),true)?>
            <?php
            #####echo $this->load->view('backend/common/dropdown_status',array('name'=>'','selected'=>$option['status'],'href'=>site_url('admin/product_options/update_status/'.$option['option_id']),'title'=>$statuses[$option['status']]['title'],'ajax'=>true)) ?>
          </td>

          <td class="align-center buttons buttons-small-bk">
            <?php echo Html::anchor("admin/shop/product/option/edit/".$option['id'].'/'.$product_id,"<i class=\"fa fa-pencil\"></i> Edit",array("class"=>'actions-icon btn btn-info btn-xs'))?>
            <a href="" class="actions-icon btn btn-danger btn-xs" data-toggle="modal" data-target=".delete-modal-sm" data-href="<?php echo Uri::create("admin/shop/product/option/delete/".$option['id'])?>"><i class="fa fa-trash-o"></i> Delete</a>

            <div id="fat-menu" class="dropdown hidden">
              <a href="#" class="dropdown-toggle-choose" data-toggle="dropdown" role="button" aria-expanded="true"><i class="fa fa-wrench"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li role="presentation">
                  <a>Edit</a>
                  <a>Delete</a>
                  <?php  #echo anchor('admin/product_options/edit_option/'.$product_id.'/'.$option['option_id'], '{_edit}', 'data-post="'.site_url('admin/product_options/edit_option/'.$product_id.'/'.$option['option_id']).'" class=" edit open-popup"') ?></li>
                <li role="presentation"><?php #echo anchor('admin/product_options/delete_option/'.$option['option_id'], '{_delete}', 'class="k2-delete-ajax confirm delete"') ;?></li>
              </ul>
            </div>
          </td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>


	<?php else: ?>
		<div class="no_data">
			<?php echo l("No options");?>
		</div>
	<?php endif; ?>
	<?php #$this->load->view('backend/common/buttons', array('tag' => 'a','title'=>'<i class="dialog-open icon-plus"></i>'.'{_add_option}','class'=>'ajax-add-option  btn btn-primary','href'=>site_url('admin/product_options/create_option/'.$product_id))) ?>
	<a class="btn btn-primary" href="<?php  echo Uri::create('admin/shop/product/inventory/product/'.$product_id)?>"><?php echo l("Option combinations");?></a>

