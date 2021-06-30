<?php

require __DIR__ . '/../bootstrap.php';

//use Code\Contoller\pageController;

//informações sobre as requisições que estão sendo feitas
//$url = substr($_SERVER['REQUEST_URI'], start:1);
//Função que transforma uma string em array e remove os caracter e armazena o que sobraram

//$url = explode(delimiter: '/', $url);
$url = substr($_SERVER['REQUEST_URI'], 1);
$url = explode('/', $url);

//se "url" existi a casa 0 ele pega a propria casa 0 e se ja existi um valor ele mostra a prórpia page, senão existi coloca default "page"
$controller = isset($url[0]) && $url[0] ? $url[0] : 'home';
$action     = isset($url[1]) && $url[1] ? $url[1] : 'index';
$param      = isset($url[2]) && $url[2] ? $url[2] : null;

//concatena o que ta sendo passado com o sufixo "controller"

if(!class_exists($controller = "Code\Controller\\". ucfirst($controller).'Controller')){
    print (new \Code\View\View(view: '404.phtml'))->render();
    die;
}

if(!method_exists($controller, $action)){
  $action = 'index';
  $param  = $url[1];
}


//var_dump($url);
//print 'Controller Default: ' .$controller;
//print '<br>Método Default'.$action;


//função que executa qualquer função ou método
$response = call_user_func_array([new $controller, $action], [$param]);

print $response;

//$execute = new $controller();
//print $execute->index();