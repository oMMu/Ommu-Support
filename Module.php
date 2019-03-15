<?php
/**
 * support module definition class
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 OMMU (www.ommu.co)
 * @created date 15 September 2017, 15:05 WIB
 * @link https://github.com/ommu/mod-support
 *
 */

namespace ommu\support;

use Yii;

class Module extends \app\components\Module
{
	public $layout = 'main';

	/**
	 * {@inheritdoc}
	 */
	public $controllerNamespace = 'ommu\support\controllers';

	/**
	 * {@inheritdoc}
	 */
	public function init()
	{
		parent::init();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getLayoutPath()
	{
		if(Yii::$app->view->theme)
			return Yii::$app->view->theme->basePath . DIRECTORY_SEPARATOR . 'layouts';
		else
			return parent::getLayoutPath();
	}
}
