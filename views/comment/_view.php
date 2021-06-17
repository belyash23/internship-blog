<?php

use \yii\helpers\Html;
?>
<div class="comment" id="c<?php
echo $model->id; ?>">

    <?php
    echo Html::a(
        "#{$model->id}",
        $model->url,
        array(
            'class' => 'cid',
            'title' => 'Permalink to this comment',
        )
    ); ?>

    <div class="author">
        <?php
        echo $model->authorLink; ?> says on
        <?php
        echo Html::a(Html::encode($model->post->title), $model->post->url); ?>
    </div>

    <div class="time">
        <?php
        if ($model->status == \app\models\Comment::STATUS_PENDING): ?>
            <span class="pending">Pending approval</span> |
            <?php
            echo Html::a(
                'Approve',
                ['approve', 'id' => $model->id],
                ['class' => 'btn btn-primary']
            ); ?> |
        <?php
        endif; ?>
        <?php
        echo Html::a('Update', array('comment/update', 'id' => $model->id)); ?> |
        <?php
        echo Html::a('Delete', array('comment/delete', 'id' => $model->id), array('class' => 'delete', 'data-pjax' => 'w0', 'data-method'=>'post')); ?> |
        <?php
        echo date('F j, Y \a\t h:i a', $model->create_time); ?>
    </div>

    <div class="content">
        <?php
        echo nl2br(Html::encode($model->content)); ?>
    </div>

</div>