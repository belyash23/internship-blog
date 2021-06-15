<?php

use \yii\helpers\Html;

?>
<div class="post">
    <div class="title">
        <?php
        echo Html::a(Html::encode($model->title), $model->url); ?>
    </div>
    <div class="author">
        posted by <?php
        echo $model->user->username . ' on ' . date('F j, Y', $model->create_time); ?>
    </div>
    <div class="content">
        <?php
        $content = \yii\helpers\Markdown::process($model->content);
        echo $content;
        ?>
    </div>
    <b>Tags:</b>
    <?php
    echo implode(', ', $model->tagLinks); ?>
    <br/>
    <?php
    echo Html::a('Permalink', $model->url); ?> |
    <?php
    echo Html::a("Comments ({$model->commentCount})", $model->url . '#comments'); ?> |
    Last updated on <?php
    echo date('F j, Y', $model->update_time); ?>
</div>