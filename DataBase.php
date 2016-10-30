<?php
$login = "root";
try {
  $db = new PDO('mysql:host=localhost;dbname=privat',$login);  
} catch (Exception $ex) {
    $ex->getMessagege();
}

