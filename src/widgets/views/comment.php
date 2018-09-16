<?php

/**
 * @package   Yii2-Comment
 * @author    José Peña <joepa37@gmail.com>
 * @link https://plus.google.com/+joepa37/
 * @copyright Copyright (c) 2018 José Peña
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @version   1.0.0
 */

use gearsoftware\comments\assets\CommentsAsset;
use gearsoftware\comments\Comments;
use yii\helpers\Html;

/* @var $this yii\web\View */

$commentsAsset = CommentsAsset::register($this);
Comments::getInstance()->commentsAssetUrl = $commentsAsset->baseUrl;
?>

<div class="clearfix recent-comment">
    <div class="author text-center pull-left">
        <img class="avatar" src="<?= Comments::getInstance()->renderUserAvatar($comment->user_id) ?>"/>
        <div class="text-primary">
            <?= Html::encode($comment->getAuthor()); ?>
        </div>
    </div>
    <div>
        <div class="time text-right">
            <?= "{$comment->createdDate} {$comment->createdTime}" ?>
        </div>
        <div class="content text-justify">
            <?= $comment->shortContent ?>
            <?= Html::a(Yii::t('core', 'Read more...'), $comment->url) ?>
        </div>
    </div>
</div>
