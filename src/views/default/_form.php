<?php

/**
 * @package   Yii2-Comment
 * @author    José Peña <joepa37@gmail.com>
 * @link https://plus.google.com/+joepa37/
 * @copyright Copyright (c) 2018 José Peña
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @version   1.0.0
 */

use gearsoftware\comments\models\Comment;
use gearsoftware\helpers\Html;
use gearsoftware\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model gearsoftware\comments\models\Comment */
/* @var $form gearsoftware\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php
    $form = ActiveForm::begin([
        'id' => 'comment-form',
        'validateOnBlur' => false,
    ])
    ?>

    <div class="row">
        <div class="col-md-9">

            <div class="panel panel-default">
                <div class="panel-body">

                    <?= $form->field($model, 'status')->dropDownList(Comment::getStatusList()) ?>

                    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

                </div>

            </div>
        </div>

        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="record-info">

                        <div class="form-group clearfix">
                            <label class="control-label" style="float: left; padding-right: 5px;">
                                <?= $model->attributeLabels()['username'] ?> :
                            </label>
                            <span><?= $model->author->fullname ?></span>
                        </div>

                        <div class="form-group clearfix">
                            <label class="control-label" style="float: left; padding-right: 5px;">
                                <?= $model->attributeLabels()['email'] ?> :
                            </label>
                            <span><?= ($model->email) ? $model->email : Yii::t('yii', '(not set)') ?></span>
                        </div>

                        <div class="form-group clearfix">
                            <label class="control-label" style="float: left; padding-right: 5px;">
                                <?= $model->attributeLabels()['model'] ?> :
                            </label>
                            <span><?= "$model->model->{$model->model_id}" ?></span>
                        </div>

                        <div class="form-group clearfix">
                            <label class="control-label" style="float: left; padding-right: 5px;">
                                <?= $model->attributeLabels()['parent_id'] ?> :
                            </label>
                            <span><?= $model->parent_id ?></span>
                        </div>

                        <div class="form-group clearfix">
                            <label class="control-label" style="float: left; padding-right: 5px;">
                                <?= $model->attributeLabels()['created_at'] ?> :
                            </label>
                            <span><?= $model->createdDate . ' ' . $model->createdTime ?></span>
                        </div>

                        <div class="form-group clearfix">
                            <label class="control-label" style="float: left; padding-right: 5px;">
                                <?= $model->attributeLabels()['updated_at'] ?> :
                            </label>
                            <span><?= $model->updatedDate . ' ' . $model->updatedTime ?></span>
                        </div>

                        <div class="form-group clearfix">
                            <label class="control-label" style="float: left; padding-right: 5px;">
                                <?= $model->attributeLabels()['user_ip'] ?> :
                            </label>
                            <span><?= $model->user_ip ?></span>
                        </div>

                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('core', 'Save'), ['class' => 'btn btn-primary']) ?>

                            <?=
                            Html::a(Yii::t('core', 'Delete'), ['/comment/default/delete', 'id' => $model->id], [
                                'class' => 'btn btn-default',
                                'data' => [
                                    'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                            ])
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
