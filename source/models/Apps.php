<?php

namespace app\models;

use yii\db\ActiveRecord;

class Apps extends ActiveRecord
{

    public static function tableName()
    {
        return '{{apps}}';
    }

    public function rules()
    {
        return [
            [['name', 'link'], 'required', 'message' => 'params is required']
        ];
    }

    public static function appAdd($name,$link,$image,$version){
        $app = new Apps();

        $app->name = $name;
        $app->link = $link;
        $app->image = $image;
        $app->version = $version;
        $app->created_at = Date('Y-m-d');

        return $app->save();
    }

    public static function appList($keyword, $page, $size){
        $condition = '';
        if(!empty($keyword)){
            $condition = 'name like "%' . $keyword . '%"';
        }
        $apps = Apps::find()
            ->where($condition)
            ->offset( ($page - 1) * $size)
            ->limit($size)
            ->asArray()
            ->all();

        $total = Apps::find()
            ->where($condition)
            ->count();

        return ['apps' => $apps, 'total' => $total];
    }

    public static function appDel($id){
        $app = Apps::find()
            ->where(['id' => $id])
            ->one();

        if(empty($app)){
            return false;
        }

        return $app->delete();
    }
}
