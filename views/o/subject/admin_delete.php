<?php
/**
 * Support Feedback Subjects (support-feedback-subject)
 * @var $this SubjectController
 * @var $model SupportFeedbackSubject
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2018 Ommu Platform (www.ommu.co)
 * @created date 15 March 2018, 14:05 WIB
 * @modified date 27 September 2018, 15:18 WIB
 * @link https://github.com/ommu/mod-support
 *
 */

	$this->breadcrumbs=array(
		Yii::t('phrase', 'Support')=>array('o/feedback/manage'),
		Yii::t('phrase', 'Feedback Subject')=>array('manage'),
		$model->title->message=>array('view','id'=>$model->subject_id),
		Yii::t('phrase', 'Delete'),
	);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'support-feedback-subject-form',
	'enableAjaxValidation'=>true,
)); ?>

	<div class="dialog-content">
		<?php echo Yii::t('phrase', 'Are you sure you want to delete this item?');?>
	</div>
	<div class="dialog-submit">
		<?php echo CHtml::submitButton(Yii::t('phrase', 'Delete'), array('onclick' => 'setEnableSave()')); ?>
		<?php echo CHtml::button(Yii::t('phrase', 'Cancel'), array('id'=>'closed')); ?>
	</div>
	
<?php $this->endWidget(); ?>
