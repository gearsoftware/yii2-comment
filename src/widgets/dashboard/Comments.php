<?php

/**
 * @package   Yii2-Comment
 * @author    José Peña <joepa37@gmail.com>
 * @link https://plus.google.com/+joepa37/
 * @copyright Copyright (c) 2018 José Peña
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @version   1.0.0
 */

namespace gearsoftware\comment\widgets\dashboard;

use gearsoftware\comment\models\search\CommentSearch;
use gearsoftware\comments\models\Comment;
use gearsoftware\models\User;
use gearsoftware\widgets\DashboardWidget;
use Yii;

class Comments extends DashboardWidget
{
    /**
     * Most recent comments limit
     */
    public $recentLimit = 5;

    /**
     * Comment index action
     */
    public $commentIndexAction = 'comment/default/index';

    /**
     * Total comments options
     *
     * @var array
     */
    public $options;

    public function run()
    {
        if (!$this->options) {
            $this->options = $this->getDefaultOptions();
        }

        if (User::hasPermission('viewComments')) {
            $searchModel = new CommentSearch();
            $formName = $searchModel->formName();

            $recentComments = Comment::find()->active()->orderBy(['id' => SORT_DESC])->limit($this->recentLimit)->all();

            foreach ($this->options as &$option) {
                $count = Comment::find()->filterWhere($option['filterWhere'])->count();
                $option['count'] = $count;
                $option['url'] = [$this->commentIndexAction, $formName => $option['filterWhere']];
            }

            return $this->render('comments', [
                'height' => $this->height,
                'width' => $this->width,
                'position' => $this->position,
                'comments' => $this->options,
                'recentComments' => $recentComments,
            ]);
        }
    }

    public function getDefaultOptions()
    {
        return [
            ['label' => Yii::t('core', 'Approved'), 'icon' => 'ok', 'filterWhere' => ['status' => Comment::STATUS_APPROVED]],
            ['label' => Yii::t('core', 'Pending'), 'icon' => 'search', 'filterWhere' => ['status' => Comment::STATUS_PENDING]],
            ['label' => Yii::t('core', 'Spam'), 'icon' => 'ban-circle', 'filterWhere' => ['status' => Comment::STATUS_SPAM]],
            ['label' => Yii::t('core', 'Trash'), 'icon' => 'trash', 'filterWhere' => ['status' => Comment::STATUS_TRASH]],
        ];
    }
}