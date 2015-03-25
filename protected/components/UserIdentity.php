<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    public $id;

	public function authenticate()
	{
        $users = User::model()->findByAttributes(array('email' => $this->username, 'del_flg' => Constant::DEL_FALSE));
        if ($users === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif (Common::decodePassword($users->password) !== ($this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->errorCode = self::ERROR_NONE;
            $this->setState('id', $users->id);
            $this->setState('username', $users->email);
        }

        return !$this->errorCode;
	}
}