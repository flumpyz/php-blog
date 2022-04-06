<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $nickname;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['nickname','email','password'], 'required'],
            [['nickname'], 'string'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass'=>'app\models\User', 'targetAttribute'=>'email']
        ];
    }

    public function signup()
    {
        if ($this->validate())
        {
            $user = new User();
            $user->attributes = $this->attributes;
            return $user->create();
        }
    }
}