<?php

/**
 * @package   Yii2-Comment
 * @author    José Peña <joepa37@gmail.com>
 * @link https://plus.google.com/+joepa37/
 * @copyright Copyright (c) 2018 José Peña
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @version   1.0.0
 */

use gearsoftware\comments\Comments;
use gearsoftware\comments\models\Comment;
use gearsoftware\grid\GridPageSize;
use gearsoftware\grid\GridQuickLinks;
use gearsoftware\grid\GridView;
use gearsoftware\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel gearsoftware\comment\models\search\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Comments::t('comments', 'Comments');
$this->params['breadcrumbs'][] = $this->title;

echo GridView::widget([
	'id' => 'comment-grid',
	'model' =>  Comment::className(),
	'title' => $this->title,
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'quickLinksOptions' => [
		['label' => Yii::t('core', 'All'), 'filterWhere' => []],
		['label' => Yii::t('core', 'Approved'), 'filterWhere' => ['status' => Comment::STATUS_APPROVED]],
		['label' => Yii::t('core', 'Pending'), 'filterWhere' => ['status' => Comment::STATUS_PENDING]],
		['label' => Yii::t('core', 'Spam'), 'filterWhere' => ['status' => Comment::STATUS_SPAM]],
		['label' => Yii::t('core', 'Trash'), 'filterWhere' => ['status' => Comment::STATUS_TRASH]],
	],
	'bulkActionOptions' => [
		'actions' => [
			Url::to(['bulk-activate']) => Comments::t('comments', 'Approve'),
			Url::to(['bulk-deactivate']) => Comments::t('comments', 'Mark as Pending'),
			Url::to(['bulk-spam']) => Comments::t('comments', 'Mark as Spam'),
			Url::to(['bulk-trash']) => Comments::t('comments', 'Move to Trash'),
			Url::to(['bulk-delete']) => Yii::t('core', 'Permanent Delete'),
		]
	],
	'columns' => [
		[
			'class'=>'gearsoftware\grid\columns\SerialColumn'
		],
		[
			'attribute' => 'content',
			'vAlign'=>'middle',
			'width'=>'180px',
			'value'=>function ($model, $key, $index, $widget) {
				return Html::a(mb_substr($model->content, 0, 32) . '...',
					['/comment/default/update', 'id' => $model->id], ['data-pjax' => 0]);
			},
			'format'=>'raw'
		],
		[
			'attribute' => 'user_id',
			'label' => Yii::t('core', 'Username'),
			'vAlign'=>'middle',
			'width'=>'180px',
			'value' => function (Comment $model) {
				return $model->author->username;
			},
			'filterType' => GridView::FILTER_SELECT2,
			'filter'=>ArrayHelper::map(User::find()->orderBy('username')->asArray()->all(), 'id', 'username'),
			'filterWidgetOptions'=>[
				'pluginOptions'=>['allowClear' => true],
			],
			'filterInputOptions' => [
				'placeholder' => Yii::t('core', 'Select an {element}...',
					['element' => Yii::t('core/user', 'User')])
			],
			'format'=>'raw'
		],
		[
			'class' => 'gearsoftware\grid\columns\StatusColumn',
			'attribute' => 'status',
			'optionsArray' => Comment::getStatusOptionsList(),
			'vAlign'=>'middle',
			'width'=>'180px',
			'filterType' => GridView::FILTER_SELECT2,
			'filter' => Comment::getStatusOptionsList(),
			'filterWidgetOptions'=>[
				'pluginOptions'=>['allowClear' => true],
			],
			'filterInputOptions' => [
				'placeholder' => Yii::t('core', 'Select a {element}...',
					['element' => Comments::t('comments', 'Status')])
			],
			'format'=>'raw'
		],
		[
			'attribute' => 'created_at',
			'value' => function ($model) {
				return $model->createdDateTime;
			},
			'filterType' => 'gearsoftware\grid\DateRangePicker',
			'format'=>'raw',
			'width'=>'250px',
		],
		[
			'class' => 'gearsoftware\grid\columns\ActionColumn',
			'template' => '{update}{delete}',
			'dropdown' => true,
		],
		[
			'class' => 'gearsoftware\grid\columns\CheckboxColumn',
		],
	]
]);


