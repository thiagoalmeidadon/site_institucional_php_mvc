<?php
require __DIR__ . '/../bootstrap.php';

// retirando a barra /
$url = substr($_SERVER['REQUEST_URI'], 1);

// retorna um array usando delimitador / para separar
$url = explode('/', $url);

// configurando o nome do controller
$controller = isset($url[0]) && ($url[0]) ? $url[0] : 'home' ;
$action     = isset($url[1]) && ($url[1]) ? $url[1] : 'index' ;
$param      = isset($url[2]) && ($url[2]) ? $url[2] :  null ;

// verifica se existe a classe
if(!class_exists($controller = 'Controller\\' . ucfirst($controller) . 'Controller'))
{
    //die("404 - Página não encontrada!");
    print (new \View\View('404.phtml'))->render();
    die;
}

// verifica se não existe o método
if(!method_exists($controller, $action))
{
    $action = 'index';
    $param  = $url[1];
}

$response = call_user_func_array([new $controller, $action], [$param]);

print $response;