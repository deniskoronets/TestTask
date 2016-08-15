<?php

namespace app\models;

use app\contracts\AuthenticableModel;

class Authentication extends \yii\base\Object implements \yii\web\IdentityInterface
{
	const ROLE_GSM_ADMIN = 'admin';

	/**
	 * List if available models
	 */
	private static $models = [
		'User' => User::class,
		'AsUser' => AsUser::class,
	];

	/**
	 * Model id
	 * @var int
	 */
    public $id;

    /**
     * @var string
     */
    public $role;

    /**
     * @var string
     */
    public $authKey;

    /**
     * @var string
     */
    public $email;

    /**
     * @var AuthenticableModel
     */
    public $model;

    public function __construct(AuthenticableModel $model)
    {
    	$this->model = $model;
    	$this->role = $model->getRole();
    	$this->email = $model->getEmail();
    	$this->id = $model->getId();
    	$this->authKey = $model->getAuthKey();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
    	$exp = explode('/', $id);

    	$model = $exp[0];
    	$id = $exp[1];

    	if (!isset(self::$models[$model])) {
    		return null;
    	}

    	$roleModel = self::$models[$model];
    	$user = $roleModel::findOne($id);

    	if ($user) {
    		return new static($user);
    	}

        return null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    	// this functionality is not allowed
		return null;
    }

    /**
     * Finds user by email and allowed roles
     *
     * @param string $email
     * @param array $allowedRoles
     * @return static|null
     */
    public static function findByEmail($email, $allowedRoles = [])
    {
        foreach (self::$models as $model) {
    		$user = $model::findByEmail($email);

    		if ($user && (
    			empty($allowedRoles) ||
    			in_array($user->getRole(), $allowedRoles)
			)) {
    			return new static($user);
    		}
		}

    	return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
    	$modelName = basename(str_replace('\\', '/', get_class($this->model)));
        return  $modelName . '/' . $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->model->checkPassword($password);
    }
}
