<?php 
namespace Code\DB;

class Connection
{
  private static $instance = null;
  //Quando tem uma instancia na memória eu pego ela, caso ela não exista, eu crio ela e retorna
  private function __construct(){

  }

  //vou acessar meu banco de dados por meio desta instancia 
  public static function getInstance()
  {
      //se a minha instancia for nula, eu vou instanciar o PDO
      //if(is_null(var:self::$instance)){
      if(is_null(self::$instance)){
        self::$instance = new \PDO('mysql:dbname=formacao_php;host=127.0.0.1', 'root', '');
        //trás os dados já formatados do UTF8 para não termos problemas com os caracteres especiais
        self::$instance->exec('SET NAMES UTF8');
        //self::$instance->exec(statement: 'SET NAMES UTF8'
      }

      return self::$instance;
  }

}