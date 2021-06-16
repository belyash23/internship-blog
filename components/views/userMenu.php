<?php

use yii\helpers\Html;

?>
<ul>
    <li><?php
        echo Html::a('Создать новую запись', array('post/create')); ?></li>
    <li><?php
        echo Html::a('Управление записями', array('post/admin')); ?></li>
    <li><?php
        echo Html::a('Одобрение комментариев', array('comment/index'))
            . ' (' . \app\models\Comment::getPendingCommentCount() . ')'; ?></li>
    <li><?php
        echo Html::a('Выход', array('site/logout')); ?></li>
</ul>