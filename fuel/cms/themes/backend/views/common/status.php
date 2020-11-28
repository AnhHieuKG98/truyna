<?php $_a = array(
  "A" => "Active",
  "H" => "Hidden",
);
?>
<div class="btn-group btn-group-status" id="<?php echo $obj_id; ?>">
  <?php echo Form::hidden("status",Input::post('status', isset($model) ? $model->status : 'A'))?>
  <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="true"><span class="app-text"><?php echo isset($model) ? $_a[$model->status] : 'Active';?></span> <span class="caret"></span>
  </button>
  <ul role="menu" class="dropdown-menu">
    <li><a href="javascript:void(0)" data-value="A">Active</a>
    </li>
    <li><a href="javascript:void(0)" data-value="H">Hidden</a>
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