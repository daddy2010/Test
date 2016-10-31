<html>
    <head>
        <title></title>
    </head>
    <body>
        <a href="Privat24.php">Главная</a>
        <form action="stoot.php" method="POST">
            <input type="text" name="stootuser">
            <input type="submit" name="st" value="Снять">
        </form>
<?php
require 'DataBase.php';
require 'autodb.php';
$st = filter_input(INPUT_POST, 'st');
$dataTime = time();
$b = new Base();
if(isset($st)){
$payuser = filter_input(INPUT_POST, 'stootuser', FILTER_SANITIZE_SPECIAL_CHARS);
$get = $b->getId();
$stoot = $db->query("SELECT score FROM user WHERE id=$get ");
$db->exec("INSERT INTO userhistory(id)VALUE('$get')");
if($stoot >= $payuser){
$passwordPay = "Win7sooG3X4j133uZjZ7712D69YtfCUS";
$data = '
                    <oper>cmt</oper>
                    <wait>90</wait>
                    <test>0</test>
                    <payment id="1234567">
                        <prop name="b_card_or_acc" value="4627081718568608" />
                        <prop name="amt" value="'.$payuser.'" />
                        <prop name="ccy" value="UAH" />
                        <prop name="details" value="test%20merch%20not%20active" />
                    </payment>
                ';
$sign = sha1(md5($data.$passwordPay));
$xml = '<?xml version="1.0" encoding="UTF-8"?>
            <request version="1.0">
                <merchant>
                    <id>122527</id>
                    <signature>'.$sign.'</signature>
                </merchant>
                <data>
                    <oper>cmt</oper>
                    <wait>90</wait>
                    <test>0</test>
                    <payment id="1234567">
                        <prop name="b_card_or_acc" value="4627081718568608" />
                        <prop name="amt" value="'.$payuser.'" />
                        <prop name="ccy" value="UAH" />
                        <prop name="details" value="test%20merch%20not%20active" />
                    </payment>
                </data>
            </request>';
$ch = curl_init("https://api.privatbank.ua/p24api/pay_pb");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$ress = curl_exec($ch);
curl_close($ch);
$xml = new SampleXMLElement($ress);
if((string)$xml->response->data->payment['state'] === 1){
    echo 'Платеж прошел успешно';
    $count = $db->query("SELECT * FROM userhistory WHERE id=$get");
    $payCount = $count - $payuser;
    $db->exec("INSERT INTO userhistory(id,time,count)VALUE('$id','$dataTime','$payuser')");
    $db->exec("INSERT INTO user(score)VALUE('$payCount')");
  
}
}
 else {
    echo 'У вас нехватает депозита на счету';    
}
}
?>
</body>
</html>


