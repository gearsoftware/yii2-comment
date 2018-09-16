<?php

/**
 * @package   Yii2-Comment
 * @author    José Peña <joepa37@gmail.com>
 * @link https://plus.google.com/+joepa37/
 * @copyright Copyright (c) 2018 José Peña
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @version   1.0.0
 */

namespace gearsoftware\comment\models\search;

use gearsoftware\comments\models\Comment;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CommentSearch represents the model behind the search form about `gearsoftware\comments\models\Comment`.
 */
class CommentSearch extends Comment
{
    public $created_at_operand;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'model_id', 'user_id', 'parent_id', 'status', 'updated_at'], 'integer'],
            [['model', 'username', 'email', 'content', 'user_ip', 'created_at', 'created_at_operand'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Comment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => Yii::$app->request->cookies->getValue('_grid_page_size', 20),
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['status' => ($this->status !== NULL) ? $this->status : 1]);

        $query->andFilterWhere([
            'id' => $this->id,
            'model_id' => $this->model_id,
            'user_id' => $this->user_id,
            'parent_id' => $this->parent_id,
            //'status' => $this->status,
            'updated_at' => $this->updated_at,
        ]);

	    if ($this->created_at) {
		    $tmp = explode(' - ', $this->created_at);
		    if (isset($tmp[0], $tmp[1])) {
			    $query->andFilterWhere(['between', static::tableName() . '.created_at',
				    strtotime($tmp[0]), strtotime($tmp[1])]);
		    }
	    }

        $query->andFilterWhere(['like', 'model', $this->model])
            //->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'user_ip', $this->user_ip]);

        return $dataProvider;
    }
}