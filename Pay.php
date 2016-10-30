<html>
    <head>
        <title></title>
    </head>
    <body>
        <a href="Privat24.php">Главная</a>
        <form action="Pay.php" method="POST">
            <input type="text" name="payuser">
            <input type="submit" name="pay" value="Оплатить">
        </form>
<?php
require 'DataBase.php';
require 'Base.php';
$pay = filter_input(INPUT_POST, 'pay');
$b = new Base();
$get = $b->getId();
if(isset($pay)){
$payuser = filter_input(INPUT_POST, 'payuser', FILTER_SANITIZE_SPECIAL_CHARS);
$pays = $db->query("SELECT score FROM user WHERE id=$get ");
$passwordPay = "Win7sooG3X4j133uZjZ7712D69YtfCUS";
$data = '
                    <oper>cmt</oper>
                    <wait>90</wait>
                    <test>1</test>
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
                    <test>1</test>
                    <payment id="1234567">
                        <prop name="b_card_or_acc" value="4627081718568608" />
                        <prop name="amt" value="'.$payuser.'" />
                        <prop name="ccy" value="UAH" />
                        <prop name="details" value="test%20merch%20not%20active" />
                    </payment>
                </data> 
            </request>';
echo $xml;
$ch = curl_init("api.privatbank.ua/p24api/pay_pb");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$ress = curl_exec($ch);
var_dump($ress);
curl_close($ch);
$priv24 = new SimpleXMLElement($ress);
//var_dump($priv24);
if ((string) $priv24->response->data['state'] === '1') {
    $time = time();
    $countPay = $pays + $payuser;
    $db->exec("INSERT INTO userhistory(time,count)VALUES('$time','$payuser')");
    $db->exec("INSERT INTO user(score)VALUES('$countPay')");
    echo 'Платеж успешно прошел';
}
}
?>
</body>
</html>

