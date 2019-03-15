<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sklad_sirya".
 *
 * @property int $id
 * @property string $postavshik_schet_faktura_id
 * @property string $kratkoe_naimenovanie
 * @property int $format
 * @property int $ves
 * @property string $date
 * @property int $is_come
 */
class SkladSirya extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sklad_sirya';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['postavshik_schet_faktura_id', 'kratkoe_naimenovanie', 'format', 'ves', 'date', 'is_come'], 'required','skipOnEmpty' => true],
            [['id', 'format', 'ves', 'is_come'], 'integer'],
            [['kratkoe_naimenovanie'], 'string'],
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
            'postavshik_schet_faktura_id' => 'Postavshik Schet Faktura ID',
            'kratkoe_naimenovanie' => 'Kratkoe Naimenovanie',
            'format' => 'Format',
            'ves' => 'Ves',
            'date' => 'Date',
            'is_come' => 'Is Come',
        ];
    }
    public function getSchetid()
    {
        return $this->hasOne(PostavshikSchetFaktura::className(), ['id' => 'postavshik_schet_faktura_id']);
    }
}
