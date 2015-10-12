<?php

namespace app\models\mysql\db;

use Yii;

/**
 * This is the model class for table "t_ticket_film_init".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $version
 * @property integer $duration
 * @property integer $publish_date
 * @property string $publisher
 * @property string $producer
 * @property string $director
 * @property string $cast
 * @property string $introduction
 * @property string $trailer
 * @property string $poster_img
 * @property integer $ctime
 * @property integer $utime
 * @property integer $valid
 */
class FilmInit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_ticket_film_init';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'version', 'duration', 'publish_date', 'publisher', 'producer', 'director', 'cast', 'ctime', 'utime', 'valid'], 'required'],
            [['duration', 'publish_date', 'ctime', 'utime', 'valid'], 'integer'],
            [['code'], 'string', 'max' => 13],
            [['name', 'publisher'], 'string', 'max' => 64],
            [['version'], 'string', 'max' => 11],
            [['producer', 'director'], 'string', 'max' => 32],
            [['cast', 'trailer'], 'string', 'max' => 200],
            [['introduction', 'poster_img'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ticket', 'ID'),
            'code' => Yii::t('ticket', '影片编码'),
            'name' => Yii::t('ticket', '影片名称'),
            'version' => Yii::t('ticket', '发行版本'),
            'duration' => Yii::t('ticket', '影片时长,以分钟为单位'),
            'publish_date' => Yii::t('ticket', '公映日期'),
            'publisher' => Yii::t('ticket', '发行商'),
            'producer' => Yii::t('ticket', '制作人'),
            'director' => Yii::t('ticket', '导演'),
            'cast' => Yii::t('ticket', '演员'),
            'introduction' => Yii::t('ticket', '简介'),
            'trailer' => Yii::t('ticket', '预告片地址'),
            'poster_img' => Yii::t('ticket', '海报地址'),
            'ctime' => Yii::t('ticket', '创建时间'),
            'utime' => Yii::t('ticket', '更新时间'),
            'valid' => Yii::t('ticket', '数据(0:有效,1:无效)'),
        ];
    }
}
