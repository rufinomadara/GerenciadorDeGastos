<?php

namespace Code\View;

class View 
{

  private $view;
  private $data = [];

  //passar a view pelo construtor
  public function __construct($view){
    //view iniciada
    $this->view = $view;
  }

  //quando tentar setar um atributo que não existe ela executa esse metodo 
  public function __set($index, $value){
    $this->data[$index] = $value;
  }

  //recuperar um valor de um atribuito que não existe o método é executado
  public function __get ($index){
    return $this->data[$index];
  }
  
  //renderiza a minha view
  public function render(){
    
    ob_start();

    //Criamos esse VIEWS_PATH
    require VIEWS_PATH . $this->view;
    
    // limpa o nosso buffer do browser e recupera o valor dele
    return ob_get_clean(); 
  }
}