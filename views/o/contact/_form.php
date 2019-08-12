<?php
/**
 * Support Contacts (support-contacts)
 * @var $this ContactController
 * @var $model SupportContacts
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2012 Ommu Platform (www.ommu.co)
 * @modified date 21 September 2018, 07:46 WIB
 * @link https://github.com/ommu/mod-support
 *
 */
?>

<?php $form=$this->beginWidget('application.libraries.yii-traits.system.OActiveForm', array(
	'id'=>'support-contacts-form',
	'enableAjaxValidation'=>true,
	/*
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data',
		'on_post' => '',
	),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	*/
)); ?>

<div class="dialog-content">
	<fieldset>

		<?php //begin.Messages ?>
		<div id="ajax-message">
			<?php echo $form->errorSummary($model); ?>
		</div>
		<?php //begin.Messages ?>

		<?php if($model->isNewRecord) {?>
		<div class="form-group row">
			<?php echo $form->labelEx($model, 'cat_id', array('class'=>'col-form-label col-lg-4 col-md-4 col-sm-12')); ?>
			<div class="col-lg-8 col-md-8 col-sm-12">
				<?php $category = SupportContactCategory::getCategory(1, 'contact');
				if($category != null)
					echo $form->dropDownList($model, 'cat_id', $category, array('prompt'=>'', 'class'=>'form-control'));
				else
					echo $form->dropDownList($model, 'cat_id', array('prompt'=>''), array('class'=>'form-control')); ?>
				<?php echo $form->error($model,'cat_id'); ?>
			</div>
		</div>
		<?php }?>

		<div class="form-group row">
			<?php if($model->isNewRecord) {
				echo $form->labelEx($model, 'contact_name', array('class'=>'col-form-label col-lg-4 col-md-4 col-sm-12'));
			} else { ?>
				<label class="col-form-label col-lg-4 col-md-4 col-sm-12"><?php echo $model->category->title->message;?> <span class="required">*</span></label>
			<?php }?>
			<div class="col-lg-8 col-md-8 col-sm-12">
				<?php echo $form->textArea($model, 'contact_name', array('rows'=>6, 'cols'=>50, 'class'=>'form-control smaller')); ?>
				<?php echo $form->error($model, 'contact_name'); ?>
			</div>
		</div>
		
		<div class="form-group row publish">
			<?php echo $form->labelEx($model, 'publish', array('class'=>'col-form-label col-lg-4 col-md-4 col-sm-12')); ?>
			<div class="col-lg-8 col-md-8 col-sm-12">
				<?php echo $form->checkBox($model, 'publish', array('class'=>'form-control')); ?>
				<?php echo $form->labelEx($model, 'publish'); ?>
				<?php echo $form->error($model, 'publish'); ?>
			</div>
		</div>

	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('phrase', 'Create') : Yii::t('phrase', 'Save'), array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Yii::t('phrase', 'Cancel'), array('id'=>'closed')); ?>
</div>
<?php $this->endWidget(); ?>