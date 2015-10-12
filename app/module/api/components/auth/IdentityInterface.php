<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/18/15
 * Time: 16:29
 */

namespace api\components\auth;


interface IdentityInterface
{
	public static function checkAccessToken($token);
}