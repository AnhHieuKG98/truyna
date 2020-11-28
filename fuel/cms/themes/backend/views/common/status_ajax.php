<?php #Ajax cho đổi trạng thái tại table ?>
<?php $_a = array(
  "A" => l("Active"),
  "H" => l("Hidden"),
);?>
<div class="btn-group btn-group-status" id="<?php echo $obj_id; ?>">
  <?php echo Form::hidden("status",Input::post('status', !empty($selected) ? $selected : 'A'))?>
  <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="true"><span class="app-text"><?php echo !empty($selected) ? $_a[$selected] : 'Active';?></span> <span class="caret"></span>
  </button>
  <ul role="menu" class="dropdown-menu">
    <li><a href="javascript:void(0)" data-ajax-status data-value="A" data-id="<?php echo $id?>" data-table="<?php echo $table;?>">Active</a>
    </li>
    <li><a href="javascript:void(0)" data-ajax-status data-value="H" data-id="<?php echo $id?>"  data-table="<?php echo $table;?>">Hidden</a>
    </li>
  </ul>
</div>
<script>
  var obj_select_<?php echo $obj_id?> = $('.btn-group-status#<?php echo $obj_id?>');
  obj_select_<?php echo $obj_id?>.find('.dropdown-menu a').click(function(){
    var _value = $(this).data("value");
    var _text = $(this).text();
    obj_select_<?php echo $obj_id?>.find('[name="status"]').val(_value);
    obj_select_<?php echo $obj_id?>.find('.app-text').text(_text)
  });
</script>