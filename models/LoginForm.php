<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user = false;
    private $allowedRoles;

    /**
     * @param array $allowedRoles roles which is allowed to authenticate via this form
     */
    public function __construct($allowedRoles = [])
    {
    	$this->allowedRoles = $allowedRoles;
    }


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // email and password are both required
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect email or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided email and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Authentication::findByEmail($this->email, $this->allowedRoles);

            $pid = Yii::$app->request->get('pid');

            // Deny authentication for all groups, except Client Admin if `pid` param is not empty
            if (!empty($pid) && $this->_user && $this->_user->role != 100) {
            	return null;
            }

            // Check `pid` for Client Admin user
            if ($this->_user && $this->_user->role == 100 &&
            	$this->_user->model->client->hash != $pid
    		) {
    			return null;
            }
        }

        return $this->_user;
    }
}
