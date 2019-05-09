<?php

namespace app\controllers;

use app\models\Users;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\Url;

class SiteController extends Controller
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        return $this->render('app-list');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionApps()
    {
        $session = Yii::$app->session;
        $account = $session->get('account');

        if(empty($account)){
            $this->redirect(Url::toRoute(['site/login']));
        }

        $view = Yii::$app->getView();
        $view->params['account'] = $account;
        $view->params['module'] = 'App List';


        return $this->render('index');
    }


    public function actionError()
    {
        $session = Yii::$app->session;
        $account = $session->get('account');

        if(empty($account)){
            $this->redirect(Url::toRoute(['site/login']));
        }

        $view = Yii::$app->getView();
        $view->params['account'] = $account;
        $view->params['module'] = 'Error';

        $request = Yii::$app->request;
        $message = $request->get('message','bad server');

        return $this->render('error',['message' => $message]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionAppCreate()
    {
        $session = Yii::$app->session;
        $account = $session->get('account');

        if(empty($account)){
            $this->redirect(Url::toRoute(['site/login']));
        }

        $view = Yii::$app->getView();
        $view->params['account'] = $account;
        $view->params['module'] = 'App Create';


        return $this->render('app-create');
    }

    /**
     * Setting action.
     *
     * @return string
     */
    public function actionSetting()
    {
        $session = Yii::$app->session;
        $account = $session->get('account');

        if(empty($account)){
            $this->redirect(Url::toRoute(['site/login']));
        }

        $view = Yii::$app->getView();
        $view->params['account'] = $account;
        $view->params['module'] = 'Setting';


        return $this->render('setting');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            $response = Yii::$app->response;
            $response->format = Response::FORMAT_JSON;

            $account = $request->post('account');
            $password = $request->post('password');

            if (empty($account) || empty($password)) {
                $response->data = array(
                    'code' => 404,
                    'msg' => 'params not found'
                );
                return $response->send();
            }

            $user = Users::findByAccountAndPassword($account, $password);
            if (!empty($user)) {
                $session = Yii::$app->session;
                $session->set('account',$account);

                $response->data = array(
                    'code' => 200,
                    'msg' => 'success',
                    'data' => $user
                );
            } else {
                $response->data = array(
                    'code' => 400,
                    'msg' => 'fail'
                );
            }
            return $response->send();
        }

        $this->layout='@app/views/layouts/login.php';
        return $this->render('login');
    }

    /**
     * Logout action.
     *
     * @return Response|string
     */
    public function actionLogout()
    {
        $session = Yii::$app->session;
        $session->remove('account');

        $this->redirect(Url::toRoute(['site/login']));
    }

    public function actionResetPassword()
    {
        $request = Yii::$app->request;
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;

        $session = Yii::$app->session;
        $account = $session->get('account');

        if(empty($account)){
            $this->redirect(Url::toRoute(['site/login']));
        }

        $oldPassword = $request->post('oldPassword');
        $newPassword = $request->post('newPassword');

        if( empty($oldPassword) || empty($newPassword)){
            $response->data = array(
                'code' => 404,
                'msg' => 'params not found'
            );
            return $response->send();
        }

        $ret = Users::updatePassword($account,$oldPassword,$newPassword);
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


}
