<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    Pjax::begin();
    echo \yii\widgets\ListView::widget(
        [
            'dataProvider' => $dataProvider,
            'itemView' => '_view'
        ]
    );
    Pjax::end();
    ?>


</div>
