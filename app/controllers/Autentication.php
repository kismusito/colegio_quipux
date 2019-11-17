<?php

class Autentication extends Controller
{
    public function __construct()
    {
        $this->user = $this->model('auth');
    }

    public function index ()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'user' => trim($_POST['user']),
                'password' => trim($_POST['password'])
            ];

            if ($this->user->comfirmUser($datos)){
                $datosBase = $this->user->getUser($datos);
                if ($this->user->comfirmPassword($datos , $datosBase)) {
                    $_SESSION['auth'] = $datosBase->username;
                    redirect('/pages');
                } else {
                    $_SESSION['error'] = 'error login';
                    redirect('/autentication');
                }
            } else {
                $_SESSION['error'] = 'error login';
                redirect('/autentication');
            }

        } else {
            $this->view('pages/auth/login');
        }
    }
    
}