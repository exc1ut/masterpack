<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ostatok".
 *
 * @property int $id
 * @property int $postavshik_schet_faktura_id
 * @property string $kratkoe_naimenovanie
 * @property int $format
 * @property int $ves
 * @property string $date
 * @property int $is_come
 * @property string $time
 */
class Ostatok extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ostatok';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['postavshik_schet_faktura_id', 'format', 'ves', 'date', 'is_come', 'time'], 'required','skipOnEmpty' => true],
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
}
