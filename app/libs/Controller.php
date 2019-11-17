<?php

class Controller
{
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';

        return new $model;
    }

    public function view($view , $params = [])
    {
        //validate if exist the view
        if(file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        }else {
            die('the view not exist');
        }
    }
}