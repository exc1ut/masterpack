<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rashod".
 *
 * @property string $id
 * @property int $postavshik_schet_faktura_id
 * @property string $kratkoe_naimenovanie
 * @property int $format
 * @property int $ves
 * @property string $date
 * @property int $is_come
 * @property string $time
 */
class Rashod extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rashod';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['postavshik_schet_faktura_id', 'kratkoe_naimenovanie', 'format', 'ves', 'date', 'is_come', 'time'], 'required'],
            [['postavshik_schet_faktura_id', 'format', 'ves', 'is_come'], 'integer'],
            [['date'], 'safe'],
            [['kratkoe_naimenovanie', 'time'], 'string', 'max' => 255],
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
            'time' => 'Time',
        ];
    }
    public function getSchetid()
    {
        return $this->hasOne(PostavshikSchetFaktura::className(), ['id' => 'postavshik_schet_faktura_id']);
    }

}
