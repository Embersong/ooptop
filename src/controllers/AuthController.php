<?php

namespace Ember\Oop\controllers;

class AuthController extends Controller
{
    public function actionLogin()
    {
        $login = $_POST['login'];
        $pass = $_POST['pass'];

        if ($login == 'admin' && $pass == 'admin') {
            $_SESSION['login'] = 'admin';
            header('Location: /');
            exit();
        }

    }

    public function actionLogout()
    {
        session_destroy();
        header('Location: /');
        exit();
    }

}