<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="windows-1251">
        <title></title>
    </head>
    <body>
        <?php
        $ch = curl_init('google.com');
        curl_setopt($ch, CURLOPT_HEADER, TRUE );
        $res = curl_exec($ch);
        curl_close($ch);
        ?>
    </body>
</html>
