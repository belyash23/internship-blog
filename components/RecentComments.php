<?php


namespace app\components;


use app\models\Comment;
use yii\base\Widget;

class RecentComments extends Widget
{
    public $title = 'Recent Comments';
    public $maxComments = 10;

    public function getRecentComments()
    {
        return Comment::findRecentComments($this->maxComments);
    }

    public function run()
    {
        return $this->render(
            'recentComments',
            [
                'recentComments' => $this->recentComments,
                'title' => $this->title,
            ]
        );
    }
}