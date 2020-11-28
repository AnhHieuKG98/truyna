<div class="form-group">
  <label class='control-label'>&nbsp;</label>
  <?php echo Form::button('submit', 'Save', array('class' => 'btn btn-primary',"value"=>"save")); ?>
  <?php echo Form::button('submit', 'Save & Close', array('class' => 'btn btn-success',"value"=>"save_close")); ?>
  <?php echo Html::anchor($back_link, 'Back',array('class' => 'btn btn-dark')); ?>
</div>