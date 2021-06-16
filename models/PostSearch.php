<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Post;

/**
 * PostSearch represents the model behind the search form of `app\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return array_merge(parent::attributes(), ['statusName.name']);
    }

    public function rules()
    {
        return [
            [['id', 'status', 'user_id'], 'integer'],
            [['title', 'content', 'tags', 'update_time', 'statusName.name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );

        $query->joinWith(
            [
                'statusName' => function ($query) {
                    $query->from(['statusName' => '{{%lookup}}']);
                }
            ]
        );

        $dataProvider->sort->attributes['statusName.name'] = [
            'asc' => ['statusName.name' => SORT_ASC],
            'desc' => ['statusName.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(
            [
                'id' => $this->id,
                'title' => $this->title,
                'status' => $this->status,
                'create_time' => $this->create_time,
                'update_time' => $this->update_time,
                'user_id' => $this->user_id,
            ]
        );
//        var_dump($this->getAttribute('statusName.name'));die;
        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'statusName.code', $this->getAttribute('statusName.name')]);

        return $dataProvider;
    }
}
