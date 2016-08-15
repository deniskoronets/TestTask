<?php

namespace app\components;

class AccessControl extends \yii\filters\AccessControl
{
    /**
     * @inheritdoc
     */
    public $ruleConfig = ['class' => AccessRule::class];
}