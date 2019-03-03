<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_registration".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property int $inn
 * @property int $oked
 */
class ClientRegistration extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client_registration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address'], 'string'],
            [['name'], 'unique'],
            [['inn', 'oked'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'inn' => 'Inn',
            'oked' => 'Oked',
        ];
    }
    public function getDogovors()
    {
        return $this->hasMany(Dogovor::className(), ['postavshik' => 'id']);
    }
}
