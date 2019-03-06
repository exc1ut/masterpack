<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dogovor_table".
 *
 * @property int $id
 * @property string $tovar
 * @property string $kratkoe_naimenovanie
 * @property string $measure
 * @property int $cost1
 * @property int $nds
 * @property int $cost2
 * @property int $usd1
 * @property int $usd2
 * @property int $postavshik_id
 * @property string $dogovor_date
 * @property string $date
 *
 * @property Dogovor $postavshik
 */
class DogovorTable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dogovor_table';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tovar', 'kratkoe_naimenovanie', 'measure', 'postavshik_id'], 'required'],
            [['tovar', 'kratkoe_naimenovanie', 'measure'], 'string'],
            [['postavshik_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dogovor::className(), 'targetAttribute' => ['postavshik_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tovar' => 'Tovar',
            'kratkoe_naimenovanie' => 'Kratkoe Naimenovanie',
            'measure' => 'Measure',
            'cost1' => 'Cost1',
            'nds' => 'Nds',
            'cost2' => 'Cost2',
            'usd1' => 'Usd1',
            'usd2' => 'Usd2',
            'postavshik_id' => 'Postavshik ID',
            'dogovor_date' => 'Dogovor Date',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDogovor()
    {
        return $this->hasOne(Dogovor::className(), ['id' => 'postavshik_id']);
    }
}
