<?php

class Controller
{
    public function model($model){
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }

    public function view($view, $dates = []){
        if(file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        }else{
            die('The view is not found');
        }
        
    }
}