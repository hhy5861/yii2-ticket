<?php

namespace app\models\mysql\auth;

use Yii;

/**
 * This is the model class for table "t_auth_account".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $appid
 * @property string $secretid
 * @property string $avatar
 * @property string $company
 * @property integer $valid
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%account}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('auth');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'appid', 'secretid'], 'required'],
            [['uid', 'valid'], 'integer'],
            [['appid'], 'string', 'max' => 16],
            [['secretid'], 'string', 'max' => 32],
            [['avatar'], 'string', 'max' => 200],
            [['company'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'uid' => Yii::t('app', '用户id'),
            'appid' => Yii::t('app', '平台应用app id'),
            'secretid' => Yii::t('app', '平台应用secret id'),
            'avatar' => Yii::t('app', '头像及logo'),
            'company' => Yii::t('app', '公司名'),
            'valid' => Yii::t('app', '用户id'),
        ];
    }
}
