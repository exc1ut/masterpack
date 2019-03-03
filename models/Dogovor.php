<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dogovor".
 *
 * @property int $id
 * @property string $postavshik
 * @property string $date
 * @property string $dogovor_nomer
 *
 * @property DogovorTable[] $dogovorTables
 */
class Dogovor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dogovor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['postavshik', 'date'], 'required'],
            [['postavshik'], 'string'],
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
            'postavshik' => 'Postavshik',
            'date' => 'Date',
            'dogovor_nomer' => 'Dogovor Nomer',
            'date_now' => 'Date_Now'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(ClientRegistration::className(), ['id' => 'postavshik']);
    }
    public function getTip()
    {
        return $this->hasMany(PostavshikSchetFaktura::className(), ['dogovor_id' => 'id']);
    }
    public function getDogovors()
    {
        return $this->hasMany(DogovorTable::className(), ['postavshik_id' => 'id']);
    }
}
