<?php


namespace app\components;


use app\models\Tag;
use yii\base\Widget;
use yii\helpers\Html;

class TagCloud extends Widget
{
    public $title = 'Tags';
    public $maxTags = 20;

    public function run()
    {
        echo "<h5>$this->title</h5>";
        $tags = Tag::findTagWeights($this->maxTags);

        foreach ($tags as $tag => $weight) {
            $link = Html::a(Html::encode($tag), array('post/index', 'tag' => $tag));

            echo Html::tag('span', $link, ['style' => "font-size:{$weight}pt"]) . ' ';
        }
    }
}