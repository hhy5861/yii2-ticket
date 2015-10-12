<?php
/**
 * Created by PhpStorm.
 * User: renlikang
 * Date: 15/7/3
 * Time: 下午2:40
 */

namespace cinema\business\cinema;

use Yii;
use app\models\mysql\db\Users;
use yii\base\Model;

class MLogin extends Model
{
	private $_user = false;
	private $_message = [
		100 => ['status' => 100, 'message' => '用户名或者密码错误'],
		101 => ['status' => 101, 'message' => '登陆失败'],
		200 => ['status' => 200, 'message' => '登陆成功'],

	];
	public  $username;
	public  $password;

	public function rules()
	{
		return [
			[['username', 'password'], 'required'],
			['password', 'validatePassword'],
		];
	}
	public function login($user)
	{
		$this->username = $user['username'];
		$this->password = $user['password'];
		if($this->validate()) {
			if(Yii::$app->user->login($this->getUser(), 0)) {
				return $this->_message[200];
			} else {
				return $this->_message[101];
			}
		} else {
			return $this->_message[100];
		}
	}

	public function getUser()
	{
		if ($this->_user === false) {
			$this->_user = Users::findByUsername($this->username);
		}

		return $this->_user;
	}

	public function getPassword($password)
	{
		return Yii::$app->security->generatePasswordHash($password);
	}

	public function validatePassword($attribute, $params = 0)
	{
		if (!$this->hasErrors()) {
			$user = $this->getUser();
			if (!$user || !$user->validatePassword($this->password)) {
				$this->addError($attribute, 'Incorrect username or password.');
			}
		}
	}
}