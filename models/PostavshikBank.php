<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "postavshik_bank".
 *
 * @property int $id
 * @property string $bank_name
 * @property int $bank_mfo
 * @property int $schet
 * @property string $date
 * @property int $postavshik_id
 */
class PostavshikBank extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'postavshik_bank';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bank_name', 'bank_mfo', 'schet', 'date'], 'required'],
            [['bank_name'], 'string'],
            [['bank_mfo', 'schet', 'postavshik_id'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bank_name' => 'Bank Name',
            'bank_mfo' => 'Bank Mfo',
            'schet' => 'Schet',
            'date' => 'Date',
            'postavshik_id' => 'Postavshik ID',
        ];
    }
}
