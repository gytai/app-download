<?php

namespace app\models;

use yii\db\ActiveRecord;

class Users extends ActiveRecord
{

    public static function tableName()
    {
        return '{{users}}';
    }

    public function rules()
    {
        return [
            [['account', 'password'], 'required', 'message' => 'params is required']
        ];
    }

    public static function findByAccountAndPassword($account, $password){
        $user = Users::find()
            ->where(['account' => $account,'password' => md5($password)])
            ->one();

        return $user;
    }

    public static function updatePassword($account, $oldPassword,$newPassword){
        $user = Users::find()
            ->where(['account' => $account,'password' => md5($oldPassword)])
            ->one();

        if(empty($user)){
            return false;
        }

        $user->password = md5($newPassword);
        return $user->save();
    }
}
