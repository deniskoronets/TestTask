<?php

namespace app\models;

use Yii;
use app\contracts\AuthenticableModel;

/**
 * This is the model class for table "users".
 *
 * @property integer $user_id
 * @property integer $client_id
 * @property integer $user_type_id
 * @property string $user_email
 * @property string $user_password
 * @property string $user_first_name
 * @property string $user_last_name
 * @property string $user_phone
 * @property integer $user_status_flag
 * @property integer $user_screen_lock_flag
 */
class User extends \yii\db\ActiveRecord implements AuthenticableModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id', 'user_type_id', 'user_status_flag', 'user_screen_lock_flag'], 'integer'],
            [['user_email', 'user_first_name', 'user_last_name', 'user_phone'], 'string', 'max' => 80],
            [['user_password'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'client_id' => 'Client ID',
            'user_type_id' => 'User Type ID',
            'user_email' => 'User Email',
            'user_password' => 'User Password',
            'user_first_name' => 'User First Name',
            'user_last_name' => 'User Last Name',
            'user_phone' => 'User Phone',
            'user_status_flag' => 'User Status Flag',
            'user_screen_lock_flag' => 'User Screen Lock Flag',
        ];
    }

    /**
     * Find user by email
     * @param string $email
     */
    public static function findByEmail($email)
    {
    	return self::find()->where([
    		'user_email' => $email,
    		'user_type_id' => 6
		])->one();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
    	return $this->user_id . $this->user_email;
    }

    /**
     * @inheritdoc
     */
    public function getRole()
    {
    	return Authentication::ROLE_GSM_ADMIN;
    }

    /**
     * @inheritdoc
     */
    public function getEmail()
    {
    	return $this->user_email;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
    	return $this->user_id;
    }

    /**
     * @inheritdoc
     */
    public function checkPassword($password)
    {
    	// return $this->user_password === hash('sha256', $password);
    	return $this->user_password === $password;
    }
}
