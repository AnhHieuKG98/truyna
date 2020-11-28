<ul class="nav navbar-right panel_toolbox">
  <li><a class="collapse-link" href="<?php echo Uri::create($add_link)?>"><i class="fa fa-plus"></i></a>
  </li>
  <?php if(!empty($model) AND empty($no_bulk)):?>
  <li class="dropdown close-bk">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"><i class="fa fa-wrench"></i></a>
    <ul class="dropdown-menu" role="menu">
      <li><button value="1" name="update_form"><?php echo l("Update Form")?></button>
      </li>
      <?php if(empty($no_delete_bulk)):?>
      <li><button value="1" name="delete_selected"><?php echo l("Delete selected")?></button>
      </li><?php endif;?>
    </ul>
  </li>
  <?php endif;?>
</ul>
<div class="clearfix"></div>
