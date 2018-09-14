<?php

namespace vendor;

class Route
{
    public static function run()
    {
        $controller = 'Index';
        $action = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if(!empty($routes[1]))
        {
            $controller = \ucfirst($routes[1]);
        }

        if(!empty($routes[2]))
        {
            $action = $routes[2];
        }

        $controller = $controller . 'Controller';
        $action = $action . 'Action';

        $controller_path = APP . 'controllers/' . $controller . '.php';

        if(file_exists($controller_path)){
            include_once $controller_path;

        }else{

            Route::Error404();
        }

        $controller = 'app\\controllers\\' . $controller;

        $controllerClass = new $controller;

        if(method_exists($controllerClass, $action)){

            $controllerClass->$action();
        }else{
            Route::Error404();
        }
    }

    public static function Error404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';

        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }

}