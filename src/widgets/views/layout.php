<?php

/**
 * @package   Yii2-Comment
 * @author    José Peña <joepa37@gmail.com>
 * @link https://plus.google.com/+joepa37/
 * @copyright Copyright (c) 2018 José Peña
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @version   1.0.0
 */

/* @var $this yii\web\View */
?>

<div class="panel panel-default recent-comments">
    <div class="panel-heading"><?= Yii::t('core', 'Recent Comments') ?></div>
    <div class="panel-body">
        <?php if (count($recentComments)): ?>
            <?php foreach ($recentComments as $comment) : ?>
                <?= $this->render($commentTemplate, ['comment' => $comment]) ?>
            <?php endforeach; ?>
        <?php else: ?>
            <h4><em><?= Yii::t('core', 'No comments found.') ?></em></h4>
        <?php endif; ?>
    </div>
</div>
