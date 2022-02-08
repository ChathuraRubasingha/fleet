<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pizza-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'pizza_name'); ?>
		<!-- hii -->
		<?php echo $form->textField($model,'pizza_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'pizza_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pizza_type_id'); ?>
		<?php echo $form->textField($model,'pizza_type_id'); ?>
		<?php echo $form->error($model,'pizza_type_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<!-- aaa -->
<!-- bbbbb -->