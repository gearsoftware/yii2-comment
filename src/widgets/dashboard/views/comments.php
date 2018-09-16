<?php

/**
 * @package   Yii2-Comment
 * @author    José Peña <joepa37@gmail.com>
 * @link https://plus.google.com/+joepa37/
 * @copyright Copyright (c) 2018 José Peña
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @version   1.0.0
 */

use gearsoftware\assets\core\CoreAsset;
use gearsoftware\comments\assets\CommentsAsset;
use gearsoftware\comments\Comments;
use gearsoftware\widgets\TimeAgo;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;

/* @var $this yii\web\View */

$commentsAsset = CommentsAsset::register($this);
Comments::getInstance()->commentsAssetUrl = $commentsAsset->baseUrl;
CoreAsset::register($this);
?>

<div class="panel">
    <div class="panel-heading">
        <div class="panel-control hidden-xs-down">
            <ul class="pager pager-rounded">
                <?php foreach ($comments as $comment) : ?>
                    <li><a href="<?=  Url::to($comment['url']); ?>"><?= $comment['label'] . ' ('. $comment['count'] . ')'; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <h3 class="panel-title"><?= Yii::t('core', 'Comments Activity'); ?></h3>
    </div>
    <div class="panel-body">
        <?php if (count($recentComments)): ?>
            <div class="media-body">
                <?php foreach ($recentComments as $comment) : ?>
                    <div class="media">
                        <a class="media-left" href="<?= Url::to(['/user/default/update', 'id' => $comment->author->id]) ?>"><img class="img-circle img-sm" alt="Profile Picture" src="<?= $comment->author->getAvatar('large'); ?>"></a>
                        <div class="media-body <?= (end($recentComments) !== $comment) ? 'bord-btm' : '' ?>">
                            <div>
                                <a href="<?= Url::to(['/user/default/update', 'id' => $comment->user_id]) ?>" class="btn-link text-semibold media-heading box-inline"><?= Html::encode($comment->author->fullname); ?></a>
                                <small class="text-muted pad-lft">
                                    <i class="ti-time icon-lg"> </i>
                                    <?php if(date('Ymd') == date('Ymd', $comment->created_at)) : ?>
                                        <?= TimeAgo::widget(['timestamp' => $comment->created_at]); ?>
                                    <?php else : ?>
                                        <?= $comment->createdDateTime; ?>
                                    <?php endif; ?>
                                </small>
                            </div>
                            <?= HtmlPurifier::process(mb_substr(Html::encode($comment->content), 0, 64, "UTF-8")); ?>
                            <?= (strlen($comment->content) > 64) ? '...' : '' ?>
                            <a  href="<?= Url::to($comment->url) ?>"  class="btn btn-trans"><?= Yii::t('core', 'Read more'); ?></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <em><?= Yii::t('core', 'No comments found.') ?></em>
        <?php endif; ?>
    </div>
</div>