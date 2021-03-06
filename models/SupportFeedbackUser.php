<?php
/**
 * SupportFeedbackUser
 * 
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 OMMU (www.ommu.id)
 * @created date 20 September 2017, 15:37 WIB
 * @modified date 27 January 2019, 10:56 WIB
 * @link https://github.com/ommu/mod-support
 *
 * This is the model class for table "ommu_support_feedback_user".
 *
 * The followings are the available columns in table "ommu_support_feedback_user":
 * @property integer $id
 * @property integer $publish
 * @property integer $feedback_id
 * @property integer $user_id
 * @property string $creation_date
 * @property string $updated_date
 *
 * The followings are the available model relations:
 * @property SupportFeedbacks $feedback
 * @property Users $user
 *
 */

namespace ommu\support\models;

use Yii;
use yii\helpers\Url;
use app\models\Users;

class SupportFeedbackUser extends \app\components\ActiveRecord
{
	use \ommu\traits\UtilityTrait;

	public $gridForbiddenColumn = ['updated_date', 'feedbackEmail', 'feedbackDisplayname', 'feedbackPhone'];

	public $feedbackSubject;
	public $feedbackEmail;
	public $feedbackDisplayname;
	public $feedbackPhone;
	public $feedbackMessage;
	public $userDisplayname;

	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'ommu_support_feedback_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return [
			[['feedback_id', 'user_id'], 'required'],
			[['publish', 'feedback_id', 'user_id'], 'integer'],
			[['feedback_id'], 'exist', 'skipOnError' => true, 'targetClass' => SupportFeedbacks::className(), 'targetAttribute' => ['feedback_id' => 'feedback_id']],
			[['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'user_id']],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'ID'),
			'publish' => Yii::t('app', 'Publish'),
			'feedback_id' => Yii::t('app', 'Feedback'),
			'user_id' => Yii::t('app', 'User'),
			'creation_date' => Yii::t('app', 'Creation Date'),
			'updated_date' => Yii::t('app', 'Updated Date'),
			'feedbackSubject' => Yii::t('app', 'Subject'),
			'feedbackEmail' => Yii::t('app', 'Email'),
			'feedbackDisplayname' => Yii::t('app', 'Name'),
			'feedbackPhone' => Yii::t('app', 'Phone'),
			'feedbackMessage' => Yii::t('app', 'Message'),
			'userDisplayname' => Yii::t('app', 'User'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getFeedback()
	{
		return $this->hasOne(SupportFeedbacks::className(), ['feedback_id' => 'feedback_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
	}

	/**
	 * {@inheritdoc}
	 * @return \ommu\support\models\query\SupportFeedbackUser the active query used by this AR class.
	 */
	public static function find()
	{
		return new \ommu\support\models\query\SupportFeedbackUser(get_called_class());
	}

	/**
	 * Set default columns to display
	 */
	public function init()
	{
        parent::init();

        if (!(Yii::$app instanceof \app\components\Application)) {
            return;
        }

        if (!$this->hasMethod('search')) {
            return;
        }

		$this->templateColumns['_no'] = [
			'header' => '#',
			'class' => 'app\components\grid\SerialColumn',
			'contentOptions' => ['class' => 'text-center'],
		];
		$this->templateColumns['feedbackDisplayname'] = [
			'attribute' => 'feedbackDisplayname',
			'value' => function($model, $key, $index, $column) {
				return isset($model->feedback) ? $model->feedback->displayname : '-';
				// return $model->feedbackDisplayname;
			},
			'visible' => !Yii::$app->request->get('feedback') ? true : false,
		];
		$this->templateColumns['feedbackEmail'] = [
			'attribute' => 'feedbackEmail',
			'value' => function($model, $key, $index, $column) {
				return isset($model->feedback) ? Yii::$app->formatter->asEmail($model->feedback->email) : '-';
				// return $model->feedbackEmail;
			},
			'visible' => !Yii::$app->request->get('feedback') ? true : false,
		];
		$this->templateColumns['feedbackPhone'] = [
			'attribute' => 'feedbackPhone',
			'value' => function($model, $key, $index, $column) {
				return isset($model->feedback) ? $model->feedback->phone : '-';
				// return $model->feedbackPhone;
			},
			'visible' => !Yii::$app->request->get('feedback') ? true : false,
		];
		$this->templateColumns['feedbackSubject'] = [
			'attribute' => 'feedbackSubject',
			'value' => function($model, $key, $index, $column) {
				return isset($model->feedback) ? $model->feedback->subject->title->message : '-';
				// return $model->feedbackSubject;
			},
			'visible' => !Yii::$app->request->get('feedback') ? true : false,
		];
		$this->templateColumns['feedbackMessage'] = [
			'attribute' => 'feedbackMessage',
			'value' => function($model, $key, $index, $column) {
				return isset($model->feedback) ? $model->feedback->message : '-';
				// return $model->feedbackMessage;
			},
			'visible' => !Yii::$app->request->get('feedback') ? true : false,
		];
		$this->templateColumns['userDisplayname'] = [
			'attribute' => 'userDisplayname',
			'value' => function($model, $key, $index, $column) {
				return isset($model->feedback) ? $model->user->displayname : '-';
				// return $model->userDisplayname;
			},
			'visible' => !Yii::$app->request->get('user') ? true : false,
		];
		$this->templateColumns['creation_date'] = [
			'attribute' => 'creation_date',
			'value' => function($model, $key, $index, $column) {
				return Yii::$app->formatter->asDatetime($model->creation_date, 'medium');
			},
			'filter' => $this->filterDatepicker($this, 'creation_date'),
		];
		$this->templateColumns['updated_date'] = [
			'attribute' => 'updated_date',
			'value' => function($model, $key, $index, $column) {
				return Yii::$app->formatter->asDatetime($model->updated_date, 'medium');
			},
			'filter' => $this->filterDatepicker($this, 'updated_date'),
		];
		$this->templateColumns['publish'] = [
			'attribute' => 'publish',
			'value' => function($model, $key, $index, $column) {
				$url = Url::to(['publish', 'id' => $model->primaryKey]);
				return $this->quickAction($url, $model->publish);
			},
			'filter' => $this->filterYesNo(),
			'contentOptions' => ['class' => 'text-center'],
			'format' => 'raw',
			'visible' => !Yii::$app->request->get('trash') ? true : false,
		];
	}

	/**
	 * User get information
	 */
	public static function getInfo($id, $column=null)
	{
        if ($column != null) {
            $model = self::find();
            if (is_array($column)) {
                $model->select($column);
            } else {
                $model->select([$column]);
            }
            $model = $model->where(['id' => $id])->one();
            return is_array($column) ? $model : $model->$column;

        } else {
            $model = self::findOne($id);
            return $model;
        }
	}

	/**
	 * after find attributes
	 */
	public function afterFind()
	{
		parent::afterFind();

		// $this->feedbackSubject = isset($this->feedback) ? $this->feedback->subject->title->message : '-';
		// $this->feedbackEmail = isset($this->feedback) ? $this->feedback->email : '-';
		// $this->feedbackDisplayname = isset($this->feedback) ? $this->feedback->displayname : '-';
		// $this->feedbackPhone = isset($this->feedback) ? $this->feedback->phone : '-';
		// $this->feedbackMessage = isset($this->feedback) ? $this->feedback->message : '-';
		// $this->userDisplayname = isset($this->user) ? $this->user->displayname : '-';
	}

	/**
	 * before validate attributes
	 */
	public function beforeValidate()
	{
        if (parent::beforeValidate()) {
            if ($this->isNewRecord) {
                if ($this->user_id == null) {
                    $this->user_id = !Yii::$app->user->isGuest ? Yii::$app->user->id : null;
                }
            }
        }
        return true;
	}
}
