<?php
require 'DataBase.php';
class Base{
    private $iddb;
function setId($id){
$this->iddb = $id;
}
function getId(){
    return $this->iddb;
}
}
