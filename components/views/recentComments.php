<?php

use yii\helpers\Html;

?>
<h5><?= $title ?></h5>
<ul>
    <?php
    foreach ($recentComments as $comment): ?>
        <li>
            <?php echo $comment->authorLink; ?>
            on
            <?= Html::a(Html::encode($comment->post->title), $comment->getUrl()); ?>
        </li>
    <?php
    endforeach;
    ?>
</ul>
