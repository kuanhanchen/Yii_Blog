<?php
namespace frontend\models;

use yii\base\Model;
use common\models\UserModel;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $rePassword;
    public $verifyCode;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\UserModel', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\UserModel', 'message' => 'This email address has already been taken.'],


            [['password', 'rePassword'], 'required'],
            [['password', 'rePassword'], 'string', 'min' => 6],

            ['rePassword', 'compare', 'compareAttribute' => 'password', 'message' => 'Two times the password is not consistent.'],


            ['verifyCode', 'captcha']
        ];
    }

    public function attributeLabels() 
    {
        return [
            'rePassword' => 'Confirm Password',
            'verifyCode' => 'Captcha'
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new UserModel();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
