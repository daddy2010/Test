<?php
require 'DataBase.php';
echo("<a href='Privat24.php'>Главная</a>");
$history = $db->query("SELECT * FROM userhistory");
while($result = $history->fetchAll()){
    echo $result['time'];
    echo '      ';
    echo $result['count'];
    echo '<br>';
}
?>

