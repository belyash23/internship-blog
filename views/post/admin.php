<?php

$this->params['breadcrumbs'][] = 'Manage posts';
?>
    <h1>Manage Posts</h1>

<?php
\yii\widgets\Pjax::begin();

echo \yii\grid\GridView::widget(
    [
        'dataProvider' => $model->search($_GET),
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'title'
            ],
            [
                'attribute' => 'statusName.name',
                'label' => 'Status',
                'filter' => \app\models\Lookup::items('PostStatus')
            ],
            [
                'attribute' => 'create_time',
                'format' => 'datetime'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return \yii\helpers\Html::a(
                            '<span class="glyphicon glyphicon-trash"></span>',
                            $url,
                            [
                                'title' => Yii::t('yii', 'Delete'),
                                'data-pjax' => 'w0',
                                'data-method' => 'post'
                            ]
                        );
                    }
                ]
            ]
        ],
    ]
);
\yii\widgets\Pjax::end();
?>