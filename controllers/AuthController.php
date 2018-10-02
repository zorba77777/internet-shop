<?php
namespace app\controllers;


use app\services\Auth;

class AuthController extends Controller
{
    public function actionIndex()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            if((new Auth())->login($_POST['login'], $_POST['pass'])){
                $this->redirect('product');
                exit;
            }
        }

        echo $this->render('login');
    }
}