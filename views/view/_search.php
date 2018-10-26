<?php
/**
 * Support Feedback Views (support-feedback-view)
 * @var $this yii\web\View
 * @var $this app\modules\support\controllers\ViewController
 * @var $model app\modules\support\models\search\SupportFeedbackView
 * @var $form yii\widgets\ActiveForm
 *
 * @copyright Copyright (c) 2017 Ommu Platform (www.ommu.co)
 * @link https://github.com/ommu/mod-support
 * @author Arifin Avicena <avicenaarifin@gmail.com>
 * @created date 25 September 2017, 14:11 WIB
 * @contact (+62)857-2971-9487
 *
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="search-form">
	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>
		<?= $form->field($model, 'view_id') ?>

		<?= $form->field($model, 'publish') ?>

		<?= $form->field($model, 'feedback_id') ?>

		<?= $form->field($model, 'user_id') ?>

		<?= $form->field($model, 'views') ?>

		<?= $form->field($model, 'view_date') ?>

		<?= $form->field($model, 'view_ip') ?>

		<?= $form->field($model, 'modified_date') ?>

		<?= $form->field($model, 'modified_id') ?>

		<?= $form->field($model, 'updated_date') ?>

		<div class="form-group">
			<?php echo Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
			<?php echo Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
		</div>
	<?php ActiveForm::end(); ?>
</div>