<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="post">
        <div class="title">
            <?php echo Html::a(Html::encode($model->title), $model->url); ?>
        </div>
        <div class="author">
            posted by <?php echo $model->user->username . ' on ' . date('F j, Y',$model->create_time); ?>
        </div>
        <div class="content">
            <?php
                echo \yii\helpers\Markdown::process($model->content);
            ?>
        </div>
        <div class="nav">
            <b>Tags:</b>
            <?php echo implode(', ', $model->tagLinks); ?>
            <br/>
            <?php echo Html::a('Permalink', $model->url); ?> |
            <?php echo Html::a("Comments ({$model->commentCount})",$model->url.'#comments'); ?> |
            Last updated on <?php echo date('F j, Y',$model->update_time); ?>
        </div>
    </div>
    <div id="comments">
        <?php
        if ($model->commentCount >= 1): ?>
            <h3>
                <?php
                echo $model->commentCount . ' comment(s)'; ?>
            </h3>

            <?php
            echo $this->render(
                '_comments',
                array(
                    'post' => $model,
                    'comments' => $model->comments,
                )
            ); ?>
        <?php
        endif; ?>

        <h3>Оставить комментарий</h3>

        <?php
        if (Yii::$app->session->hasFlash('commentSubmitted')): ?>
            <div class="flash-success">
                <?php
                echo Yii::$app->session->getFlash('commentSubmitted'); ?>
            </div>
        <?php
        else: ?>
            <?php
            echo $this->context->renderPartial(
                '//comment/_form',
                array(
                    'model' => $comment,
                )
            ); ?>
        <?php
        endif; ?>
    </div>

</div>
