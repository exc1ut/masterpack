<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "postavshik_schet_faktura".
 *
 * @property int $id
 * @property int $schet_faktura_nomer
 * @property string $schet_faktura_date
 * @property int $dogovor_id
 * @property string $date
 * @property string $auto
 */
class PostavshikSchetFaktura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'postavshik_schet_faktura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['schet_faktura_nomer', 'schet_faktura_date', 'dogovor_id', 'date', 'auto'], 'required'],
            [['schet_faktura_nomer', 'dogovor_id'], 'integer'],
            [['schet_faktura_date', 'date'], 'safe'],
            [['auto'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'schet_faktura_nomer' => 'Schet Faktura Nomer',
            'schet_faktura_date' => 'Schet Faktura Date',
            'dogovor_id' => 'Dogovor ID',
            'date' => 'Date',
            'auto' => 'Auto',
        ];
    }
    public function getDogovor()
    {
        return $this->hasOne(Dogovor::className(), ['id' => 'dogovor_id']);
    }
    public function getSklad()
    {
        return $this->hasMany(SkladSirya::className(), ['postavshik_schet_faktura_id' => 'id']);
    }
    public function getRashod()
    {
        return $this->hasMany(Rashod::className(), ['postavshik_schet_faktura_id' => 'id']);
    }

}
