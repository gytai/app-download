<?php

namespace app\controllers;

use app\models\Apps;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\helpers\Url;

class AppsController extends Controller
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionList()
    {
        $request = Yii::$app->request;
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;

        $keyword = $request->get('keyword','');
        $page = $request->get('page',1);
        $size = $request->get('size',10);

        $list = Apps::appList($keyword,$page,$size);

        $response->data = array(
            'code' => 200,
            'msg' => 'success',
            'data' => $list
        );
        return $response->send();
    }

    public function actionDelete(){
        $request = Yii::$app->request;
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;

        $session = Yii::$app->session;
        $account = $session->get('account');

        if(empty($account)){
            $response->data = array(
                'code' => 400,
                'msg' => 'please login first'
            );
            return $response->send();
        }


        $uid = $request->post('uid');
        if( empty($uid)){
            $response->data = array(
                'code' => 404,
                'msg' => 'params not found'
            );
            return $response->send();
        }

        $ret = Apps::appDel($uid);
        if(!$ret){
            $response->data = array(
                'code' => 400,
                'msg' => 'fail'
            );
        }else{
            $response->data = array(
                'code' => 200,
                'msg' => 'success'
            );
        }
        return $response->send();
    }

    public function actionCreate(){
        $request = Yii::$app->request;
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;

        $session = Yii::$app->session;
        $account = $session->get('account');

        if(empty($account)){
            $response->data = array(
                'code' => 400,
                'msg' => 'please login first'
            );
            return $response->send();
        }

        $name= $request->post('name');
        $version = $request->post('version');

        if( empty($name) || empty($version) ){
            $this->redirect(Url::toRoute(['site/error','message'=> 'params not found']));
        }

        $rootPath = 'uploads/';

        if (!file_exists($rootPath)) {
            mkdir($rootPath, 0755, true);
        }

        $image = UploadedFile::getInstanceByName('icon');
        $ext = $image->getExtension();
        $size = $image->size;

        $imgExt = ['jpg', 'jpeg', 'gif', 'png', 'bmp'];
        if (!in_array(strtolower($ext), $imgExt)) {
            $this->redirect(Url::toRoute(['site/error','message'=> 'only jpg and png']));
        }

        if($size > 1024 * 1024 * 10){
            $this->redirect(Url::toRoute(['site/error','message'=> 'file too large']));
        }

        $imageName = $rootPath . time() . rand( ). '.' . $ext;
        $image->saveAs($imageName);


        $app = UploadedFile::getInstanceByName('app');
        $ext = $app->getExtension();
        $size = $app->size;

        $imgExt = ['apk'];
        if (!in_array(strtolower($ext), $imgExt)) {
            $this->redirect(Url::toRoute(['site/error','message'=> 'only apk file']));
        }

        if($size > 1024 * 1024 * 10){
            $this->redirect(Url::toRoute(['site/error','message'=> 'file too large']));
        }

        $appName = $rootPath . time() . rand( ). '.' . $ext;
        $app->saveAs($appName);

        $ret = Apps::appAdd($name, $appName, $imageName,$version);

        if($ret) {
            $this->redirect(Url::toRoute(['site/index']));
        } else {
            $this->redirect(Url::toRoute(['site/error','message'=> 'create app wrong']));
        }
    }
}
