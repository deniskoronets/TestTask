<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "as_clients".
 *
 * @property integer $id
 * @property integer $resellerId
 * @property string $name
 * @property string $hash
 * @property string $createdDate
 * @property string $modifiedDate
 * @property string $contactName
 * @property string $contactPhone
 * @property string $contactEmail
 * @property string $accountNumber
 * @property string $advantageProgramStatus
 * @property string $geography
 * @property string $branchNumber
 * @property string $branchName
 * @property string $territory
 * @property string $salesRepContactName
 * @property string $salesRepContactEmail
 * @property string $dateInvitationSent
 * @property integer $accountStatus
 * @property string $accountStatusDate
 * @property integer $clientSourceTypeId
 * @property integer $demo
 * @property integer $typeOfPractice
 * @property integer $parentId
 * @property string $billingCycle
 * @property string $typeOfBilling
 *
 * @property AsClients $parent
 * @property AsClients[] $asClients
 */
class AsClients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'as_clients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['resellerId', 'name', 'hash', 'createdDate', 'modifiedDate', 'contactName', 'contactPhone', 'contactEmail', 'accountNumber', 'advantageProgramStatus', 'geography', 'branchNumber', 'branchName', 'territory', 'salesRepContactName', 'salesRepContactEmail', 'accountStatusDate'], 'required'],
            [['resellerId', 'accountStatus', 'clientSourceTypeId', 'demo', 'typeOfPractice', 'parentId'], 'integer'],
            [['createdDate', 'modifiedDate', 'dateInvitationSent', 'accountStatusDate'], 'safe'],
            [['advantageProgramStatus', 'geography', 'billingCycle', 'typeOfBilling'], 'string'],
            [['name', 'contactName', 'contactEmail', 'branchName', 'territory'], 'string', 'max' => 255],
            [['hash', 'accountNumber', 'branchNumber'], 'string', 'max' => 50],
            [['contactPhone', 'salesRepContactName', 'salesRepContactEmail'], 'string', 'max' => 100],
            [['hash'], 'unique'],
            [['accountNumber'], 'unique'],
            [['parentId'], 'exist', 'skipOnError' => true, 'targetClass' => AsClients::className(), 'targetAttribute' => ['parentId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'resellerId' => 'Reseller ID',
            'name' => 'Name',
            'hash' => 'Hash',
            'createdDate' => 'Created Date',
            'modifiedDate' => 'Modified Date',
            'contactName' => 'Contact Name',
            'contactPhone' => 'Contact Phone',
            'contactEmail' => 'Contact Email',
            'accountNumber' => 'Account Number',
            'advantageProgramStatus' => 'Advantage Program Status',
            'geography' => 'Geography',
            'branchNumber' => 'Branch Number',
            'branchName' => 'Branch Name',
            'territory' => 'Territory',
            'salesRepContactName' => 'Sales Rep Contact Name',
            'salesRepContactEmail' => 'Sales Rep Contact Email',
            'dateInvitationSent' => 'Date Invitation Sent',
            'accountStatus' => 'Account Status',
            'accountStatusDate' => 'Account Status Date',
            'clientSourceTypeId' => 'Client Source Type ID',
            'demo' => 'Demo',
            'typeOfPractice' => 'Type Of Practice',
            'parentId' => 'Parent ID',
            'billingCycle' => 'Billing Cycle',
            'typeOfBilling' => 'Type Of Billing',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(AsClients::className(), ['id' => 'parentId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsClients()
    {
        return $this->hasMany(AsClients::className(), ['parentId' => 'id']);
    }
}
