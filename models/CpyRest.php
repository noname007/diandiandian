<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cpy_rest".
 *
 * @property integer $cpy_id
 * @property integer $rest_id
 */
class CpyRest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cpy_rest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cpy_id', 'rest_id'], 'required'],
            [['cpy_id', 'rest_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cpy_id' => 'Cpy ID',
            'rest_id' => 'Rest ID',
        ];
    }
}
