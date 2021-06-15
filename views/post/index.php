<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">
    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    $tag = Yii::$app->request->get('tag');
    if (!empty($tag)) {
        echo "<h1>Posts Tagged with <i>" . HTML::encode($tag) . "</i></h1>";
    }

    echo ListView::widget(
        [
            'dataProvider' => $dataProvider,
            'itemView' => '_post',
        ]
    );
    ?>


</div>
