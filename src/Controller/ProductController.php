<?php 

namespace Code\Controller;

use Code\DB\Connection;
use Code\View\View;
use Code\Entity\Product;


class ProductController{

  public function index($id)
  {
    //$id = (int) $id;

    $pdo = Connection::getInstance();

    $view = new View(view: 'site/single.phtml');
    
    // var_dump((new Product($pdo))->findAll());
    //var_dump((new Product($pdo))->delete(id:12));
  
    // var_dump((new Product($pdo))->update(
    //   ['id' => 1, 'name' => 'Madara uchiha']
    // ));
  

    //os binds vão vir dessa linha da chave nomeada name
    //var_dump((new Product($pdo))->where(['name' => 'Antonio', 'email' => 'rufino']));
    
    var_dump((new Product($pdo))->where(
      ['id' => 13]
    ));

    
    // var_dump((new Product($pdo))->insert(
    //   ['category_id' => 2, 'name' => 'Nagato', 'price' => 19.99, 'amount' => 10, 'description'=>'Testando o código', 'slug' => 'slug']
    // ));
   

    //$view->product = (new Product($pdo))->find($id);

    //$products = new Product($pdo); 
    
     //usa a view para chmar o ProductController
     //var_dump((new Product($pdo))->find($id)); die;

    // return $view->render();

  }
}