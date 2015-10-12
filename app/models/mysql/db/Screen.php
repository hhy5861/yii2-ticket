<?php

namespace app\models\mysql\db;

use Yii;

/**
 * This is the model class for table "t_ticket_screen".
 *
 * @property integer $id
 * @property integer $cinema_id
 * @property string $screen_code
 * @property string $name
 * @property string $remark
 * @property integer $ctime
 * @property integer $utime
 * @property integer $valid
 */
class Screen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_ticket_screen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cinema_id', 'screen_code', 'name', 'ctime', 'utime', 'valid'], 'required'],
            [['cinema_id', 'ctime', 'utime', 'valid'], 'integer'],
            [['screen_code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 50],
            [['remark'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ticket', 'ID'),
            'cinema_id' => Yii::t('ticket', '影院id'),
            'screen_code' => Yii::t('ticket', '影厅编号'),
            'name' => Yii::t('ticket', '影厅名称'),
            'remark' => Yii::t('ticket', '影厅备注'),
            'ctime' => Yii::t('ticket', '创建时间'),
            'utime' => Yii::t('ticket', '更新时间'),
            'valid' => Yii::t('ticket', '数据(0:有效,1:无效)'),
        ];
    }
}
