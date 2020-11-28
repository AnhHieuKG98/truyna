<h2>Editing </h2>
<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
    <div class="form-group">
      <?php echo Form::label(l('Password old'), 'password_old', array('class'=>'control-label')); ?>
        <?php echo Form::password('password_old', Input::post('password_old', isset($model) ? $model->password_old: ''), array('class' => 'col-md-4 form-control', 'placeholder'=>l('Password old'))); ?>
    </div>
    <div class="form-group">
      <?php echo Form::label(l('Password new'), 'password_new', array('class'=>'control-label')); ?>
        <?php echo Form::password('password_new', Input::post('password_new', isset($model) ? $model->password_new: ''), array('class' => 'col-md-4 form-control', 'placeholder'=>l('Password new'))); ?>
    </div>
    <div class="form-group">
      <?php echo Form::label(l('Password strong'), 'password_strong', array('class'=>'control-label')); ?>
        <h4 style="color:#f00"><?php echo $random;?></h4>
    </div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>
