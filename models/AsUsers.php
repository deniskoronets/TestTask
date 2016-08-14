<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "as_users".
 *
 * @property integer $id
 * @property integer $clientId
 * @property string $email
 * @property string $pwd
 * @property string $salt
 * @property string $invitationDate
 * @property integer $active
 * @property integer $accountAdmin
 * @property string $name
 * @property integer $acceptedToU
 * @property integer $user_type_id
 *
 * @property AsUserTypes $userType
 */
class AsUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'as_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clientId', 'email', 'pwd', 'salt', 'name'], 'required'],
            [['clientId', 'active', 'accountAdmin', 'acceptedToU', 'user_type_id'], 'integer'],
            [['invitationDate'], 'safe'],
            [['email'], 'string', 'max' => 100],
            [['pwd'], 'string', 'max' => 64],
            [['salt'], 'string', 'max' => 32],
            [['name'], 'string', 'max' => 255],
            [['clientId', 'email'], 'unique', 'targetAttribute' => ['clientId', 'email'], 'message' => 'The combination of Client ID and Email has already been taken.'],
            [['user_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AsUserTypes::className(), 'targetAttribute' => ['user_type_id' => 'user_type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clientId' => 'Client ID',
            'email' => 'Email',
            'pwd' => 'Pwd',
            'salt' => 'Salt',
            'invitationDate' => 'Invitation Date',
            'active' => 'Active',
            'accountAdmin' => 'Account Admin',
            'name' => 'Name',
            'acceptedToU' => 'Accepted To U',
            'user_type_id' => 'User Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserType()
    {
        return $this->hasOne(AsUserTypes::className(), ['user_type_id' => 'user_type_id']);
    }
}
