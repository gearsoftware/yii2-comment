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
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model gearsoftware\comments\models\Comment */

$this->title = Yii::t('core', 'Update "{item}"', ['item' => Comments::t('comments', 'Comment')]);
$this->params['breadcrumbs'][] = ['label' => Comments::t('comments', 'Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('core', 'Update');
?>
<div class="comment-update">
    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>
    <?= $this->render('_form', compact('model')) ?>
</div>