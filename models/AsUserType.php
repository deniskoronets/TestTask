<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "as_user_types".
 *
 * @property integer $user_type_id
 * @property string $user_type
 *
 * @property AsUsers[] $asUsers
 */
class AsUserType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'as_user_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_type_id' => 'User Type ID',
            'user_type' => 'User Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsUsers()
    {
        return $this->hasMany(AsUsers::className(), ['user_type_id' => 'user_type_id']);
    }
}
