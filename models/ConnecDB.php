<?php
class ConnecDB extends PDO {
  function __construct()
  {
    try {
      parent::__construct('mysql:host=localhost;dbname=prueba;', 'root', 'mysql');
    }
    catch(PDOException $e) {
      exit($e->getMessage());
    }  
  }
}