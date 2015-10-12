<?php

namespace app\models\mysql\db;

use Yii;

/**
 * This is the model class for table "t_ticket_cinema_info".
 *
 * @property integer $id
 * @property string $name
 * @property string $corporation
 * @property string $cinemas
 * @property integer $code
 * @property string $fax
 * @property integer $country_code
 * @property integer $report_code
 * @property integer $zip_code
 * @property string $contact
 * @property string $telephone
 * @property string $province
 * @property string $city
 * @property string $county
 * @property string $address
 * @property integer $ctime
 * @property integer $utime
 * @property integer $screen_count
 * @property integer $status
 * @property integer $valid
 */
class CinemaInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_ticket_cinema_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'corporation', 'contact', 'telephone', 'province', 'city', 'county', 'address', 'ctime', 'utime', 'status'], 'required'],
            [['code', 'country_code', 'report_code', 'zip_code', 'ctime', 'utime', 'screen_count', 'status', 'valid'], 'integer'],
            [['name', 'corporation', 'address'], 'string', 'max' => 100],
            [['cinemas'], 'string', 'max' => 64],
            [['fax', 'telephone'], 'string', 'max' => 15],
            [['contact'], 'string', 'max' => 12],
            [['province', 'city', 'county'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ticket', 'ID'),
            'name' => Yii::t('ticket', '电影院名称'),
            'corporation' => Yii::t('ticket', '公司名称'),
            'cinemas' => Yii::t('ticket', 'Cinemas'),
            'code' => Yii::t('ticket', '电影院编码'),
            'fax' => Yii::t('ticket', '传真号码'),
            'country_code' => Yii::t('ticket', '全国影院编码'),
            'report_code' => Yii::t('ticket', '上报编码'),
            'zip_code' => Yii::t('ticket', '邮政编码'),
            'contact' => Yii::t('ticket', '联系人'),
            'telephone' => Yii::t('ticket', '联系电话'),
            'province' => Yii::t('ticket', '省'),
            'city' => Yii::t('ticket', '城市'),
            'county' => Yii::t('ticket', '县区'),
            'address' => Yii::t('ticket', '详细地址'),
            'ctime' => Yii::t('ticket', '创建时间'),
            'utime' => Yii::t('ticket', '更新时间'),
            'screen_count' => Yii::t('ticket', '影厅数量'),
            'status' => Yii::t('ticket', '当前营业状态(1:测试,2:正常营业)'),
            'valid' => Yii::t('ticket', '数据(0:有效,1:无效)'),
        ];
    }
}
