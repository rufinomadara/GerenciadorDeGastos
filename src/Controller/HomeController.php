<?php 

namespace Code\Controller;

use Code\DB\Connection;
use Code\View\View;
use Code\Entity\Product;


class HomeController{

  public function index(){

    //instancia o banco de dados
    $pdo = Connection::getInstance();

    //$products = new Product($pdo); 
    
    //var_dump($products->findAll());die;

    //cria uma variavel instaciada pela classe view
    $view = new View(view: '\site\index.phtml');

    //usa a view para chmar o ProductController
    $view->products = (new Product($pdo))->findAll();

    //no return vamos ter o require do arquivo html 
    return $view->render();
  }
}