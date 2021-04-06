<?php

namespace app\modules\i18n\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\i18n\models\records\i18nLanguage\I18nLanguage;

/**
 * I18nLanguageSearch represents the model behind the search form of `app\modules\i18n\models\records\i18nLanguage\I18nLanguage`.
 */
class I18nLanguageSearch extends I18nLanguage
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['identifier', 'name'], 'safe'],
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
        $query = I18nLanguage::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'identifier', $this->identifier])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
