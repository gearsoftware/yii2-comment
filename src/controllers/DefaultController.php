<?php

/**
 * @package   Yii2-Comment
 * @author    José Peña <joepa37@gmail.com>
 * @link https://plus.google.com/+joepa37/
 * @copyright Copyright (c) 2018 José Peña
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @version   1.0.0
 */

namespace gearsoftware\comment\controllers;

use gearsoftware\comments\models\Comment;
use gearsoftware\controllers\BaseController;
use Yii;

/**
 * CommentController implements the CRUD actions for Post model.
 */
class DefaultController extends BaseController
{
    public $modelClass = 'gearsoftware\comments\models\Comment';
    public $modelSearchClass = 'gearsoftware\comment\models\search\CommentSearch';
    public $disabledActions = ['create', 'view'];

    protected function getRedirectPage($action, $model = null)
    {
        switch ($action) {
            case 'update':
                return ['update', 'id' => $model->id];
                break;
            default:
                return parent::getRedirectPage($action, $model);
        }
    }

    /**
     * Mark as spam all selected grid items
     */
    public function actionBulkSpam()
    {
        if (Yii::$app->request->post('selection')) {
            $modelClass = $this->modelClass;

            $modelClass::updateAll(
                ['status' => Comment::STATUS_SPAM],
                ['id' => Yii::$app->request->post('selection', [])]
            );
        }
    }

    /**
     * Move to trash all selected grid items
     */
    public function actionBulkTrash()
    {
        if (Yii::$app->request->post('selection')) {
            $modelClass = $this->modelClass;

            $modelClass::updateAll(
                ['status' => Comment::STATUS_TRASH],
                ['id' => Yii::$app->request->post('selection', [])]
            );
        }
    }
}