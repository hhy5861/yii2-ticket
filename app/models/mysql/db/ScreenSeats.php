<?php

namespace app\models\mysql\db;

use Yii;

/**
 * This is the model class for table "t_ticket_hall_seats".
 *
 * @property integer $id
 * @property integer $hall_id
 * @property string $seats
 * @property string $color
 * @property string $area
 * @property string $code
 * @property string $row_num
 * @property string $column_num
 * @property integer $status
 * @property integer $ctime
 * @property integer $utime
 * @property integer $valid
 */
class ScreenSeats extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_ticket_screen_seats';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['screen_id', 'seats', 'color', 'area', 'code', 'row_num', 'column_num', 'status', 'ctime', 'utime', 'valid'], 'required'],
            [['screen_id', 'status', 'ctime', 'utime', 'valid'], 'integer'],
            [['seats'], 'string', 'max' => 5],
            [['color'], 'string', 'max' => 15],
            [['area'], 'string', 'max' => 30],
            [['code', 'row_num', 'column_num'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ticket', 'ID'),
            'screen_id' => Yii::t('ticket', '影厅id'),
            'seats' => Yii::t('ticket', '坐位号(排-号)'),
            'color' => Yii::t('ticket', '坐位颜色'),
            'area' => Yii::t('ticket', '坐位区域'),
            'code' => Yii::t('ticket', '座位编码'),
            'row_num' => Yii::t('ticket', '座位行号'),
            'column_num' => Yii::t('ticket', '座位列号'),
            'status' => Yii::t('ticket', '坐位状态'),
            'ctime' => Yii::t('ticket', '创建时间'),
            'utime' => Yii::t('ticket', '更新时间'),
            'valid' => Yii::t('ticket', '数据(0:有效,1:无效)'),
        ];
    }
}
