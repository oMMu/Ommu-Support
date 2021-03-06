<?php
/**
 * Support Feedbacks (support-feedbacks)
 * @var $this app\components\View
 * @var $this ommu\support\controllers\feedback\AdminController
 * @var $model ommu\support\models\SupportFeedbacks
 * @var $form yii\widgets\ActiveForm
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 OMMU (www.ommu.id)
 * @created date 20 September 2017, 13:55 WIB
 * @modified date 27 January 2019, 09:55 WIB
 * @link https://github.com/ommu/mod-support
 *
 */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\widgets\ActiveForm;
use yii\widgets\DetailView;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dashboard'), 'url' => ['/admin/dashboard/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Feedback'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->displayname, 'url' => ['view', 'id' => $model->feedback_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Reply');

$this->params['menu']['content'] = [
	['label' => Yii::t('app', 'Back To Feedbacks'), 'url' => Url::to(['manage']), 'icon' => 'table'],
	['label' => Yii::t('app', 'Detail'), 'url' => Url::to(['view', 'id' => $model->feedback_id]), 'icon' => 'eye', 'htmlOptions' => ['class' => 'btn btn-info']],
];
?>

<div class="support-feedbacks-reply">

<?php
$attributes = [
	'displayname',
	'email:email',
	'phone',
	[
		'attribute' => 'subject_id',
		'value' => isset($model->subject) ? $model->subject->title->message : '-',
	],
	[
		'attribute' => 'message',
		'value' => $model->message ? $model->message : '-',
	],
	[
		'attribute' => 'creation_date',
		'value' => Yii::$app->formatter->asDatetime($model->creation_date, 'medium'),
		'visible' => !$small,
	],
];

echo DetailView::widget([
	'model' => $model,
	'options' => [
		'class' => 'table table-striped detail-view',
	],
	'template' => '<tr><th{captionOptions} class="active">{label}</th><td{contentOptions}>{value}</td></tr>',
	'attributes' => $attributes,
]); ?>

<?php $form = ActiveForm::begin([
	'options' => ['class' => 'form-horizontal form-label-left'],
	'enableClientValidation' => false,
	'enableAjaxValidation' => false,
	//'enableClientScript' => true,
	'fieldConfig' => [
		'errorOptions' => [
			'encode' => false,
		],
	],
]); ?>

<?php //echo $form->errorSummary($model);?>

<?php echo $form->field($model, 'reply_message')
	->textarea(['rows' => 6, 'cols' => 50])
	->label($model->getAttributeLabel('reply_message')); ?>

<hr/>

<?php echo $form->field($model, 'submitButton')
	->submitButton(['button' => Html::submitButton(Yii::t('app', 'Reply this Message'), ['class' => 'btn btn-primary'])]); ?>

<?php ActiveForm::end(); ?>

</div>