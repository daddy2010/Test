<?php
require 'DataBase.php';
require 'autodb.php';
echo("<a href='Privat24.php'>Главная</a>");
$idHis = new Base();
$idNum = $idHis->getId();
$history = $db->query("SELECT * FROM userhistory WHERE id=$idNum");
while($result = $history->fetchAll()){
    echo $result['time'];
    echo '      ';
    echo $result['count'];
    echo '<br>';
}
?>

