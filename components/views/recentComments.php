<?php

use yii\helpers\Html;

?>
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
