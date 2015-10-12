<?php

namespace app\models\mysql\db;

use Yii;

/**
 * This is the model class for table "t_ticket_cinema_film_row".
 *
 * @property integer $id
 * @property integer $business_time
 * @property integer $cinema_id
 * @property string $film_id
 * @property integer $session_code
 * @property integer $session_time
 * @property integer $seat_by_number
 * @property string $rent
 * @property string $norn_price
 * @property string $lowest_price
 * @property string $cinema_price
 * @property integer $ctime
 * @property integer $utime
 * @property integer $valid
 */
class CinemaFilmRow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_ticket_cinema_film_row';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'business_time', 'cinema_id', 'film_id', 'session_code', 'session_time', 'seat_by_number', 'rent', 'norn_price', 'lowest_price', 'ctime', 'utime', 'valid'], 'required'],
            [['id', 'business_time', 'cinema_id', 'session_code', 'session_time', 'seat_by_number', 'ctime', 'utime', 'valid'], 'integer'],
            [['rent', 'norn_price', 'lowest_price', 'cinema_price'], 'number'],
            [['film_id'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ticket', 'ID'),
            'business_time' => Yii::t('ticket', '营业日期'),
            'cinema_id' => Yii::t('ticket', '影厅编码'),
            'film_id' => Yii::t('ticket', '影片编码'),
            'session_code' => Yii::t('ticket', '场次编码'),
            'session_time' => Yii::t('ticket', '放映时间'),
            'seat_by_number' => Yii::t('ticket', '对号入座标识,取值包括'),
            'rent' => Yii::t('ticket', '租金'),
            'norn_price' => Yii::t('ticket', '标准定价'),
            'lowest_price' => Yii::t('ticket', '最低票价'),
            'cinema_price' => Yii::t('ticket', 'Cinema Price'),
            'ctime' => Yii::t('ticket', '创建时间'),
            'utime' => Yii::t('ticket', '更新时间'),
            'valid' => Yii::t('ticket', '数据(0:有效,1:无效)'),
        ];
    }
}
