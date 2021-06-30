<?php

namespace Code\DB;

use \PDO;

//classe abstrada não pode ser instanciada. Vai servi apenas para conter uma base 
abstract class Entity
{

  private $conn;

  protected $table;

  public function __construct(\PDO $conn)
  {
      $this->conn = $conn;
  }

  public function findAll($fields = '*')
  {
    //pega os fildes que estão sendo passados
    $sql = 'SELECT ' . $fields . ' FROM '. $this->table; 

    $get = $this->conn->query($sql);

    return $get->fetchAll(fetch_style: PDO::FETCH_ASSOC);
  }

  public function find(int $id)
  {

    $sql = 'SELECT * FROM products WHERE id = :id';
    
    $get = $this->conn->prepare($sql);
    $get->bindValue(':id', $id, \PDO::PARAM_INT);
    // OS VALORES DOS PARÂMETROS $get->bindValue(parameter:':id', $id, data_type:\PDO::PARAM_INT);
    
    $get->execute();

    return $get->fetch(PDO::FETCH_ASSOC);
    //$get->fetchAll(fetch_style: PDO::FETCH_ASSOC);
  }
  
  //vamos passar condições para a nossa query para o nosso array
  public function where(array $conditions, $operator = ' AND ', $fields = '*')
  {
    //nosso select dinâmico
      $sql = 'SELECT ' . $fields . ' FROM ' . $this->table . ' WHERE ';
      
      $binds = array_keys($conditions);

      $where = null;
      foreach($binds as $v){
        
        if (is_null($where)){
          $where .= $v . ' = :' . $v;
        }else {
          //concatena o $where com o $where caso exista
          $where .= $operator . $v . ' = :' . $v;
        }

      }
      //concatena com o select do $sql com o $where
      $sql .= $where;

      $get = $this->bind($sql, $conditions);

      $get->execute();

      return $get->fetchAll(\PDO::FETCH_ASSOC);
      // return $get->fetchAll(fetch_style: \PDO::FETCH_ASSOC);
      //print $sql;
  }

  public function insert($data){

      $binds = array_keys($data);
      //$fields = implode(glue: ', ', $binds);
      //pode adicionar fields diretamente
      //$fields = implode(', ', $binds);
      //      $sql = 'INSERT INTO ' . $this->table . '('. implode(glue:', ', $binds) . '
      //) VALUES(:' . implode(glue:', :', $binds) . ')';

      $sql = 'INSERT INTO ' . $this->table . '('. implode(', ', $binds) . ', created_at, updated_at
      ) VALUES(:' . implode(', :', $binds) . ', NOW(), NOW())';
 
       $insert = $this->bind($sql, $data);

       return $insert->execute();

      //exibi o que está sendo passado pelo mysql
      //print $sql;
  }

  public function update($data){
    $sql = 'UPDATE ' . $this->table . ' SET name = :name'
  }

  private function bind($sql, $data){

    $bind = $this->conn->prepare($sql); 

    //vetor que pega as keys e as linhas dos valores
    foreach ($data as $k => $v){
      gettype($v) == 'int' ? $bind->bindValue(':' . $k, $v, \PDO::PARAM_INT)
                           : $bind->bindValue(':' . $k, $v, \PDO::PARAM_STR);
    }

    return $bind;
  }

}